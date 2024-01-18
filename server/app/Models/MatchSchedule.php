<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchSchedule extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'matches_schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'competition_id',
        'instance_id',
        'group_id',
		'match_day',
        'home_team_id',
        'away_team_id',
        'home_goals',
        'away_goals',
        'extra_time',
        'penalties_kicks',
        'home_goals_penalties',
        'away_goals_penalties',
        'final_result',
        'utc_datetime',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

	/**
	 * The competition to which the record belongs.
	 */
	public function competition()
	{
		return $this->hasOne('App\Models\Competition', 'id', 'competition_id');
	}

	/**
	 * The instance to which the record belongs.
	 */
	public function instance()
	{
		return $this->hasOne('App\Models\Instance', 'id', 'instance_id');
	}

	/**
	 * The group to which the record belongs.
	 */
	public function group()
	{
		return $this->hasOne('App\Models\Group', 'id', 'group_id');
	}

	/**
	 * The home team to which the record belongs.
	 */
	public function homeTeam()
	{
		return $this->hasOne('App\Models\Team', 'id', 'home_team_id');
	}

	/**
	 * The away team to which the record belongs.
	 */
	public function awayTeam()
	{
		return $this->hasOne('App\Models\Team', 'id', 'away_team_id');
	}
}
