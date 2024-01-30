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
use App\Http\Resources\FilialeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class FilialeController extends Controller
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
        $data = FilialeResource::collection(Filiale::paginate(10));
       // dd($data);
        return view("admin.filiale.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Pays::get();
        return view("admin.filiale.add", compact('data'));
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
        $role = UserRole::where('slug','filiale')->first();
        $user = User::create([
            'role_id'   =>  $role->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
        ]);

        if ($user) {
            if ($request->hasFile('avatar')) {
                $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar_user');
            }

            $filiale = Filiale::create([
                'user_id'   =>  $user->id,
                'pays_id' => $request->pays_id
            ]);
        }

        event(new Registered($user));
        return redirect(route('filiale.index'))->with('message', 'Filiale créée avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filiale  $filiale
     * @return \Illuminate\Http\Response
     */
    public function show(Filiale $filiale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filiale  $filiale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Filiale::with('users')->with('pays')->where('id',$id)->first();
       
        $datapays = Pays::get();
        return view("admin.filiale.edit", compact(['data','datapays']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filiale  $filiale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // die($request);
      
        $filiale = Filiale::with('users')->with('pays')->where('id',$id)->first();
        $filiale->update([
            'pays_id' => $request->pays_id
        ]);

        $user = User::find($filiale->users->id);
        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
            ]);
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
       

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar_user');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar_user');
        }

        return redirect(route('filiale.index'))->with('message', 'Filiale mise à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filiale  $filiale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Filiale::find($id)->delete();
        return redirect(route('filiale.index'))->with('message', 'Filiale supprimée avec succès');
    }
}
