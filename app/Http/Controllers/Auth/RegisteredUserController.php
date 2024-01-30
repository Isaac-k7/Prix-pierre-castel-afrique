<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Media;
use Carbon\Carbon;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'email.unique' => 'L\'email a déja été pris.',
            'password.confirmed' => 'Le mot de passe ne correspond pas',
        ]);
        $role = UserRole::where('slug','admin')->first();
        $user = User::create([
            'role_id'   =>  $role->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
        ]);
        event(new Registered($user));

       // Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }

 /**
     * Display the registration view.
     */
    public function candidatView(): View
    {
        return view('auth.register-candidat');
    }


    public function registerCandidat(Request $request): RedirectResponse
    {
       //dd($request['_token']);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required'],
            'nationalite' => ['required'],
        ],
        [
            'email.unique' => 'L\'email a déja été pris.',
            'password.confirmed' => 'Le mot de passe ne correspond pas',
            'phone.required' => 'Veuillez entrer un numéro de téléphone',
            'nationalite.required' => 'Veuillez sélectionner un pays',
        ]);
        $role = UserRole::where('slug','candidat')->first();
        $user = User::create([
            'role_id'   =>  $role->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
            'birthday' =>Carbon::parse($request->birthday)->format('Y-m-d'),
            'phone' =>$request->phone,
            'address' =>$request->address,
            'nationalite' =>$request->nationalite,
            'conditions' =>$request->conditions,
        ]);
        if ($user) {
            if ($request->hasFile('avatar')) {
                $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar_user');
            }
            # code...
        }
      
        event(new Registered($user));

        return redirect(route('login'))->with('success', 'Un email de validation de votre compte a été envoyé, veuillez verifier et valider');
    }
}
