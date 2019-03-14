<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
	private function seedSubjects(){
		DB::table('subjects')->delete();

		$subject = new Subject;
		$subject->code = '11';
		$subject->name = 'Base de Datos';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 3;
		$subject->cSeminar = 1;
		$subject->cPractice = 2;
		$subject->duration_id = 1;
		$subject->imparted_id = 1;
		$subject->typeSubject_id = 1;
		$subject->coordinator = 'Sergio Gomez';
		$subject->save();

		$subject = new Subject;
		$subject->code = '12';
		$subject->name = 'Programación web';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 3;
		$subject->cSeminar = 1;
		$subject->cPractice = 2;
		$subject->duration_id = 1;
		$subject->imparted_id = 2;
		$subject->typeSubject_id = 2;
		$subject->coordinator = 'Juan Garcia';
		$subject->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedSubjects();
		$this->command->info('Tabla asignaturas inicializada con datos!');
    }
}
