@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h3 class="card-title mb-3">
                    <i class="bi bi-journal-text me-2"></i>{{ $note->title }}
                </h3>

                @if($note->file)
                    <img src="{{ asset('storage/' . $note->file) }}" alt="Lampiran" class="img-fluid rounded mb-3"
                        style="max-height: 300px;">
                @endif


                <div class="mb-3">
                    <small class="text-muted">
                        Kategori: <strong>{{ $note->category->name ?? '-' }}</strong> |
                        Oleh: {{ $note->user->name ?? 'Anonim' }} |
                        Tanggal: {{ $note->created_at->format('d M Y') }}
                    </small>
                </div>


                <div class="border-top pt-3" style="white-space: pre-line;">
                    {{ $note->content }}
                </div>

                <div class="mt-4">
                    <a href="{{ route('notes.index') }}" class="btn btn-outline-dark
                                ">
                        <i class=""></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection