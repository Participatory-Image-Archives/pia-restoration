<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Document;
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
        date_default_timezone_set('Europe/Berlin');

        $set = Set::create([
            'label' => date('d.m.Y H:i'),
            'signatures' => $request->signatures,
            'origin' => $request->origin,
            'description' => $request->description,
        ]);

        $set->save();

        $this->attach_images($request, $set);

        return redirect('/');
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

        $set->signatures = $request->signatures;
        $set->origin = $request->origin;
        $set->description = $request->description;

        $set->save();

        $this->attach_images($request, $set);

        return redirect('/');
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

    protected function attach_images($request, $set) {

        /**
         * 1. go through all form fields and check if a key contains 'image_'
         *    we take the tempid/link to the connected form fields from that
         * 2. check if we already have a document id
         *      - if no, create a new document
         *      - if yes, replace the old one, if a new file is provided
         * 3. last but not least, remove documents that were deleted
         */

        $ids = [];

        foreach($request->all() as $key => $input) {
            if(strpos($key, 'image_') !== false){

                // 1. get image tempid
                $image_tempid = $request->input('image_'.$input);

                // 2. check if the document already exists
                $image_id = $request->input('id_'.$image_tempid);

                if($request->file('document_'.$image_tempid)){
                    $file = $request->file('document_'.$image_tempid);
                    $label = implode('.', explode('.', $file->getClientOriginalName(), -1));
                    $original_file_name = $file->getClientOriginalName();
                    $file_name = time().'_'.$this->gen_uuid().'_'.$original_file_name;
                    $base_path = 'restoration';

                    $file->storeAs(
                        'public/'.$base_path, $file_name
                    );

                    if($image_id != '') {
                        $document = Document::find($image_id);
                    } else {
                        $document = $set->documents()->create();
                    }

                    $document->label = $label;
                    $document->comment = $request->input('comment_'.$image_tempid);
                    $document->file_name = $file_name;
                    $document->original_file_name = $original_file_name;
                    $document->base_path = $base_path;

                    $document->save();

                    // add image id to worked on ids to check
                    $ids[] = $document->id;
                }

                // in case we just need to change the comment of an existing image
                if($image_id != '') {
                    $document = Document::find($image_id);
                    $document->comment = $request->input('comment_'.$image_tempid);
                    $document->save();
                }
                
                // add to worked on ids if image exists but wasn't exchanged
                if(!$request->file('document_'.$image_tempid) && $image_id != '') {
                    $ids[] = $image_id;
                }
            }
        }

        // 3. just sync the worked on images, forgetting the rest
        $set->documents()->sync($ids);
    }

    protected function gen_uuid($l=6){
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l);
    }
}
