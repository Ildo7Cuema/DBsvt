<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto',
        'idCategoria',
        'preco',
        'quant',
    ];

    public function withCategoria(){
        return $this->hasMany(categoria::class, 'id', 'idCategoria');
    }
}
