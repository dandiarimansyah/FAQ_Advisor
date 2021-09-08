<?php

namespace App\Imports;

use App\Models\Pertanyaan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class FaqImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 1 && $row[0] && $row[1] != null) {

                $data = new Pertanyaan();
                $data->pertanyaan = $row[0];
                $data->jawaban = $row[1];
                $data->save();

                $data->kategori()->sync($row[2]);
            }
        }
    }
}
