<?php

namespace Moszkva\CGraph\Test;

use \Moszkva\CGraph\Builder;
use \Moszkva\CGraph\Point;
use \Moszkva\CGraph\Coordinate;

class BuilderTest extends \PHPUnit_Framework_TestCase 
{
	public function testSetCanvasSize()
	{
		$CGraphBuilder = new Builder();
		
		$CGraphBuilder->setCanvasSize(0, 0);
		
		$this->assertEquals(0, strlen($CGraphBuilder->render(true)));
		
		$CGraphBuilder->setCanvasSize(1, 1);
		
		$this->assertEquals($CGraphBuilder->getBackgroundCharacter().$CGraphBuilder->getBackgroundCharacter().PHP_EOL, $CGraphBuilder->render(true));
	}
	
	public function testSetPoint()
	{
		$CGraphBuilder = new Builder();
		
		$CGraphBuilder->setCanvasSize(3, 3);
		
		$CGraphBuilder->setPoint(new Point(new Coordinate(2,2), 'X'));
		
		$empty = $CGraphBuilder->getBackgroundCharacter().$CGraphBuilder->getBackgroundCharacter();
		
		$this->assertEquals($empty.$empty.$empty.PHP_EOL.$empty.'XX'.$empty.PHP_EOL.$empty.$empty.$empty.PHP_EOL, $CGraphBuilder->render(true));
	}
	
	public function testSetBackgroundCharacter()
	{
		$CGraphBuilder = new Builder();
		
		$CGraphBuilder->setCanvasSize(1, 1);
		
		$CGraphBuilder->setBackgroundCharacter('-');
		
		$this->assertEquals('--'.PHP_EOL, $CGraphBuilder->render(true));
	}
	
	public function testRender()
	{
		$CGraphBuilder = new Builder();
		
		$CGraphBuilder->setCanvasSize(3, 3);
		
		$CGraphBuilder->setPoint(new Point(new Coordinate(2,2), 'X'));
		
		$empty = $CGraphBuilder->getBackgroundCharacter().$CGraphBuilder->getBackgroundCharacter();
		
		$this->expectOutputString($empty.$empty.$empty.PHP_EOL.$empty.'XX'.$empty.PHP_EOL.$empty.$empty.$empty.PHP_EOL);
		
		$CGraphBuilder->render();
	}

}

?>