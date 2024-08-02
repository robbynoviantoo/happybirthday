@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Karyawan</h1>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf <!-- Pastikan token CSRF disertakan -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
            <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>
        
        <div class="mb-3">
            <label for="nik" class="form-label">NIK:</label>
            <input type="text" class="form-control" name="nik" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    @if ($errors->any()) <!-- Menampilkan pesan kesalahan jika ada -->
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection