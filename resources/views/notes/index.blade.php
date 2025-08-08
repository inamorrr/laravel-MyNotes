@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm border-0">


            <form action="{{ route('notes.index') }}" method="GET" class="mb-4">
                <div class="input-group rounded-4 shadow-sm">
                    <span class="input-group-text bg-white border-0 rounded-pill">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-0 py-2 px-3"
                        placeholder="Cari catatan berdasarkan judul..." value="{{ request('search') }}">
                    <button class="btn btn-outlin-dark px-4" type="submit">
                        Cari
                    </button>
                </div>
            </form>



            <div class="card-body">
                <h5 class="mt-4">
                    <i class="fa-regular fa-note-sticky"></i> Daftar Catatan
                </h5>

                @forelse ($notes as $note)
                    <div class="border rounded p-3 mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $note->title }}</h5>
                            <small class="text-muted d-block">
                                Kategori: {{ $note->category->name ?? '-' }}
                            </small>
                            <small class="text-muted">
                                Tanggal dibuat: {{ \Carbon\Carbon::parse($note->created_at)->format('d M Y') }}
                            </small>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-outline-dark">Lihat</a>
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin hapus tugas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada catatan.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection