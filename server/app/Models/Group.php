<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
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
	 * The competitions to which the group belongs.
	 */
	public function teamsCompetitions()
	{
		return $this->hasMany('App\Models\TeamCompetition');
	}

	/**
	 * The matches schedules assigned to the group.
	 */
	public function matchesSchedules()
	{
		return $this->hasMany('App\Models\MatchSchedule');
	}
}
