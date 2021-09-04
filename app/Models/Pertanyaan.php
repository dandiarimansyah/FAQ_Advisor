<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    public function kategori()
    {
    	return $this->belongsToMany(Kategori::class, 'faqs_kategori', 'faqs_id', 'kategori_id');
	}
}
