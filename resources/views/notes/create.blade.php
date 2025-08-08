@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Catatan</h3>

        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf

            <div class="mb-4">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Isi Catatan</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">File (opsional)</label>
                <input type="file" name="file" class="form-control">
            </div>

            <button type="submit" class="btn btn-outline-dark">Simpan</button>
        </form>
    </div>
@endsection