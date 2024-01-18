<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CompetitionSeeder::class,
            GroupSeeder::class,
            InstanceSeeder::class,
            TeamSeeder::class,
            TeamCompetitionSeeder::class,
            MatchScheduleSeeder::class,
        ]);
    }
}
