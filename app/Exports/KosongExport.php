<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KosongExport implements FromCollection, WithHeadings, WithEvents, WithTitle
{
    public function collection()
    {
        $data = Kategori::where('id', '-1')->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            [
                'Pertanyaan',
                'Jawaban',
                'Kode Kategori (Opsional)',
            ]
        ];
    }

    public function title(): string
    {
        return 'Template';
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

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($bold) {
                $event->sheet->getStyle('A1:C1')->applyFromArray($bold);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25);
            },
        ];
    }
}
