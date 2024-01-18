<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (
            [
                ['ARG', 'Argentina'],
                ['AUS', 'Australia'],
                ['BEL', 'Belgium'],
                ['BRA', 'Brazil'],
                ['CHE', 'Switzerland'],
                ['COL', 'Colombia'],
                ['CRI', 'Costa Rica'],
                ['DEU', 'Germany'],
                ['DNK', 'Denmark'],
                ['EGY', 'Egypt'],
                ['ENG', 'England'],
                ['ESP', 'Spain'],
                ['FRA', 'France'],
                ['HRV', 'Croatia'],
                ['IRN', 'Iran'],
                ['ISL', 'Iceland'],
                ['JPN', 'Japan'],
                ['KOR', 'South Korea'],
                ['MAR', 'Morocco'],
                ['MEX', 'Mexico'],
                ['NGA', 'Nigeria'],
                ['PAN', 'Panama'],
                ['PER', 'Peru'],
                ['POL', 'Poland'],
                ['PRT', 'Portugal'],
                ['RUS', 'Russia'],
                ['SAU', 'Saudi Arabia'],
                ['SEN', 'Senegal'],
                ['SRB', 'Serbia'],
                ['SWE', 'Sweden'],
                ['TUN', 'Tunisia'],
                ['URY', 'Uruguay'],
                ['BOL', 'Bolivia'],
                ['QAT', 'Qatar'],
                ['CHL', 'Chile'],
                ['ECU', 'Ecuador'],
                ['PRY', 'Paraguay'],
                ['VEN', 'Venezuela'],
                ['NLD', 'Netherlands'],
                ['USA', 'United States'],
                ['WLS', 'Wales'],
                ['CAN', 'Canada'],
                ['CMR', 'Cameroon'],
                ['GHA', 'Ghana'],
            ] as $team
        )
			Team::create([
                'code' => $team[0],
				'name' => $team[1],
			]);
    }
}
