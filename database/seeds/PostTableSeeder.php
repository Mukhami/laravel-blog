<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Post([
            'title' => 'Learning Laravel',
            'content' => 'This is a new blog post'
        ]);
        $post->save();

        $post = new \App\Post([
            'title' => 'Learning Laravel',
            'content' => 'This is a new blog post'
        ]);
        $post->save();
    }
}
