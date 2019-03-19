<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
	private function seedCourses(){
		DB::table('courses')->delete();

		$c = new Course;
		$c->name = '2018-19';
		$c->save();
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCourses();
		$this->command->info('Tabla cursos inicializada con datos!');
    }
}
