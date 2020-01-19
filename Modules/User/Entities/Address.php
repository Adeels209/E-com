<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [];

    public function address()
    {
        return $this->hasOne(Address::class,'user_id','id');
    }
}
