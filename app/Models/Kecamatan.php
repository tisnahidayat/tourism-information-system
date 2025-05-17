<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';
    protected $guarded = ['id'];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'id_kecamatan');
    }
}
