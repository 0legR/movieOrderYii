<?php

namespace app\modules\api\components;

use app\models\Seances;
use app\models\Order;
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
	public function hallSeats()
	{
		foreach ($this->halls as $hallNumber) {
			$modelName = "\app\models\Hall{$hallNumber}";
			if (class_exists($modelName) && ($hall = new $modelName()) && $hall->checkHall($this->hall)) {
				return $hall->seats($this->seance);
			}
		}
		return [];
	}

	/**
	 * @param $rows []
	 * @return $seats with is_free property
	 */
	public function bookSeat($rows)
	{
		$rowsArray = json_decode($rows);
		$hallSeats = $this->hallSeats();
		$seatsReport = [];
		foreach ($hallSeats as $hall) {
			foreach ($rowsArray as $key => $row) {
				$rowNumber = (int) $key;
				if ($this->checkIsRowInHall($rowNumber, $hallSeats) && $hall->row === $rowNumber) {
					if (in_array($hall->seat, $row)) {
						if ($hall->is_free) {
							$hall->is_free = (int)!$hall->is_free;
							$hall->save();
							$this->bookedSeats[] = $hall->id;
							$seatsReport["[row => {$hall->row}][seat => {$hall->seat}]"] = true;
						} else {
							$seatsReport["[row => {$hall->row}][seat => {$hall->seat}]"] = false;
						}
					}
				}
			}
		}

		if(in_array(false, $seatsReport)) {
			$this->rollbackSeats();
			$report = json_encode($seatsReport);
			throw new HttpException(404, "Some seats already booked => {$report}");
		}
	}

	/**
	 * check is row is in the hall
	 * @param $row int from order
	 * @param $hallSeats [] of $hall objects
	 */
	private function checkIsRowInHall($row, $hallSeats)
	{
		if ($row <= $hallSeats[count($hallSeats) - 1]->row) {
			return true;
		}	
		throw new HttpException(404, "There isn`t row {$row} at this hall");
	}

	/**
	 * unbook seats unless order isn`t created
	 */
	public function rollbackSeats()
	{
		foreach ($this->hallSeats() as $hall) {
			if (in_array($hall->id, $this->bookedSeats)) {
				$hall->is_free = (int)!$hall->is_free;
				$hall->save();
			}
		}
	}
}