<?php

namespace app\models;

interface IHall {

	/**
	 * @param number of Hall
	 */
	public function checkHall($hall);

	/**
	 * @param seance int
	 */
	public function seats($seance);

	/**
     * Remove records by seance
     * @param $seance
     */
	public function removeAllBySeance($seance);
}