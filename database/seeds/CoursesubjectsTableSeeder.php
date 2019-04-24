<?php

use Illuminate\Database\Seeder;
use App\Coursesubject;

class CoursesubjectsTableSeeder extends Seeder
{
	private function seedCoursesubjects(){
		DB::table('coursesubjects')->delete();

		$c = new Coursesubject;
		$c->name = 'Primero';
		$c->save();

        $c = new Coursesubject;
        $c->name = 'Segundo';
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