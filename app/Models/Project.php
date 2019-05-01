<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

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
    protected $fillable = ['program_id', 'title', 'start_at', 'end_at', 'created_by', 'status'];
	
	public function scopeActive($query) {
        return $query->where('status', 1);
    }

    public function program() {
        return $this->belongsTo('App\Models\Program');
    }
	
	public function setStartAtAttribute($value) {
		$this->attributes['start_at'] = Carbon::createFromFormat('d/m/Y',$value);
    }

	public function setEndAtAttribute($value) {
        $this->attributes['end_at'] = Carbon::createFromFormat('d/m/Y',$value);
    }
	
	public function getStartAtAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}
	
	public function getEndAtAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}
	
	public function getTitleAttribute($value) {
		return ucfirst($value);
	}
}
