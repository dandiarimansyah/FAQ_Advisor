<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    use HasFactory;

    protected $table = 'komen';

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_faqs', 'id');
    }
}
