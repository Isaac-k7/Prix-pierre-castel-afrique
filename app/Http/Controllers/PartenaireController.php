<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;
use App\Http\Resources\PartenaireResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Media;

class PartenaireController extends Controller
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
        $data = PartenaireResource::collection(Partenaire::paginate(10));
        // dd($data);
         return view("admin.partenaire.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.partenaire.add");
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
        ]);
        $user_id =Auth::id();
        $partenaire = Partenaire::create([
            'user_id'   =>  $user_id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        if ($partenaire) {
            if ($request->hasFile('logo')) {
                $partenaire->addMediaFromRequest('logo')
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('logo_partenaire');
            }
        }

        return redirect(route('partenaire.index'))->with('message', 'Partenaire créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partenaire  $partenaire
     * @return \Illuminate\Http\Response
     */
    public function show(Partenaire $partenaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partenaire  $partenaire
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Partenaire::where('id',$id)->first();
        return view("admin.partenaire.edit", compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partenaire  $partenaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::where('id',$id)->first();
        $partenaire->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        if ($request->hasFile('logo')) {
            $partenaire->clearMediaCollection('logo_partenaire');
            $partenaire->addMediaFromRequest('logo')
            ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
            ->toMediaCollection('logo_partenaire');
        }

        return redirect(route('partenaire.index'))->with('message', 'Partenaire mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partenaire  $partenaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partenaire::find($id)->delete();
        return redirect(route('partenaire.index'))->with('message', 'Partenaire supprimé avec succès');
    }
}
