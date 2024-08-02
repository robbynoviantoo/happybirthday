<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = Employee::all(); // Ambil semua karyawan
        return view('employees.index', compact('employees')); // Kembalikan view dengan data karyawan
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('employees.create'); // Kembalikan view untuk tambah karyawan
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required',
        ]);

        Employee::create($validatedData); // Simpan karyawan baru
        return redirect()->route('employees.index')->with('status', 'Karyawan baru berhasil ditambahkan!'); // Redirect ke daftar karyawan dengan pesan sukses
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id); // Ambil karyawan berdasarkan ID
        return view('employees.edit', compact('employee')); // Kembalikan view edit dengan data karyawan
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validatedData); // Update data karyawan
        return redirect()->route('employees.index')->with('status', 'Data karyawan berhasil diupdate!'); // Redirect ke daftar karyawan dengan pesan sukses
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete(); // Hapus karyawan
        return redirect()->route('employees.index')->with('status', 'Karyawan berhasil dihapus!'); // Redirect ke daftar karyawan dengan pesan sukses
    }
}