<?php

namespace App\Http\Controllers;

use App\Events\SeasonStart;
use App\Events\SeasonEnd;
use App\Season;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\View\View;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $Seasons = Season::all();
        return view('seasons.index',compact('Seasons'));
    }
    public function lengthSeason($Season) {

        //works out the length of the season , value to be returned to the show view

        //check if season has ended otherwise end date is now()
        if($Season->end_date) {
            $end_date = $Season->end_date;
        }
        else {
            $end_date = Carbon::now();
        }
        $end_date = Carbon::createFromDate($end_date);
        $start_date = Carbon::createFromDate($Season->start_date);
        $diff = $start_date->diffInDays($end_date);

        return($diff);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $Season = new Season();
        return view('seasons.create', compact('Season'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function store(Request $request)
    {


        $Season = Season::create($this->validateRequest());
        $Seasons = Season::all();
        $diff = 0;
        if($Season->start_date && $Season->end_date){
            $diff = $this->lengthSeason($Season);}

        return view('seasons.show',compact('Season','diff'));
    }

    /**
     * Display the specified resource.
     *
     * @param Season $Season
     * @return Factory|View
     */
    public function show(Season $Season)

    {
        $diff = 0;
        if($Season->start_date && $Season->end_date){
        $diff = $this->lengthSeason($Season);}

        return view('seasons.show', compact('Season','diff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return Factory|View
     */
    public function edit(Season $Season)
    {

        return view ('seasons.edit', compact('Season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Season  $season
     * @return Factory|View
     */
    public function update(Season $Season)
    {

        $Season->update($this->validateRequest());
        $diff = 0;
        if($Season->start_date && $Season->end_date){
            $diff = $this->lengthSeason($Season);}

        return view('seasons.show', compact('Season','diff'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return Factory|View
     */
    public function destroy(Season $Season)
    {
        $Season->delete();
        $Seasons = Season::all();

        return view('seasons.index',compact('Seasons'));

    }
    private function validateRequest()
    {
        return request()->validate([
            'name'=> 'required|min:3',
            'location' => 'required',
        ]);
    }

    public function startSeason(Season $Season) {


        event(new SeasonStart($Season));

        $Seasons = Season::all();

        return view('seasons.index',compact('Seasons'));

    }

    public function endSeason(Season $Season) {


        event(new SeasonEnd($Season));

        $Seasons = Season::all();

        return view('seasons.index',compact('Seasons'));

    }




}
