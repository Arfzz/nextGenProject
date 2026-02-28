@extends('layouts.admin')

@section('page-title', 'Tambah Testimonial')

@section('content')
    <div class="card" style="max-width: 640px;">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Rifaldi">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="photo">Foto (otomatis crop persegi)</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                @error('photo') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="role">Role / Prestasi</label>
                <input type="text" id="role" name="role" value="{{ old('role') }}"
                    placeholder="Contoh: Awardee KIPK Scholarship">
                @error('role') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="content">Konten Testimonial</label>
                <textarea id="content" name="content" required
                    placeholder="Tulis testimonial...">{{ old('content') }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="rating">Rating (1-5)</label>
                <select id="rating" name="rating">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                    @endfor
                </select>
                @error('rating') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Aktif (tampilkan di landing page)</label>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn--primary">Simpan</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn--secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection