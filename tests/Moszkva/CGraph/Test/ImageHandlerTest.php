<?php

namespace Moszkva\CGraph\Test;

use \Moszkva\CGraph\ImageHandler;

class ImageHandlerTest extends \PHPUnit_Framework_TestCase 
{
	public function testOpenFile()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.jpg');
		
		$this->assertEquals(10, $CGraphImageHandler->getImageWidth());
		
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.png');
		
		$this->assertEquals(10, $CGraphImageHandler->getImageHeight());
		
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.gif');
		
		$this->assertEquals(10, $CGraphImageHandler->getImageWidth());
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\ImageHandlerException
	 */
	public function testOpenFileUnknownFileTypeError()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.bmp');		
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\ImageHandlerException
	 */
	public function testOpenFileNoReadableFileError()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/does_not_exists');		
	}	
	
	public function testResize()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.jpg');
		
		$CGraphImageHandler->resize(5, 5);
		
		$this->assertEquals(5, $CGraphImageHandler->getImageWidth());
		$this->assertEquals(5, $CGraphImageHandler->getImageHeight());
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\ImageHandlerException
	 */	
	public function testResizeError()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/empty.jpg');
		
		@$CGraphImageHandler->resize(-10, 0);
	}
		
	
	public function testGetColorAt()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/color_red.jpg');
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 254, 0, 0), $CGraphImageHandler->getColorAt(1, 1));
		
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/color_green.jpg');
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 0, 255, 1), $CGraphImageHandler->getColorAt(1, 1));		
		
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/color_blue.jpg');
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 0, 0, 254), $CGraphImageHandler->getColorAt(1, 1));			
		
	}
	
	public function testGetCharByCoordinate()
	{
		$CGraphImageHandler = new ImageHandler(__DIR__. '/resource/multi_colors.jpg');		
		
		// Black
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 0), $CGraphImageHandler->getCharByCoordinate(49, 49));
		
		// Red
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 49), $CGraphImageHandler->getCharByCoordinate(49, 0));
		
		// Green
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(25, 0), $CGraphImageHandler->getCharByCoordinate(25, 49));
		
		// Blue
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 25), $CGraphImageHandler->getCharByCoordinate(49, 25));		
		
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(0, 0)!=$CGraphImageHandler->getCharByCoordinate(0, 49));
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(0, 49)!=$CGraphImageHandler->getCharByCoordinate(25, 0));
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(25, 0)!=$CGraphImageHandler->getCharByCoordinate(0, 25));
		
	}
}

?>
