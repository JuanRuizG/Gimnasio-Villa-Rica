<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','phone','email','type_identification','identification','key_identification','price',
        'initial_date','type_monthlies_id','expiration_date'
    ];

    protected $dates = [
        'expiration_date','initial_date'
    ];

    public function scopeIdentification($query, $identification)
    {
        if ($identification) {
            return $query->where('identification',$identification);
        }
    }

    public function scopeKeyIdentification($query, $KeyIdentification)
    {
        if ($KeyIdentification) {
            return $query->where('key_identification',$KeyIdentification);
        }
    }

    public function typemonthlies()
    {
        return $this->belongsTo(TypeMonthly::class, 'type_monthlies_id', 'id');
    }
    //  Accessors
    public function getInitialDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getExpirationDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

//
    public function setInitialDateAttribute($value)
    {
        $this->attributes['initial_date'] = $value;
    }

    public function setIdentificationAttribute($value)
    {
        $this->attributes['identification'] = $value;
        $this->attributes['key_identification'] = substr($value,-4);
    }

    // public function setTypeMonthlyPayAttribute($value)
    // {
    //     $this->attributes['type_monthly_pay'] = $value;

    //     if ($value == 'Mensual') {
    //         $this->attributes['price'] = 35000;
    //         $this->attributes['expiration_date'] = Carbon::parse($this->initial_date)->addMonth(1);
    //     } else if ($value == 'Bimestral')
    //     {
    //         $this->attributes['price'] = 35000 * 2;
    //         $this->attributes['expiration_date'] = Carbon::parse($this->initial_date)->addMonth(2);
    //     } else if ($value == 'Trimestral')
    //     {
    //         $this->attributes['price'] = 35000 * 3;
    //         $this->attributes['expiration_date'] = Carbon::parse($this->initial_date)->addMonth(3);
    //     }
    // }

    public function getDaysRemaining()
    {
        $today = Carbon::now();
        return Carbon::parse($this->expiration_date)->diffInDays($today);
    }
}
