<?php

use App\TypeMonthly;
use Illuminate\Database\Seeder;

class TypeMonthlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeMonthly::create(['name' => 'Mensual', 'value' => 35000]);
        TypeMonthly::create(['name' => 'Quincenal', 'value' => 20000]);
        TypeMonthly::create(['name' => 'Semanal', 'value' => 15000]);
        TypeMonthly::create(['name' => 'Sesion', 'value' => 5000]);
    }
}
