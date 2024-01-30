<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use App\Http\Resources\EditionResource;


class EditionController extends Controller
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
        $data = EditionResource::collection(Edition::paginate(10));
        return view("admin.edition.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.edition.add");
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
            "year" => "required",
            "status" => "required"
         ]);
        $edition = Edition::create([
            'name' => $request['name'],
            'year' => $request['year'],
            'status' => $request['status']
        ]);
        return redirect(route('edition.index'))->with('message', 'Edition créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Edition::find($id);
        return view("admin.edition.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // die($request);
        $edition = Edition::find($id);
        $this->validate($request, [
            "name" => "required",
            "year" => "required",
            "status" => "required"
         ]);
         $edition->update([
            'name' => $request['name'],
            'year' => $request['year'],
            'status' => $request['status'],
        ]);
        return redirect(route('edition.index'))->with('message', 'Édition mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Edition::find($id)->delete();
        return redirect(route('edition.index'))->with('message', 'Édition supprimée avec succès');
    }
}
