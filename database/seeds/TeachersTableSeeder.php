<?php

use Illuminate\Database\Seeder;
use App\Teacher;

class TeachersTableSeeder extends Seeder
{
	private function seedTeachers(){
		DB::table('teachers')->delete();

		$t = new Teacher;
		$t->name = 'Jose Garcia';
		$t->dni = '11A';
		$t->category = 'Catedratico';
		$t->area = 'Lenguaje y Sistemas Informáticos';
		$t->cInitial = 24;
		$t->dateCategory = '2018-09-20';
		$t->dateUCA = '2018-09-15';
		$t->save();
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedTeachers();
		$this->command->info('Tabla profesores inicializada con datos!');
    }
}
