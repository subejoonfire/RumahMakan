<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'barang';
    protected $primaryKey = 'idbarang';
    protected $fillable = [
        'nmbarang',
        'stok',
        'harga',
        'kategori',
        'status'
    ];
}
