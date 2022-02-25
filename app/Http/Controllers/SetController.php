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
        return view('sets/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $set = Set::create([
            'label' => $request->label,
            'description' => $request->description,
            'signatures' => $request->signatures
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
            'set' => Set::find($id)
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
        $set = Set::find($id);

        $set->label = $request->label;
        $set->description = $request->description;
        $set->signatures = $request->signatures;

        $set->save();

        return redirect()->route('sets.edit', [$set]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadDocuments(Request $request, $id)
    {
        $set = Set::find($id);

        if($files = $request->file('documents')){
            foreach($files as $file){

                $label = implode('.', explode('.', $file->getClientOriginalName(), -1));
                $original_file_name = $file->getClientOriginalName();
                $file_name = time().'_'.$original_file_name;
                $base_path = 'documents';

                $document = $set->documents()->create([
                    'label' => $label,
                    'comment' => $request->comment,
                    'file_name' => $file_name,
                    'original_file_name' => $original_file_name,
                    'base_path' => $base_path,
                ]);

                $file->storeAs(
                    'public/'.$base_path, $file_name
                );
            }
        }

        return redirect()->route('sets.edit', [$set->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Set::destroy($id);

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quickCreate()
    {
        return view('sets/quick-create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quickStore(Request $request)
    {
        $set = Set::create([
            'label' => date('d.m.Y H:i'),
            'description' => $request->description,
            'signatures' => $request->signatures
        ]);

        $set->save();

        foreach($request->all() as $key => $input) {
            if(strpos($key, 'image_') !== false){
                $image_id = $request->input('image_'.$input);

                if($request->file('document_'.$image_id)){
                    $file = $request->file('document_'.$image_id);
                    $label = implode('.', explode('.', $file->getClientOriginalName(), -1));
                    $original_file_name = $file->getClientOriginalName();
                    $file_name = time().'_'.$original_file_name;
                    $base_path = 'documents';

                    $document = $set->documents()->create([
                        'label' => $label,
                        'comment' => $request->input('comment_'.$image_id),
                        'file_name' => $file_name,
                        'original_file_name' => $original_file_name,
                        'base_path' => $base_path,
                    ]);

                    $file->storeAs(
                        'public/'.$base_path, $file_name
                    );
                }
            }
        }

        /*if($files = $request->file('documents')){
            foreach($files as $file){

                $label = implode('.', explode('.', $file->getClientOriginalName(), -1));
                $original_file_name = $file->getClientOriginalName();
                $file_name = time().'_'.$original_file_name;
                $base_path = 'documents';

                $document = $set->documents()->create([
                    'label' => $label,
                    'comment' => $request->description,
                    'file_name' => $file_name,
                    'original_file_name' => $original_file_name,
                    'base_path' => $base_path,
                ]);

                $file->storeAs(
                    'public/'.$base_path, $file_name
                );
            }
        }*/

        return redirect('/');
    }
}
