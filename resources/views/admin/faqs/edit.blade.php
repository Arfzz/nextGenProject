@extends('layouts.admin')

@section('page-title', 'Edit FAQ')

@section('content')
    <div class="card" style="max-width: 640px;">
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="question">Pertanyaan</label>
                <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                @error('question') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="answer">Jawaban</label>
                <textarea id="answer" name="answer" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                <label for="is_active">Aktif (tampilkan di landing page)</label>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn--primary">Update</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn--secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection