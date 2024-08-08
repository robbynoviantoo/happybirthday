@extends('layouts.app')

@section('title', 'Import Data BC Grade')

@section('content')
    <div class="container mt-2">
        <h1 class="mb-4">Import Data BC Grade</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employees.import.data') }}" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm">
            @csrf
            <div class="form-group mb-3">
                <label for="file">Pilih File</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
