<?php

namespace Moszkva\CGraph;

class Builder
{
	/**
	 * @var char
	 */
	private $backgroundCharacter	= ' ';
	private $points					= array();
	
	/**
	 * @var integer
	 */
	private $numOfVerticalChars		= 100;
	
	/**
	 * @var integer
	 */
	private $numOfHorizontalChars	= 100;
	
	/**
	 * @var string
	 */
	private $newLineSequence		= PHP_EOL;
	
	/**
	 * @param \Moszkva\CGraph\Point $Point
	 * @return \Moszkva\CGraph\Builder
	 */
	public function setPoint(Point $Point)
	{
		$this->points[$Point->getCoordinate()->x][$Point->getCoordinate()->y] = $Point;
		
		return $this;
	}
	
	/**
	 * @param char $backgroundCharacter
	 * @return \Moszkva\CGraph\Builder
	 */
	public function setBackgroundCharacter($backgroundCharacter)
	{
		$this->backgroundCharacter = $backgroundCharacter;
		
		return $this;
	}
	
	/**
	 * @return char
	 */
	public function getBackgroundCharacter()
	{
		return $this->backgroundCharacter;
	}
	
	/**
	 * @param integer $numOfHorizontalChars
	 * @param integer $numOfVerticalChars
	 * @return \Moszkva\CGraph\Builder
	 */
	public function setCanvasSize($numOfHorizontalChars, $numOfVerticalChars)
	{
		$this->numOfVerticalChars	= (int)$numOfVerticalChars;
		$this->numOfHorizontalChars = (int)$numOfHorizontalChars;
		
		return $this;
	}
	
	/**
	 * @param boolean $onlyReturn
	 * @return string
	 */
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