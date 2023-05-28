<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Services\PostService;
use Validator;
use App\Models\Post;

class PostController extends Controller
{

     private $postService;
    /**
     * DriverController constructor.
     *
     * @param \App\Http\Services\PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = $this->postService->getById();

        return view('posts.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $input = $request->except('_token');

          if(!isset($input->photo)){

              $input['photo'] = $this->postService->get_image_Unsplash();

          }

          $validator = Validator::make($input,
            [
              'name' => ['required','string', 'max:255'],
              'description' => ['required','string', 'max:1000'],
              'photo' => ['string', 'max:255'],
              'status' => ['numeric'],
             ]);

            if($validator->fails()){
                return redirect()->back()->with('status','Введите корректные данные ');
            }

          Post::create($input);

          return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

       if($request->img == 111){

              $request['photo'] = $this->postService->get_image_Unsplash();
       }

       $input = $request->all();

       $validator = Validator::make($input,
            [
              'name' => ['required','string', 'max:255'],
              'description' => ['required','string', 'max:1000'],
              'photo' => ['string', 'max:1255'],
              'status' => ['numeric'],
             ]);

            if($validator->fails()){
                return redirect()->back()->with('status','Введите корректные данные ');
            }

        $post->update($input);

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        if ($post->status == 0) {

        $post->status = 1;

        $post->update();

    }
      // $post->delete();
       return redirect()->route('posts.index');
    }
}
