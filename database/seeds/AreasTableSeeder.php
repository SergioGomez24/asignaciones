<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreasTableSeeder extends Seeder
{
	private function seedAreas(){
		DB::table('areas')->delete();

		$area = new Area;
		$area->name = 'Lenguaje y Sistemas Informáticos';
		$area->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedAreas();
		$this->command->info('Tabla areas inicializada con datos!');
    }
}
