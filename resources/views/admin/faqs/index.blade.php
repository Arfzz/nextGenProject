@extends('layouts.admin')

@section('page-title', 'FAQ')

@section('content')
    <div class="actions-row">
        <div class="actions-row__title">Semua FAQ ({{ $faqs->count() }})</div>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn--primary">+ Tambah FAQ</a>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $i => $faq)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><strong>{{ Str::limit($faq->question, 60) }}</strong></td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge badge--active">Aktif</span>
                                @else
                                    <span class="badge badge--inactive">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $faq->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-actions">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn--secondary btn--sm">Edit</a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus FAQ ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                                Belum ada FAQ. <a href="{{ route('admin.faqs.create') }}"
                                    style="color: var(--color-accent); font-weight: 600;">Tambah sekarang →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection