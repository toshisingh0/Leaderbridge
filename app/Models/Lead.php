<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;


class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'source', 'status',
    ];
}
