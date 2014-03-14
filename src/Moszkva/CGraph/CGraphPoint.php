<?php

namespace Moszkva\CGraph;

class CGraphPoint
{
	private $CGraphCoordinate;
	private $char;
	
	public function __construct(CGraphCoordinate $CGraphCoordinate, $char = "O")
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