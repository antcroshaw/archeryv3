<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //comment
    protected $guarded=[];

    public $metric_rounds = [
                        'Metric I',
                        'Metric II',
                        'Metric III',
                        'Metric IV',
                        'Metric V',
                        'Long Metric Gents',
                        'Long Metric Ladies',
                        'Long Metric I',
                        'Long Metric II',
                        'Long Metric III',
                        'Long Metric IV',
                        'Long Metric V',
                        'Short Metric',
                        'Short Metric I',
                        'Short Metric II',
                        'Short Metric III',
                        'Short Metric IV',
                        'Short Metric V',
                        'Metric 122-50',
                        'Metric 122-40',
                        'Metric 122-30',
                        'Metric 80-40">Metric',
                        'Metric 80-30">Metric',
                        'Metric 80-30 6 zone',
                        'Frostbite',
                        'WA 1440 (Gents)',
                        'WA 1440 (Ladies)',
                        'WA 900',
                        'WA 70',
                        'WA 60',
                        'WA 50',
                        'WA 50',];

    public $imperial_rounds = [
                        'York',
                        'Hereford',
                        'Bristol I',
                        'Bristol',
                        'Bristol III',
                        'Bristol IV',
                        'St. George',
                        'Albion',
                        'Windsor',
                        'Short Windsor',
                        'Junior Windsor',
                        'Short Junior Windsor',
                        'New Western',
                        'Long Western',
                        'Western">Western',
                        'Short Western',
                        'Junior Western',
                        'Short Junior Western',
                        'American',
                        'St.Nicholas',
                        'New National',
                        'Long National',
                        'National',
                        'Short National',
                        'Junior National',
                        'Short Junior National',
                        'New Warwick',
                        'Long Warwick',
                        'Warwick',
                        'Short Warwick',
                        'Junior Warwick',
                        'Short Junior Warwick',

    ];
    public $indoor_rounds = [

                        'Bray I',
                        'Bray II',
                        'Portsmouth',
                        'Stafford',
                        'Worcester',
                        'WA 18',
                        'WA 25',
                        'WA 18/25 Combined',
                        'WA 18 Triple',
                        'Vegas',
                        'WA 25 metre Triple',
                        'WA 18/25 Combined Triple',

    ];



    public function user() {
        //comment
        return $this->belongsTo(\App\User::class);
    }

    public function season() {
        //comment
        return $this->belongsTo(\App\Season::class);
    }
}
