<?php

namespace App\Http\Controllers;

use App\Band;
use App\Album;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Get list of all bands
        $bands = Band
           ::select(['id', 'name'])
           ->orderBy('name')
           ->get();

        return view('albums', compact('bands'));
    }

    /**
     * Processes jQuery DataTables Ajax request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexData()
    {
        $albums = Album
            ::select([
                'albums.id AS id', 
                'albums.name AS name', 
                'albums.genre AS genre', 
                'albums.release_date AS release_date', 
                'albums.band_id AS band_id',
                'bands.name AS band_name',
            ])
            ->leftJoin('bands', 'albums.band_id', '=', 'bands.id');           

        return \Datatables::of($albums)
            ->editColumn('release_date', function ($album) {
                return [
                    'display' => e(
                        $album->release_date->format('m/d/Y')
                    ),
                    'timestamp' => $album->release_date->timestamp
                ];
            })
            ->make(true);
    }

    /**
     * Shows the form for adding\editing the specified resource
     * based on whether resource ID is provided.
     *
     * @param int $id Resource ID
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id = 0)
    {
        if ($id){
            $album = Album::findOrFail($id);
        } else {
            $album = new Album;
        }

        # Get list of all bands
        $bands = Band
           ::select(['id', 'name'])
           ->orderBy('name')
           ->get();

        return view('albums_edit', compact('album', 'bands'));
    }

    /**
     * Updates the specified resource in storage
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $in = request()->all();

        $rules = array(
            'name' => 'required|max:255',
            'band_id' => 'required|exists:bands,id',
            'recorded_date' => 'nullable|date_format:Y-m-d',
            'release_date' => 'nullable|date_format:Y-m-d',
            'number_of_tracks' => 'nullable|integer|between:1,99',
            'label' => 'nullable|max:255',
            'producer' => 'nullable|max:255',
            'genre' => 'nullable|max:255',
        );

        $validator = \Validator::make($in, $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        if (!empty($in['id'])){
            $album = Album::findOrFail($in['id']);

        } else {
            $album = new Album;
        }

        $album->name = trim($in['name']);
        $album->band_id = (int)$in['band_id'];
        $album->recorded_date = Carbon::createFromFormat('Y-m-d', $in['recorded_date']);
        $album->release_date = Carbon::createFromFormat('Y-m-d', $in['release_date']);
        $album->number_of_tracks = (int)$in['number_of_tracks'];
        $album->label = trim($in['label']);
        $album->producer = trim($in['producer']);
        $album->genre = trim($in['genre']);
        $album->save();

        if (!empty($in['id'])){
            \Session::flash('success.message', 'Album has been updated.');

        } else {
            \Session::flash('success.message', 'Album has been added.');
        }

        return redirect('/albums');
    }

    /**
     * Removes the specified resource from storage
     *
     * @param int $id Resource ID
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $album = Album::findOrFail($id);

        $album->delete();

        \Session::flash('success.message', 'Album has been deleted.');

        return redirect()->back();
    }
}
