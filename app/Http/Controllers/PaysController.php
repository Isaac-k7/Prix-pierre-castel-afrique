<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;
use App\Http\Resources\PaysResource;



class PaysController extends Controller
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
        $pays = PaysResource::collection(Pays::paginate(10));
        return view("admin.pays.index", compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pays.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "code" => "required"
         ]);
        $pays = Pays::create([
            'name' => $request['name'],
            'code' => $request['code'],
        ]);
        return redirect(route('pays.index'))->with('message', 'Pays créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function show(Pays $pays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function edit(Pays $pays,$id)
    {
        $paysData = Pays::find(decrypt($id));
        return view("admin.pays.edit", compact('paysData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pays = Pays::find($id);
        $this->validate($request, [
            "name" => "required",
            "code" => "required"
         ]);
         $pays->update([
            'name' => $request['name'],
            'code' => $request['code'],
        ]);
        return redirect(route('pays.index'))->with('message', 'Pays mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pays::find($id)->delete();
        return redirect(route('pays.index'))->with('message', 'Pays supprimé avec succès');
    }
}
