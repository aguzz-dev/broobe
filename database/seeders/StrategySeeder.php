<?php

namespace Database\Seeders;

use App\Models\Strategy;
use Illuminate\Database\Seeder;

class StrategySeeder extends Seeder
{
    public function run(): void
    {
        $strategies = ['DESKTOP', 'MOBILE'];

        foreach ($strategies as $strategy) {
            Strategy::firstOrCreate(['name' => $strategy]);
        }
    }
}
