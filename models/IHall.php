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

}