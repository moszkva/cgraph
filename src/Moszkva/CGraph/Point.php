<?php

namespace Moszkva\CGraph;

class Point
{
	/**
	 * @var Coordinate 
	 */
	private $coordinate;
	
	/**
	 *
	 * @var char
	 */
	private $char;
	
	/**
	 * @param \Moszkva\CGraph\Coordinate $coordinate
	 * @param char $char
	 */
	public function __construct(Coordinate $coordinate, $char = "O")
	{
		$this->coordinate	= $coordinate;
		$this->char			= $char;
	}
	
	public function getCoordinate()
	{
		return $this->coordinate;
	}
	public function getChar()
	{
		return $this->char;
	}
}

?>