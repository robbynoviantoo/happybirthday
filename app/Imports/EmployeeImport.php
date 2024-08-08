<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeeImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Employee|null
     */
    public function model(array $row)
    {
        // Pastikan kunci 'tanggal' ada dalam array $row
        if (!isset($row[1])) {
            // Tangani kesalahan atau abaikan baris ini
            return null;
        }

        // Coba parsing tanggal dengan format dd/mm/yyyy
        $date = \DateTime::createFromFormat('d/m/Y', $row[1]);
        if ($date) {
            $tanggal = $date->format('Y-m-d');
        } else {
            // Jika gagal, coba konversi nilai tanggal dari format Excel ke format tanggal yang valid
            $tanggal = Date::excelToDateTimeObject($row[1])->format('Y-m-d');
        }

        // Pastikan tanggal dalam format Date
        $tanggal = date('Y-m-d', strtotime($tanggal));

        // Gunakan updateOrCreate untuk memperbarui atau membuat entri
        return Employee::updateOrCreate(
            ['nik' => $row[2]], // Kondisi untuk menentukan apakah record sudah ada
            [
                'name' => $row[0],
                'tanggal_lahir' => $tanggal,
                // 'nik' sudah ada di kondisi updateOrCreate
            ]
        );
    }
}