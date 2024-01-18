<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (
            [
                '2018 FIFA World Cup Russia',
                '2019 American Cup Brazil',
                '2021 American Cup Brazil',
                '2022 FIFA World Cup Qatar',
            ] as $competition)
			Competition::create([
				'name' => $competition,
			]);
    }
}
