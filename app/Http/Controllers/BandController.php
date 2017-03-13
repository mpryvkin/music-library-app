<?php

namespace App\Http\Controllers;

use App\Band;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BandController extends Controller
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
        return view('bands');
    }

    /**
     * Processes jQuery DataTables Ajax request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexData()
    {
        $bands =
            Band::select(['id', 'name', 'start_date', 'website', 'still_active']);

        return \Datatables::of($bands)
            ->editColumn('start_date', function ($band) {
                return [
                    'display' => e(
                        $band->start_date->format('m/d/Y')
                    ),
                    'timestamp' => $band->start_date->timestamp
                ];
            })
            ->editColumn('still_active', function ($band) {
                return ($band->still_active) ? 'Yes' : 'No';
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
            $band = Band::findOrFail($id);
        } else {
            $band = new Band;
        }

        return view('bands_edit', compact('band'));
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
            'start_date' => 'nullable|date_format:Y-m-d',
            'website' => 'nullable|url|max:255'
        );

        $validator = \Validator::make($in, $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        if (!empty($in['id'])){
            $band = Band::findOrFail($in['id']);

        } else {
            $band = new Band;
        }

        $band->name = trim($in['name']);
        $band->start_date = Carbon::createFromFormat('Y-m-d', $in['start_date']);
        $band->still_active = (isset($in['still_active']) and $in['still_active'] === '1') ? true : false;
        $band->website = trim($in['website']);
        $band->save();


        if (!empty($in['id'])){
            \Session::flash('success.message', 'Band has been updated.');

        } else {
            \Session::flash('success.message', 'Band has been added.');
        }

        return redirect('/bands');
    }

    /**
     * Removes the specified resource from storage
     *
     * @param int $id Resource ID
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $band = Band::findOrFail($id);

        $band->albums()->delete();
        $band->delete();

        \Session::flash('success.message', 'Band has been deleted.');

        return redirect()->back();
    }
}
