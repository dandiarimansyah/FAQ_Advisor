<?php

namespace App\Exports;

use App\Models\Kategori;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KategoriExport implements FromCollection, WithMapping, WithHeadings, WithTitle, WithEvents
{
    public function collection()
    {
        $data = Kategori::all();

        return $data;
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->kategori
        ];
    }

    public function headings(): array
    {
        return [
            [
                'Kode',
                'Kategori',
            ]
        ];
    }

    public function title(): string
    {
        return 'List Kategori';
    }

    public function registerEvents(): array
    {

        $bold = [
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use ($bold, $center) {
                $event->sheet->getStyle('A1:B1')->applyFromArray($bold);
                $event->sheet->getStyle('A')->applyFromArray($center);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
            }
        ];
    }
}
