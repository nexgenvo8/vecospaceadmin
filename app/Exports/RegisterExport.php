<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RegisterExport implements FromCollection, WithHeadings, WithEvents
{
    protected $excelData;

    public function __construct($excelData)
    {
        $this->excelData = $excelData;
    }

    public function collection()
    {
        return new Collection($this->excelData);
    }

    public function headings(): array
    {
        return [
            'Registration No',
            'Full Name',
            'Department',
            'Course',
            'Semester',
            'Passing Year',
            'Mobile',
            'Gender',
            'University ID',
            'Student ID',
            'Student Photo',
            'Photo ID Type'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();

                for ($row = 2; $row <= $highestRow; $row++) {

                    $cellI = "I{$row}";
                    $url1 = $sheet->getCell($cellI)->getValue();
                    if (!empty($url1)) {
                        $sheet->getCell($cellI)->setValue("View");
                        $sheet->getCell($cellI)->getHyperlink()->setUrl($url1);
                    }

                    $cellK = "K{$row}";
                    $url2 = $sheet->getCell($cellK)->getValue();
                    if (!empty($url2)) {
                        $sheet->getCell($cellK)->setValue("View");
                        $sheet->getCell($cellK)->getHyperlink()->setUrl($url2);
                    }
                }
            }
        ];
    }
}
