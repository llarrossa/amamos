<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'id_pai'
    ];

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }

    // public function pai()
    // {
    //     return $this->belongsTo(Categoria::class, 'id_pai');
    // }
}
