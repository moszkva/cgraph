<?php

namespace Moszkva\CGraph;

class Coordinate
{
	public $x;
	public $y;
	
	/**
	 * @param integer $x
	 * @param integer $y
	 */
	public function __construct($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
	}
}

?>