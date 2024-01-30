<?php

namespace App\Http\Controllers;

use App\Models\Filiale;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Pays;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserResource::collection(User::paginate(10));
       // dd($data);
        return view("admin.users.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays = Pays::get();
        $role = UserRole::get();
        return view("admin.users.add", compact(['pays','role']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
       
        $user = User::create([
            'role_id'   => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
        ]);

        if ($user) {
            if ($request->hasFile('avatar')) {
                $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar_user');
            }

        }

        event(new Registered($user));
        return redirect(route('users.index'))->with('message', 'Utilisateur créé avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = UserResource::collection(User::find($id)->paginate(10));
        return view("admin.users.show", compact(['data']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('role')->where('id',$id)->first();
       
        $pays = Pays::get();
        $role = UserRole::get();
        return view("admin.users.edit", compact(['data','pays','role']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // die($request);
      
        $user = User::find($id);
        if ($request->password) {
            $user->update([
                'role_id'   => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
            ]);
        }else{
            $user->update([
                'role_id'   => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar_user');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar_user');
        }

        return redirect(route('users.index'))->with('message', 'Utilisateur mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('users.index'))->with('message', 'Utilisateur supprimé avec succès');
    }
}
