<!-- resources/views/arsip/buatarsip.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Arsip Baru</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Arsip</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Arsip</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="file">Upload File Arsip</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>

            <div class="form-group">
                <label for="type">Jenis Arsip</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="vital">Vital</option>
                    <option value="aktif">Aktif</option>
                    <option value="inaktif">Inaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Arsip</button>
        </form>
    </div>
@endsection
