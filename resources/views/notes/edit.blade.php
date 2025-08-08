@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Edit Catatan</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notes.update', $note->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" value="{{ $note->title }}" required>
            </div>

            <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <textarea name="content" class="form-control mb-3" placeholder="Isi catatan" required></textarea>

                <select name="category_id" class="form-control mb-3" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $note->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                @if($note->file)
                    <p>File saat ini: <a href="{{ asset('storage/' . $note->file) }}" target="_blank">Lihat</a></p>
                @endif

                <input type="file" name="file" class="form-control mb-2">
                <button class="btn btn-outline-dark">Edit</button>
            </form>
    </div>
@endsection