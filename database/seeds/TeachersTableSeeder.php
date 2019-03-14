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
		$t->user_id = 1;
		$t->category_id = 1;
		$t->area_id = 1;
		$t->cInitial = 24;
		$t->dateCategory = '2018-09-20';
		$t->dateUCA = '2018-09-15';
		$t->save();

		$t = new Teacher;
		$t->name = 'Sergio Gomez';
		$t->dni = '12A';
		$t->user_id = 2;
		$t->category_id = 2;
		$t->area_id = 1;
		$t->cInitial = 24;
		$t->dateCategory = '2018-09-21';
		$t->dateUCA = '2018-09-16';
		$t->save();

		$t = new Teacher;
		$t->name = 'Juan Gomez';
		$t->dni = '13A';
		$t->user_id = 3;
		$t->category_id = 2;
		$t->area_id = 1;
		$t->cInitial = 24;
		$t->dateCategory = '2018-09-22';
		$t->dateUCA = '2018-09-17';
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
