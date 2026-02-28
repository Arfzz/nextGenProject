@extends('layouts.admin')

@section('page-title', 'Testimonials')

@section('content')
    <div class="actions-row">
        <div class="actions-row__title">Semua Testimonial ({{ $testimonials->count() }})</div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn--primary">+ Tambah Testimonial</a>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $i => $testimonial)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="" class="photo-thumb">
                                @else
                                    <span style="color: var(--color-text-muted);">—</span>
                                @endif
                            </td>
                            <td><strong>{{ $testimonial->name }}</strong></td>
                            <td>{{ $testimonial->role ?? '-' }}</td>
                            <td>{{ str_repeat('⭐', $testimonial->rating) }}</td>
                            <td>
                                @if($testimonial->is_active)
                                    <span class="badge badge--active">Aktif</span>
                                @else
                                    <span class="badge badge--inactive">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $testimonial->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-actions">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                        class="btn btn--secondary btn--sm">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus testimonial ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                                Belum ada testimonial. <a href="{{ route('admin.testimonials.create') }}"
                                    style="color: var(--color-accent); font-weight: 600;">Tambah sekarang →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection