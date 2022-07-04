<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMonthly extends Model
{
    protected $table = 'type_monthlies';

    protected $fillable = ['name', 'value'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'type_monthlies_id', 'id');
    }

}
