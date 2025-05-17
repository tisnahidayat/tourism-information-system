<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = ['id_user', 'subject', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
