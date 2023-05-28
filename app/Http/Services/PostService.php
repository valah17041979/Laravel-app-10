<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostService
{
    public function getById()

    {
    	 $posts = Post::where('status', 0)->paginate(10);

         return $posts;

    }

    public function get_image_Unsplash()

       {

         $url = 'https://api.unsplash.com/photos/random?client_id=7mFBUmY97yJCkm8V99ze-g6U7R29eIYQWAstfXHhYwc';

         $data   = file_get_contents($url);

         $contents = json_decode(html_entity_decode($data), TRUE);

         return $contents['urls']['raw'];
       }
 }   