<?php

namespace Moszkva\CGraph;

class Builder
{
	private $backgroundCharacter	= ' ';
	private $points					= array();
	private $numOfVerticalChars		= 100;
	private $numOfHorizontalChars	= 100;
	private $newLineSequence		= PHP_EOL;
	
	public function setPoint(Point $CGraphPoint)
	{
		$this->points[$CGraphPoint->getCGraphCoordinate()->x][$CGraphPoint->getCGraphCoordinate()->y] = $CGraphPoint;
		
		return $this;
	}
	
	public function setBackgroundCharacter($backgroundCharacter)
	{
		$this->backgroundCharacter = $backgroundCharacter;
		
		return $this;
	}
	
	public function getBackgroundCharacter()
	{
		return $this->backgroundCharacter;
	}
	
	public function setCanvasSize($numOfHorizontalChars, $numOfVerticalChars)
	{
		$this->numOfVerticalChars	= (int)$numOfVerticalChars;
		$this->numOfHorizontalChars = (int)$numOfHorizontalChars;
		
		return $this;
	}
	
	public function render($onlyReturn = false)
	{
		$map = "";
		
		for($y=1; $y <= $this->numOfVerticalChars; $y++)
		{
			for($x=1; $x <= $this->numOfHorizontalChars; $x++)
			{
				if(isset($this->points[$x][$y]))
				{
					$map.= $this->points[$x][$y]->getChar().$this->points[$x][$y]->getChar();
				}
				else
				{
					$map.= $this->backgroundCharacter.$this->backgroundCharacter;
				}
			}
			
			$map.= $this->newLineSequence;
		}
		
		if($onlyReturn)
		{
			return $map;
		}
		
		print $map;
	}
}

?>