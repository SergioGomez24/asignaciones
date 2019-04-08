<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
		$this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CertificationsTableSeeder::class);
        $this->call(CampusTableSeeder::class);
        $this->call(CentersTableSeeder::class);
        $this->call(CoursesubjectsTableSeeder::class);
        $this->call(DurationsubjectsTableSeeder::class);
        $this->call(TypesubjectsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        //$this->call(PrioritiesTableSeeder::class);
		Model::reguard();
    }
}
