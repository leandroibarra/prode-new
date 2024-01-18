<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (
            [
                'Group A', 'Group B', 'Group C', 'Group D',
                'Group E', 'Group F', 'Group G', 'Group H',
            ] as $group
        )
			Group::create([
				'name' => $group,
			]);
    }
}
