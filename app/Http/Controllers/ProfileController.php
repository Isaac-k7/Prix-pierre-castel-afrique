<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Providers\RouteServiceProvider;
use App\Models\User;


class ProfileController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
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

    public function editCandidat(Request $request): View
    {
        return view('profile.edit-candidat', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       // dd($request);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
       $user = User::find($request->user()->id);
        //dd($request->user()->id);
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar_user');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar_user');
        }
        $rollen = auth()->user()->role->slug;
       
        switch($rollen){
            case 'admin':
                return redirect()->intended(RouteServiceProvider::HOME);
                break;
            case 'filiale':
                return redirect()->intended(RouteServiceProvider::HOME);
                break;/*    */
            case 'candidat':
                return redirect()->intended(RouteServiceProvider::CANDIDAT);
                break;
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }

        /* return Redirect::route('profile.edit')->with('status', 'profile-updated'); */
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
