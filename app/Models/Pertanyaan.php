<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'faqs';


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('pertanyaan', 'like', '%' . $search . '%')
                ->orWhere('jawaban', 'like', '%' . $search . '%');
        });
    }

    // public function scopeKategori($query, array $filters)
    // {
    //     $query->when($filters['pilih_kategori'] ?? false, function ($query, $pilih_kategori) {
    //         return $query->whereHas('kategori', function ($q) use ($pilih_kategori) {
    //             $q->whereIn('kategori_id', $pilih_kategori);
    //         });
    //     });
    // }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'faqs_kategori', 'faqs_id', 'kategori_id');
    }

    public function komen()
    {
        return $this->hasMany(Komen::class, 'id', 'id_faqs');
    }
}
