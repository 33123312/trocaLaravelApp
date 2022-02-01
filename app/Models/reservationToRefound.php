<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class reservationToRefound extends Model{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "amount",
        "canceled_at",
        "canceled_by",
        "refounded_at",
        "reservation_id"
    ];

    public function reservation(){
        return $this->belongsTo(reservation::class)->withTrashed();
    }

    
}
