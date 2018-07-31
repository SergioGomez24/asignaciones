<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{

	private function seedUsers(){
		DB::table('users')->delete();

		$user = new User;
		$user->name = 'jose';
		$user->email = 'jose@jose.com';
		$user->password = bcrypt('hola');
		$user->save();

		$user = new User;
		$user->name = 'manuel';
		$user->email = 'manuel@manuel.com';
		$user->password = bcrypt('hola');
		$user->save();

	}

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
		$this->command->info('Tabla usuarios inicializada con datos!');
    }
}
