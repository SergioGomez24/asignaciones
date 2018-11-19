<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
	private function seedCategories(){
		DB::table('categories')->delete();

		$category = new Category;
		$category->name = 'Catedratico';
		$category->rank = '1';
		$category->save();

        $category = new Category;
        $category->name = 'Titular de escuela';
        $category->rank = '2';
        $category->save();

	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedCategories();
		$this->command->info('Tabla categorias inicializada con datos!');
    }
}
