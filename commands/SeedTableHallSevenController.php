<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\HallSeven;
use app\models\Seances;
use yii\base\ErrorException;

/**
 * seed table hall_seven
 */
class SeedTableHallSevenController extends Controller
{
	private $seats = [12, 14, 15, 13, 13, 13, 13, 13, 13, 20];
    public function actionIndex()
    {
    	try{
    		$this->seed();	
    	} catch(ErrorException $e) {
    		echo $e . ExitCode::DATAERR;
    	}
        echo 'Success ' . ExitCode::OK;
    }

    private function seed()
    {
        $seance = Seances::find()->one();
    	foreach ($this->seats as $row => $seatAmount) {
    		for ($i=1; $i <= $seatAmount; $i++) { 
    			$hall = new HallSeven();
				$hall->row = $row + 1;
                $hall->seat = $i;
				$hall->seance = $seance->id;
				$hall->save();

    		}
    	}
    }
}
