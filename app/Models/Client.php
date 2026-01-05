<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Client extends Model
{
    use HasFactory;
   protected $fillable = [
    'name',
    'company',
    'email',
    'phone',
    'source',
    'notes',
    'owner_id',
    ];

    protected $casts = [
        'meta' => 'array',
    ];



    public function leads() {
        return $this->hasMany(Lead::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
