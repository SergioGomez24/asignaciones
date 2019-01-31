<?php

use Illuminate\Database\Seeder;
use App\Durationsubject;

class DurationsubjectsTableSeeder extends Seeder
{
    private function seedDurationsubjects(){
		DB::table('durationsubjects')->delete();

		$c = new Durationsubject;
		$c->name = 'Primer Semestre';
		$c->save();

        $c = new Durationsubject;
        $c->name = 'Segundo Semestre';
        $c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedDurationsubjects();
		$this->command->info('Tabla duracion asignatura inicializada con datos!');
    }
}
