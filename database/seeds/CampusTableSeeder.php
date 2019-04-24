<?php

use Illuminate\Database\Seeder;
use App\Campus;

class CampusTableSeeder extends Seeder
{
	private function seedCampus(){
		DB::table('campus')->delete();

		$c = new Campus;
		$c->name = 'Campus de Puerto Real';
		$c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCampus();
		$this->command->info('Tabla campus inicializada con datos!');
    }
}
