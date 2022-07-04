<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class,1)->create();
    }
}
