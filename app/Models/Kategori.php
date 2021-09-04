<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    public function pertanyaan()
    {
        return $this->belongsToMany(Pertanyaan::class, 'faqs_kategori', 'kategori_id', 'faqs_id');
    }
}
