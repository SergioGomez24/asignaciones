<?php

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritiesTableSeeder extends Seeder
{
	private function seedPriorities(){
		DB::table('priorities')->delete();

		$priorities = DB::table('categories')
        	->join('teachers','teachers.category_id', '=', 'categories.id')
			->select('categories.rank','teachers.name','teachers.dateCategory', 'teachers.cInitial')
			->orderBy('categories.rank', 'ASC','teachers.dateCategory')
			->get();

		foreach ($priorities as $key => $prioridad) {
			$p = new Priority;
			$p->priority = $prioridad->rank;
			$p->teacher = $prioridad->name;
			$p->dateCategory = $prioridad->dateCategory;
			$p->course = "2018-19";
			$p->cAvailable = $prioridad->cInitial;
			$p->save();
		}

	}

	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		self::seedPriorities();
		$this->command->info('Tabla prioridades inicializada con datos!');
    }
}
