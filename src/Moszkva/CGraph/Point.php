<?php

namespace Moszkva\CGraph;

class Point
{
	private $CGraphCoordinate;
	private $char;
	
	public function __construct(Coordinate $CGraphCoordinate, $char = "O")
	{
		$this->CGraphCoordinate = $CGraphCoordinate;
		$this->char				= $char;
	}
	
	public function getCGraphCoordinate()
	{
		return $this->CGraphCoordinate;
	}

	public function getChar()
	{
		return $this->char;
	}
}

?>