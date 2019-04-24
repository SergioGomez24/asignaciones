<?php

use Illuminate\Database\Seeder;
use App\Center;

class CentersTableSeeder extends Seeder
{
	private function seedCenters(){
		DB::table('centers')->delete();

		$c = new Center;
		$c->name = 'Escuela Superior de Ingeniería';
		$c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCenters();
		$this->command->info('Tabla centros inicializada con datos!');
    }
}
