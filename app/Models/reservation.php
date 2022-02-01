<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class reservation extends Model{
    
    use HasFactory,SoftDeletes;

    public $costPerHour = 150;

    protected $appends = ['cost',"canceled_at"];

    protected $fillable = [
        'resDate',
        "init_hour",
        "end_hour"
    ];

    public function getCostAttribute(){
        return $this->hours() * $this->costPerHour;
    }

    public function getCanceledAtAttribute(){
        return Carbon::parse($this->deleted_at)->format("y-m-d h:m:ss");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservationToRefound()
    {
        return $this->hasOne(reservationToRefound::class);
    }

    public function makeFullRefound(){
        $this->refound([
            "canceled_by"=>"Administración",
            "amount"=>$this->getCostAttribute()
        ]);
    
        $this->delete();

    }

    public function refoundOrDelete(){
        if ($this->payment_verified){
            $this->refound([
                "canceled_by"=>"Usuario",
                "amount"=>$this->getRefound()
            ]);
            
        }

        $this->delete();
    }

    protected function refound($specs){
        $this->reservationToRefound()->create($specs);
    }

    public function getRefoundmhy(){
        $refoundPenalization  = 50;
        $diffInDays = Carbon::parse($this->resDate)->diffInDays(Carbon::now()->format('Y-m-d'));

        if($diffInDays == 0)
            $refoundPenalization+=200;
        else if($diffInDays == 1)
            $refoundPenalization+=100;

        return $this->cost - $refoundPenalization;
    }

    public function hours(){
        return ceil(Carbon::parse($this->init_hour)->floatDiffInMinutes($this->end_hour));
    }

}
