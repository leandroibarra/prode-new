<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instance;

class InstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (
            [
                'Group Phase', 'Round of 16', 'Quarter-finals',
                'Semi-finals', 'Play-off for third place', 'Final',
            ] as $instance
        )
			Instance::create([
				'name' => $instance,
			]);
    }
}
