<?php

use Illuminate\Database\Seeder;
use App\Coursesubject;

class CoursesubjectsTableSeeder extends Seeder
{
	private function seedCoursesubjects(){
		DB::table('coursesubjects')->delete();

		$c = new Coursesubject;
		$c->name = 'Primer Curso';
		$c->save();

        $c = new Coursesubject;
        $c->name = 'Segundo Curso';
        $c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCoursesubjects();
		$this->command->info('Tabla curso asignatura inicializada con datos!');
    }
}