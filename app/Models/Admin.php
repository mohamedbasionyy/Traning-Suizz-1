<?php

namespace App\Models;

//use App\Models\Admin::getJWTIdentifier;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable  implements JWTSubject
{
    //use HasApiTokens, Notifiable, HasFactory;
     
    protected $table ='admins';

    protected $fillable = [
        'name', 'email', 'password'
    ];



    public function getJWTIdentifier()
    {
        return $this->getKey();
    }



    public function getJWTCustomClaims(): array
    {
        // Return any custom claims you want to add to the JWT token
        return [];
    }

    /*protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
