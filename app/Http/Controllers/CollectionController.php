<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;
use App\Models\Image;
use App\Models\Document;

class CollectionController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        //
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
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request, $id)
    {
        if($files = $request->file('images')){
            foreach($files as $file){
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://pia-iiif.dhlab.unibas.ch/server/upload-pia.elua',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                // @TODO: fix those damn ssl problems
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => array(
                        'Datei'=> new \CURLFile(
                            $file->getPathName()
                        ),
                        'Cuse_sop' => 'yes'
                    ),
                ));

                $response = curl_exec($curl);

                $data = json_decode($response);

                $image = Image::create([
                    'label' => $data->signature,
                    'signature' => $data->signature,
                    'base_path' => 'upload',
                ]);

                $image->collections()->sync($id);

                $image->save();
            }
        }

        return redirect()->route('sets.edit', [Collection::find($id)->set->id]);
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
        $collection = Collection::find($id);

        if($files = $request->file('documents')){
            foreach($files as $file){

                $label = implode('.', explode('.', $file->getClientOriginalName(), -1));
                $original_file_name = $file->getClientOriginalName();
                $file_name = time().'_'.$original_file_name;
                $base_path = 'documents';

                $document = $collection->documents()->create([
                    'label' => $label,
                    'file_name' => $file_name,
                    'original_file_name' => $original_file_name,
                    'base_path' => $base_path,
                ]);

                $file->storeAs(
                    'public/'.$base_path, $file_name
                );
            }
        }

        return redirect()->route('sets.edit', [$collection->set->id]);
    }
}