@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Daftar Karyawan') }}</div>

                    <div class="card-body">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
                        <a href="{{ route('employees.importPage.data') }}" class="btn btn-warning mb-3 me-2">Import from
                            Excel</a>
                        <table id="employeesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->tanggal_lahir }}</td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#employeesTable').DataTable();
        });
    </script>
@endsection
