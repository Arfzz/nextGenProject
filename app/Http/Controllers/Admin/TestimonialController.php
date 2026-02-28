<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->processPhoto($request->file('photo'));
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $this->processPhoto($request->file('photo'));
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial berhasil dihapus.');
    }

    /**
     * Process and auto-crop uploaded photo to square 400x400.
     */
    private function processPhoto($file): string
    {
        $filename = 'testimonials/' . uniqid() . '.jpg';

        // Read image using GD
        $sourceImage = match ($file->getMimeType()) {
            'image/jpeg' => imagecreatefromjpeg($file->getPathname()),
            'image/png' => imagecreatefrompng($file->getPathname()),
            'image/webp' => imagecreatefromwebp($file->getPathname()),
            default => imagecreatefromjpeg($file->getPathname()),
        };

        $srcW = imagesx($sourceImage);
        $srcH = imagesy($sourceImage);

        // Auto-crop to square (center crop)
        $cropSize = min($srcW, $srcH);
        $srcX = ($srcW - $cropSize) / 2;
        $srcY = ($srcH - $cropSize) / 2;

        // Create 400x400 canvas
        $targetSize = 400;
        $croppedImage = imagecreatetruecolor($targetSize, $targetSize);

        imagecopyresampled(
            $croppedImage,
            $sourceImage,
            0,
            0,
            (int) $srcX,
            (int) $srcY,
            $targetSize,
            $targetSize,
            $cropSize,
            $cropSize
        );

        // Save to storage/app/public/testimonials/
        $storagePath = storage_path('app/public/' . $filename);
        $dir = dirname($storagePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        imagejpeg($croppedImage, $storagePath, 85);

        imagedestroy($sourceImage);
        imagedestroy($croppedImage);

        return $filename;
    }
}
