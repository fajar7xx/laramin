<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $faker = Faker::create();
        $jumlah = 10;
        $image_categories = ['business', 'city', 'food', 'nature', 'technics', 'transport'];

        for($i=0; $i<=$jumlah; $i++){
            $name = $faker->unique()->word();
            $name = Str::replaceArray('.', [''], $name);
            $slug = Str::slug($name);
            // $category = $image_categories[mt_rand(0, 5)];
            // $image_path = '/opt/lampp/htdocs/laravue-project/larasanctumvue/laramin-be/public/images/categories';
            // $image_fullpath = $faker->image( $image_path, 500, 300, $category, true, true, $category);
            // $image = Str::replaceFirst($image_path . '/', '', $image_fullpath);
            $image = 'https://source.unsplash.com/random/800x600';
            $categories[$i] = [
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'status' => 'PUBLISH',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('categories')->insert($categories);
    }
}
