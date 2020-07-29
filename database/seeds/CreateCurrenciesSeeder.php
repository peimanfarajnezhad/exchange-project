<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CreateCurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            ['name' => 'ریال', 'abbr' => 'IRR'],
            ['name' => 'دلار', 'abbr' => 'USD'],
            ['name' => 'یورو', 'abbr' => 'EUR'],
        ]);
    }
}
