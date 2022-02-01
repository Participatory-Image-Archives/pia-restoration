<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Set;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sets/create', ['collections' => Collection::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->collection_id){
            $collection = Collection::find($request->collection_id);
        } else {
            $collection = Collection::create([
                'origin' => 'restoration',
                'label' => $request->collection_label ?? $request->label
            ]);
        }

        $set = Set::create([
            'label' => $request->label,
            'description' => $request->description,
            'signatures' => $request->signatures,
            'collection_id' => $collection->id
        ]);

        return redirect()->route('sets.edit', [$set]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('sets/update', [
            'set' => Set::find($id),
            'collection' => Set::find($id)->collection,
            'collections' => Collection::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->collection_id){
            $collection = Collection::find($request->collection_id);
        } else {
            $collection = Collection::create([
                'origin' => 'restoration',
                'label' => $request->collection_label ?? $request->label
            ]);
        }

        $set = Set::find($id);

        $set->label = $request->label;
        $set->description = $request->description;
        $set->signatures = $request->signatures;
        $set->collection_id = $collection->id;

        $set->save();

        return redirect()->route('sets.edit', [$set]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
