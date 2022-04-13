<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrain extends Model
{
    use HasFactory;

    public $fillable = ['first_name', 'last_name', 'nce', 'nin', 'taille', 'phone'];
}
