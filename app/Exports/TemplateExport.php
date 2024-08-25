<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Contoh data template, misalnya nama kolom yang dibutuhkan
        return collect([
            ['', '', ''],  // Baris kosong untuk template
        ]);
    }

    public function headings(): array
    {
        return ['NIS', 'Name', 'Gender[L/P]', 'Class'];  // Sesuaikan dengan kebutuhan
    }
}
