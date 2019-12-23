<?php

namespace App\Http\Controllers;

use App\Events\AddRecord;
use App\Record;
use App\Season;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class RecordController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */

        public function index()
    {
        //$this->authorize('viewAny',Record::class); not sure this will be needed as all users can view their records on their own profile
        $Records = Record::paginate(5);
        return(view('records.index',compact('Records')));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $User = User::all();
        $Season = Season::all();
        $Record = new Record();
        $rounds = $this->returnRounds($Record);
        return view('records.create',compact('User','Season','Record','rounds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function store(Request $request)
    {
        $this->assignRound($request);
        $Record = Record::create($this->validateRequest());
        //we now trigger an event to calculate the handicap and classification
        $Result = event(new AddRecord($Record));
        $Record = $Result[0];
        $Record->save();


        return (view('records.show',compact('Record')));
    }

    /**
     * Display the specified resource.
     *
     * @param Record $Record
     * @return Factory|View
     */
    public function show(Record $Record)

    {

        return (view('records.show',compact('Record')));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Record $Record
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Record $Record)
    {

        $User = User::all();
        $Season = Season::all();
        $rounds = $this->returnRounds($Record);
        return view('records.edit', compact('Record','Season','User','rounds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Record $Record
     * @param Request $request
     * @return Factory|View
     */
    public function update(Record $Record, Request $request)
    {
        $this->assignRound($request);
        $Record->update($this->validateRequest());
        $Result = event(new AddRecord($Record));
        $Record = $Result[0];
        $Record->save();


        return (view('records.show',compact('Record')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Record $Record
     * @return Factory|View
     * @throws \Exception
     */
    public function destroy(Record $Record)
    {
        $Record->delete();
        $Records = Record::paginate(5);
        return(view('records.index',compact('Records')));
    }

    private function validateRequest()
    {
        //need to get the max score allowed for this round
       $round = \request()->round;
       $maxScore = $this->highScore($round);
       $max = intval($maxScore->score);


       



        return request()->validate([
            'user_id'=> 'sometimes', // this has to be sometimes because we use the same validation for update and store, and we don't change user_id on update
            'season_id' => 'required',
            'score' => 'required | lte:' . $max,
            'round' => 'sometimes',
            'bow' => 'required',
            'date' => 'required',
        ]);
    }
    public function returnRounds($Record) {
        //pulls all the values of the different rounds from the arrays specified in the record model and returns an array
        //for use in the records forms

        $imperial_rounds = $Record->imperial_rounds;
        $metric_rounds = $Record->metric_rounds;
        $indoor_rounds = $Record->indoor_rounds;
        return array('imperial' => $imperial_rounds, 'metric' => $metric_rounds, 'indoor' => $indoor_rounds);
    }

    public function assignRound($request) {
        //this code is used to determine which select box was used and then transfer that value to the round attribute
        if($request['imperial_round']) {$request['round'] = $request['imperial_round'];}
        elseif($request['metric_round']) {$request['round'] = $request['metric_round'];}
        else($request['round'] = $request['indoor_round']);

        return($request['round']);
    }

    public  function highScore($round)
    {
        if($round == 'Vegas') {$round = 'WA 18 Triple';}

        return DB::connection('mysql2')
            ->table($round)
            ->select('score')
            ->where('id', '=','107')
            ->first();

    }


   }
