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
		$subject->certification = 'Grado en Ingeniería Informática';
		$subject->area = 'Lenguaje y Sistemas Informáticos';
		$subject->campus = 'Campus de Puerto Real';
		$subject->center = 'Escuela Superior de Ingeniería';
		$subject->cTheory = 3;
		$subject->cSeminar = 1;
		$subject->cPractice = 2;
		$subject->duration = 'Primer Semestre';
		$subject->imparted = 'Segundo';
		$subject->typeSubject = 'Obligatoria';
		$subject->coordinator = 'Jose Garcia';
		$subject->save();

		$subject = new Subject;
		$subject->code = '12';
		$subject->name = 'Programación web';
		$subject->certification = 'Grado en Ingeniería Informática';
		$subject->area = 'Lenguaje y Sistemas Informáticos';
		$subject->campus = 'Campus de Puerto Real';
		$subject->center = 'Escuela Superior de Ingeniería';
		$subject->cTheory = 3;
		$subject->cSeminar = 1;
		$subject->cPractice = 2;
		$subject->duration = 'Primer Semestre';
		$subject->imparted = 'Segundo';
		$subject->typeSubject = 'Obligatoria';
		$subject->coordinator = 'Sergio Gomez';
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
