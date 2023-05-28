<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\DeletedAccounts;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
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

        return view('profile.index',compact('posts'));

    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {

       $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

         if(!is_null($request->user()->avatar) && $request->has('avatar')){

             $file_name =  $request->file('avatar');

             $file_name = $file_name->getClientOriginalName();

             $params = $request->all();

             $params['avatar'] = time().'_'.$file_name;

             $request->file('avatar')->move(public_path().'/avatars/'.$request["email"].'/',time().'_'.$file_name);

             $request->user()->update($params);

        } else {

             $request->user()->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

      $data = [

         'name' => $user->name,
         'email' => $user->email,
         'avatar' => $user->avatar,
         'status' => 1,
         'is_admin' => $user->is_admin,
         'created_user_date' => $user->created_at,
         'email_verified_at' => $user->email_verified_at,
         'password' => $user->password,
         'remember_token' => $user->remember_token,

      ];

        DeletedAccounts::create($data);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
