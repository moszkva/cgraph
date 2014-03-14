<?php

namespace Moszkva\CGraph\Test;

use Moszkva\CGraph\CGraphFileFactory;
use Moszkva\CGraph\CGraphImageHandler;

class CGraphFileFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreateResizing()
	{
		$CGraphFileFactory = new CGraphFileFactory(__DIR__. '/resource/factory.jpg');
		
		$CGraphFileFactory->create('php://temp');
		
		$this->assertEquals(100, $CGraphFileFactory->getCGraphImageHandler()->getImageWidth());  
		$this->assertEquals(75, $CGraphFileFactory->getCGraphImageHandler()->getImageHeight()); 
	}
	
	public function testCreateProduct()
	{
		$CGraphFileFactory = new CGraphFileFactory(__DIR__. '/resource/production.jpg');
		
		$content = $CGraphFileFactory->create();
		
		foreach(CGraphImageHandler::getCharMap() as $char)
		{
			$this->assertTrue(strpos($content, $char)!==FALSE);
		}
	}
}

?>

