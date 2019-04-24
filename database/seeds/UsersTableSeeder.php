<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{

	private function seedUsers(){
		DB::table('users')->delete();

		$user = new User;
		$user->name = 'José García';
		$user->email = 'jose@jose.com';
		$user->password = bcrypt('hola');
		$user->role = 'Director';
		$user->remember_token = '';
		$user->save();

		$user = new User;
		$user->name = 'Sergio Gómez';
		$user->email = 'sergio@sergio.com';
		$user->password = bcrypt('hola');
		$user->role = 'Profesor';
		$user->remember_token = '';
		$user->save();

		$user = new User;
		$user->name = 'Juan Gómez';
		$user->email = 'juan@juan.com';
		$user->password = bcrypt('hola');
		$user->role = 'Profesor';
		$user->remember_token = '';
		$user->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
		$this->command->info('Tabla usuarios inicializada con datos!');
    }
}
