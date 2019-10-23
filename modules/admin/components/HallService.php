<?php

namespace app\modules\admin\components;

use app\models\Seances;
use yii\web\HttpException;

/**
 * Manage seats of hall
 */
class HallService
{
	
	private $hall;
	private $seance;
	/**
	 * an array to keep booked seats
	 */
	public $bookedSeats = [];

	private $halls = ['One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven'];

	function __construct($hall, $seance)
	{
		$this->hall = $hall;
		$this->seance = $seance;
	}

	/**
	 * @return Hall $seats
	 */
	public function getHall()
	{
		foreach ($this->halls as $hallNumber) {
			$modelName = "\app\models\Hall{$hallNumber}";
			if (class_exists($modelName) && ($hall = new $modelName()) && $hall->checkHall($this->hall)) {
				return $hall;
			}
		}
		throw new HttpException(404, "Hall {$this->hall} not found");
	}

	/**
	 * create seats for seance
	 */
	public function setSeats()
	{
		$hall = $this->getHall();
    	foreach ($hall->seats as $row => $seatAmount) {
    		for ($i=1; $i <= $seatAmount; $i++) { 
    			$hall = new $hall();
				$hall->row = $row + 1;
                $hall->seat = $i;
				$hall->seance = $this->seance;
				$hall->save();
    		}
    	}
	}

	/**
	 * remove seats for seance
	 */
	public function destroySeats()
	{
		$hall = $this->getHall();
		$hall->removeAllBySeance($this->seance);
	}
	
}