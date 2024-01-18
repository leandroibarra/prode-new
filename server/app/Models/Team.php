<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    /**
	 * The competitions to which the team belongs.
	 */
	public function teamsCompetitions()
	{
		return $this->hasMany('App\Models\TeamCompetition');
	}

	/**
	 * The matches schedules as home team.
	 */
	public function matchesSchedulesHomes()
	{
		return $this->hasMany('App\Models\MatchSchedule', 'home_team_id', 'id');
	}

	/**
	 * The matches schedules as away team.
	 */
	public function matchesSchedulesAways()
	{
		return $this->hasMany('App\Models\MatchSchedule', 'away_team_id', 'id');
	}
}
