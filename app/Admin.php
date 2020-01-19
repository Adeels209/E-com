<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $guard = 'admin';
    protected $redirectTo = '/admin';
    protected $fillable=['name','email','password'];
}
