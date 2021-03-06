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
		$subject->coordinator_id = 2;
		$subject->save();

		$subject = new Subject;
		$subject->code = '12';
		$subject->name = 'Programación Web';
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
		$subject->coordinator_id = 3;
		$subject->save();

		$subject = new Subject;
		$subject->code = '13';
		$subject->name = 'Matemáticas Discreta';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 2;
		$subject->cSeminar = 1;
		$subject->cPractice = 3;
		$subject->duration_id = 2;
		$subject->imparted_id = 2;
		$subject->typeSubject_id = 2;
		$subject->coordinator_id = 3;
		$subject->save();

		$subject = new Subject;
		$subject->code = '14';
		$subject->name = 'Redes de Computadores';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 2;
		$subject->cSeminar = 2;
		$subject->cPractice = 2;
		$subject->duration_id = 1;
		$subject->imparted_id = 1;
		$subject->typeSubject_id = 1;
		$subject->coordinator_id = 2;
		$subject->save();

		$subject = new Subject;
		$subject->code = '15';
		$subject->name = 'Programación Orientada a Objetos';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 3;
		$subject->cSeminar = 2;
		$subject->cPractice = 1;
		$subject->duration_id = 2;
		$subject->imparted_id = 1;
		$subject->typeSubject_id = 1;
		$subject->coordinator_id = 3;
		$subject->save();

		$subject = new Subject;
		$subject->code = '16';
		$subject->name = 'Administración de Servidores';
		$subject->certification_id = 1;
		$subject->area_id = 1;
		$subject->campus_id = 1;
		$subject->center_id = 1;
		$subject->cTheory = 3;
		$subject->cSeminar = 1;
		$subject->cPractice = 2;
		$subject->duration_id = 2;
		$subject->imparted_id = 2;
		$subject->typeSubject_id = 2;
		$subject->coordinator_id = 2;
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
