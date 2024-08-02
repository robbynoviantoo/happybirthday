@extends('layouts.app')

@section('content')
    <h1>Edit Karyawan</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nama:</label>
        <input type="text" name="name" value="{{ $employee->name }}" required>
        
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="{{ $employee->tanggal_lahir }}" required>
        
        <label for="nik">NIK:</label>
        <input type="text" name="nik" value="{{ $employee->nik }}" required>
        
        <button type="submit">Update</button>
    </form>
@endsection