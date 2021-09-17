<?php

namespace App\Imports;

use App\Models\Pertanyaan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class FaqImport implements ToCollection, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 1 && $row[0] && $row[1] != null) {

                $data = new Pertanyaan();
                $data->pertanyaan = $row[0];
                $data->jawaban = $row[1];
                $data->save();

                $kategori = preg_split("/\,/", $row[2]);
                $data->kategori()->sync($kategori);
            }
        }
    }
}
