<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Program extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'programs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'created_by', 'status'];

	public function scopeActive($query) {
        return $query->where('status', 1);
    }
	
	public function projects() {
        return $this->hasMany('App\Models\Project');
    }

	public function getTitleAttribute($value) {
		return ucfirst($value);
	}
}
