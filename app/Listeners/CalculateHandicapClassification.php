<?php

namespace App\Listeners;

use App\Events\AddRecord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use function SebastianBergmann\Type\TestFixture\callback_function;

class CalculateHandicapClassification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AddRecord $event
     * @return void
     */
    public function handle(AddRecord $event)
    {

        $handicap = $this->calculate_handicap($event->Record->round, $event->Record->score);
        $Record = $event->Record;
        $Record->handicap = $handicap->score;
        //can now repeat this process for classification and then return the record fully completed

        $age = $this->userAge($Record);
        $class_string  = $this->class_string_builder($Record,$age,$Record->user->sex,$Record->bow);
        $classification = $this->records_classification($class_string,$Record->season->location,$Record->round,$Record->score);
        $Record->classification = $classification;

        return($Record);


    }

    public function calculate_handicap($round, $score)

    {


        if ($result = DB::connection('mysql2')->table($round)->select('*')->where('score', '=', $score)->first()) {
            $handicap_row = $result->id;
            $handicap = DB::connection('mysql2')
                ->table('Handicap')
                ->select('score')
                ->where('id', $handicap_row)
                ->first();
            return ($handicap);
        } elseif (
        $result = DB::connection('mysql2')->table($round)->select('*')->where('score', '>', $score)->first()) {
            $handicap_row = $result->id;
            $handicap = DB::connection('mysql2')
                ->table('Handicap')
                ->select('score')
                ->where('id', $handicap_row)
                ->first();
            $handicap->score++;
            return ($handicap);
        } else {
            $result = DB::connection('mysql2')->table($round)->select('*')->where('score', '>', $score)->first();
            $handicap_row = $result->id;
            $handicap = DB::connection('mysql2')
                ->table('Handicap')
                ->select('score')
                ->where('id', $handicap_row)
                ->first();
            return ($handicap);
        }
    }

    public function userAge($Record){
        //this function returns the user's age from a date of birth

        $dob = $Record->user->dob;

        $now = time();

        //get the timestamp of the person's date of birth

        $dob = strtotime($dob);

        $difference = $now - $dob;

        //there are 31556926 seconds in a year

        $age = floor($difference / 31556926);

        //floor rounds up

        return $age;
    }



    public function class_string_builder($Record, $user_age, $user_sex, $user_bow_type)
    {

        //initialise and empty string variable
        $class_string = '';

        if ($user_age < 18) {

            $class_string .= 'Junior_';

        }


        //next we add whether they are male or female

        if ($user_sex == 'female') {

            $class_string .= 'Ladies_';
        } else {
            $class_string .= 'Gents_';


        }


        //next we have to check if they are under 18 in which case we start a switch statement to append the correct age modifier to the string
        if ($user_age < 18) {

            switch ($user_age) {
                case $user_age < 12:
                    $class_string .= 'U12_';
                    break;
                case $user_age < 14:
                    $class_string .= 'U14_';
                    break;
                case $user_age < 16:
                    $class_string .= 'U16_';
                    break;
                default:
                    $class_string .= 'U18_';


            }

        }

        //finally we add the bow type and the units

        $class_string .= $user_bow_type . '_';

        if(in_array($Record->round,$Record->imperial_rounds)) {$class_string .= 'Imperial';}
        elseif(in_array($Record->round,$Record->metric_rounds)) {$class_string .='Metric';}
        else {$class_string.='Indoor';}

        return $class_string;

    }




    //classification section to be moved to listener

    public function records_classification($class_string, $location, $round, $score)
    {
        $classification = "";
        //this is for a special case as there is no entry for vegas

        if($round == 'Vegas') {$round = 'WA 18 metre Triple';}




        if ($class_result = DB::connection('mysql3')
            ->table($class_string)
            ->select('*')
            ->where('class', '=', $round)->get())

        {
            $num_rows = count($class_result);
        }

        if (($location == 'outdoor') && ($num_rows > 0)) {





            $row['3rd'] = $class_result[0]->{'3rd'};
            $row['2nd'] = $class_result[0]->{'2nd'};
            $row['1st'] = $class_result[0]->{'1st'};
            $row['Bowman'] = $class_result[0]->Bowman;
            $row['MB'] = $class_result[0]->MB;
            $row['GMB'] = $class_result[0]->GMB;





            switch ($score) {
                case (($score >= $row['3rd']) && ($row['2nd'] == 0)):
                case (($score >= $row['3rd']) && ($score < $row['2nd']) && ($row['2nd'] != 0)):
                    $classification = '3rd';
                    break;
                case (($score >= $row['2nd']) && ($row['1st'] == 0)):
                case (($score >= $row['2nd']) && ($score < $row['1st']) && ($row['1st'] != 0)):
                    $classification = '2nd';
                    break;
                case (($score >= $row['1st']) && ($row['Bowman'] == 0)):
                case (($score >= $row['1st']) && ($score < $row['Bowman']) && ($row['Bowman'] != 0)):
                    $classification = '1st';
                    break;
                case (($score >= $row['Bowman']) && ($row['MB'] == 0)):
                case (($score >= $row['Bowman']) && ($score < $row['MB']) && ($row['MB'] != 0)):
                    $classification = 'Bowman';
                    break;
                case (($score >= $row['MB']) && ($score < $row['GMB']) && ($row['GMB'] != 0)):
                    $classification = 'MB';
                    break;
                case ($score >= $row['GMB'] && ($row['GMB'] != 0)):
                    $classification = 'GMB';
                    break;
                // these next ones check if the next row is zero and then exit the switch statement

                case (($score >= $row['MB']) && ($row['GMB'] == 0)):
                    $classification = 'MB';
                    break;

                    break;
                default:
                    $classification = 'none';

            }
        }


        //end of outdoor

        if (($location == 'indoor')) {




            $row['H'] = $class_result[0]->H;
            $row['G'] = $class_result[0]->G;
            $row['F'] = $class_result[0]->F;
            $row['E'] = $class_result[0]->E;
            $row['D'] = $class_result[0]->D;
            $row['C'] = $class_result[0]->C;
            $row['B'] = $class_result[0]->B;
            $row['A'] = $class_result[0]->A;

            //now we can execute the old switch statement

            switch ($score) {
                case (($score >= $row['H']) && ($row['G'] == 0)):
                case (($score >= $row['H']) && ($score < $row['G']) && ($row['G'] != 0)):
                    $classification = 'H';
                    break;
                case (($score >= $row['G']) && ($row['F'] == 0)):
                case (($score >= $row['G']) && ($score < $row['F']) && ($row['F'] != 0)):
                    $classification = 'G';
                    break;
                case (($score >= $row['F']) && ($row['E'] == 0)):
                case (($score >= $row['F']) && ($score < $row['E']) && ($row['E'] != 0)):
                    $classification = 'F';
                    break;
                case (($score >= $row['E']) && ($row['D'] == 0)):
                case (($score >= $row['E']) && ($score < $row['D']) && ($row['D'] != 0)):
                    $classification = 'E';
                    break;
                case (($score >= $row['D']) && ($row['C'] == 0)):
                case (($score >= $row['D']) && ($score < $row['C']) && ($row['C'] != 0)):
                    $classification = 'D';
                    break;
                case (($score >= $row['C']) && ($row['B'] == 0)):
                case (($score >= $row['C']) && ($score < $row['B']) && ($row['B'] != 0)):
                    $classification = 'C';
                    break;
                case (($score >= $row['B']) && ($score < $row['A']) && ($row['A'] != 0)):
                    $classification = 'B';
                    break;
                case ($score >= $row['A'] && ($row['A'] != 0)):
                    $classification = 'A';
                    break;
                // these next ones check if the next row is zero and then exit the switch statement

                case (($score >= $row['B']) && ($row['A'] == 0)):
                    $classification = 'B';
                    break;
                    break;
                default:
                    $classification = 'none';

            }
        }

        return $classification;



    }
}
