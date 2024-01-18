<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

	/**
	 * The matches schedules assigned to the instance.
	 */
	public function matchesSchedules()
	{
		return $this->hasMany('App\Models\MatchSchedule');
	}
}
