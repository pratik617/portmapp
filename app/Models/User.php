<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'first_name', 'last_name', 'email', 'password', 'phone_number', 'address', 'created_by', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function getFirstNameAttribute($value) {
		return ucfirst($value);
	}

	public function getLastNameAttribute($value) {
		return ucfirst($value);
	}
	
	public function getFullNameAttribute() {
		return ucfirst("{$this->first_name}").' '.ucfirst("{$this->last_name}");
	}
	
	public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }
	
    public function role() {
        return $this->belongsTo('App\Models\Role');
    }

}
