<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'content',
        'owner_id',
    ];

    // Lead relation
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // Owner relation
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}

