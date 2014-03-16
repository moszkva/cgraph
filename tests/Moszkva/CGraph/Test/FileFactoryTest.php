<?php

namespace Moszkva\CGraph\Test;

use Moszkva\CGraph\FileFactory;
//use Moszkva\CGraph\Interfaces\Image;
use Moszkva\CGraph\Image;
//use Moszkva\CGraph\Interfaces\ImageHandler;
use Moszkva\CGraph\ImageHandler;

class FileFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreateResizing()
	{
		$FileFactory = new FileFactory(new ImageHandler(new Image(__DIR__. '/resource/factory.jpg')));
		
		$FileFactory->create('php://temp');
		
		$this->assertEquals(100, $FileFactory->getImageHandler()->getImageWidth());  
		$this->assertEquals(75, $FileFactory->getImageHandler()->getImageHeight()); 
	}
	
	public function testCreateProduct()
	{
		$FileFactory = new FileFactory(new ImageHandler(new Image(__DIR__. '/resource/production.jpg')));
		
		$content = $FileFactory->create();
		
		foreach(ImageHandler::getCharMap() as $char)
		{
			$this->assertTrue(strpos($content, $char)!==FALSE);
		}
	}
}

?>

