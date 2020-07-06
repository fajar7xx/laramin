<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [];
        $faker = Faker\Factory::create();
        $jumlah = 100;
        $image_categories = ['business', 'city', 'food', 'technics', 'transport'];
        
        for($i=0; $i<=$jumlah; $i++){
            $title = $faker->sentence(mt_rand(3, 6));
            $title = str_replace('.', '', $title);
            $slug = Str::slug($title);
            // $category = $image_categories[mt_rand(0, 4)];
            // $cover_path = '/opt/lampp/htdocs/laravue-project/larasanctumvue/laramin-be/public/images/books';
            // $cover_fullpath = $faker->image($cover_path, 300, 500, $category, true, true, $category);
            // $cover = Str::replaceFirst($cover_path . '/', '', $cover_fullpath);
            $cover = 'https://source.unsplash.com/random/800x600';           
            $books[$i] = [
                'title' => $title,
                'slug' => $slug,
                'description' => $faker->text(255),
                'author' => $faker->name,
                'publisher' => $faker->company,
                'cover' => $cover,
                'price' => mt_rand(1, 10) * 50000,
                'weight' => 0.75,
                'status' => 'publish',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('books')->insert($books);
    }
}
