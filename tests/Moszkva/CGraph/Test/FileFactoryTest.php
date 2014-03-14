<?php

namespace Moszkva\CGraph\Test;

use Moszkva\CGraph\FileFactory;
use Moszkva\CGraph\ImageHandler;

class FileFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreateResizing()
	{
		$CGraphFileFactory = new FileFactory(__DIR__. '/resource/factory.jpg');
		
		$CGraphFileFactory->create('php://temp');
		
		$this->assertEquals(100, $CGraphFileFactory->getCGraphImageHandler()->getImageWidth());  
		$this->assertEquals(75, $CGraphFileFactory->getCGraphImageHandler()->getImageHeight()); 
	}
	
	public function testCreateProduct()
	{
		$CGraphFileFactory = new FileFactory(__DIR__. '/resource/production.jpg');
		
		$content = $CGraphFileFactory->create();
		
		foreach(ImageHandler::getCharMap() as $char)
		{
			$this->assertTrue(strpos($content, $char)!==FALSE);
		}
	}
}

?>

