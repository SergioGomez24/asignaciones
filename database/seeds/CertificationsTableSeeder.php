<?php

use Illuminate\Database\Seeder;
use App\Certification;

class CertificationsTableSeeder extends Seeder
{
	private function seedCertifications(){
		DB::table('certifications')->delete();

		$c = new Certification;
		$c->name = 'Grado en Ingeniería Informática';
		$c->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCertifications();
		$this->command->info('Tabla titulaciones inicializada con datos!');
    }
}
