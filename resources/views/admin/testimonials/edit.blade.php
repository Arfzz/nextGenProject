@extends('layouts.admin')

@section('page-title', 'Edit Testimonial')

@section('content')
    <div class="card" style="max-width: 640px;">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="photo">Foto (otomatis crop persegi)</label>
                @if($testimonial->photo)
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Current photo" class="photo-preview">
                @endif
                <input type="file" id="photo" name="photo" accept="image/*">
                <small style="color: var(--color-text-muted);">Kosongkan jika tidak ingin mengganti foto.</small>
                @error('photo') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="role">Role / Prestasi</label>
                <input type="text" id="role" name="role" value="{{ old('role', $testimonial->role) }}">
                @error('role') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="content">Konten Testimonial</label>
                <textarea id="content" name="content" required>{{ old('content', $testimonial->content) }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="rating">Rating (1-5)</label>
                <select id="rating" name="rating">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} ⭐
                        </option>
                    @endfor
                </select>
                @error('rating') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                <label for="is_active">Aktif (tampilkan di landing page)</label>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn--primary">Update</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn--secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection