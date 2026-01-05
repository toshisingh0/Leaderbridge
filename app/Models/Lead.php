<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;


class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'source','status','follow_up_date','client_id',
    ];
    


    public function client() {
        return $this->belongsTo(Client::class);
    }

      public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }


    protected $casts = [
    'follow_up_date' => 'datetime',
    ];


    const STATUS_NEW = 'new';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_INTERESTED = 'interested';
    const STATUS_CLOSED = 'closed';

    public static function getStatuses() {
        return [
            self::STATUS_NEW,
            self::STATUS_CONTACTED,
            self::STATUS_INTERESTED,
            self::STATUS_CLOSED,
        ];
    }

}
