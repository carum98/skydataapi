<?php

use App\Cliente;
use App\Radio;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $this->call(UsersTableSeeder::class);
        User::truncate();
        Radio::truncate();
        Cliente::truncate();

        User::flushEventListeners();
        Radio::flushEventListeners();
        Cliente::flushEventListeners();
        
        $user = 10;
        $clientes = 5;
        $radios = 15;

        factory(User::class, $user)->create();
        factory(Cliente::class, $clientes)->create();
        factory(Radio::class, $radios)->create();
        // ->each(
        //     function($radio){
        //         $cliente = Cliente::all()->random(at_rand(1, 5))->pluck('id');
        //         $radio->clientes()->attach($cliente->first());
        //     }
        // );
    }
}
