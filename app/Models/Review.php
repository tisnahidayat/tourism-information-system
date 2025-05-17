<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['id_user', 'id_wisata', 'rating', 'review'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'id_wisata', 'id');
    }
}
