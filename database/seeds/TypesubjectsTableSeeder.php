<?php

use Illuminate\Database\Seeder;
use App\Typesubject;

class TypesubjectsTableSeeder extends Seeder
{
    private function seedTypesubjects(){
		DB::table('typesubjects')->delete();

		$c = new Typesubject;
		$c->name = 'Obligatoria';
		$c->save();

        $c = new Typesubject;
        $c->name = 'Optativa';
        $c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedTypesubjects();
		$this->command->info('Tabla tipo asignatura inicializada con datos!');
    }
}
