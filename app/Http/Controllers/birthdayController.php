<?php

namespace App\Http\Controllers;

use App\Models\Employee; // Tambahkan import model Employee
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    /**
     * Display a listing of employees whose birthday is today.
     */
    public function index()
    {
        $today = date('m-d'); // Ambil bulan dan tanggal hari ini
        $birthdays = Employee::whereRaw('DATE_FORMAT(tanggal_lahir, "%m-%d") = ?', [$today])->get(); // Ambil karyawan yang berulang tahun hari ini
        return view('welcome', compact('birthdays')); // Kembalikan view dengan data ulang tahun
    }
}