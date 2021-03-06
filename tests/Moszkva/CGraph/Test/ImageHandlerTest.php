<?php

namespace Moszkva\CGraph\Test;

//use \Moszkva\CGraph\Image;
use \Moszkva\CGraph\Image;
//use Moszkva\CGraph\ImageHandler;
use \Moszkva\CGraph\ImageHandler;

class ImageHandlerTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * @expectedException \Moszkva\CGraph\Exceptions\ImageHandlerException
	 * @expectedExceptionMessage Unknown file type. Supported file types: jpg, png, gif.
	 * @group net
	 */
	public function testOpenStreamFileTypeError()
	{
		$CGraphImageHandler = new ImageHandler(new Image('https://github.com/moszkva/cgraph/raw/master/tests/Moszkva/CGraph/Test/resource/empty.bmp'));		
	}	
	
	public function testResize()
	{
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/empty.jpg')));
		
		$CGraphImageHandler->resize(5, 5);
		
		$this->assertEquals(5, $CGraphImageHandler->getImageWidth());
		$this->assertEquals(5, $CGraphImageHandler->getImageHeight());
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\ImageHandlerException
	 */	
	public function testResizeError()
	{
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/empty.jpg')));
		
		@$CGraphImageHandler->resize(-10, 0);
	}
		
	
	public function testGetColorAt()
	{
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/color_red.jpg')));
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 254, 0, 0), $CGraphImageHandler->getColorAt(1, 1));
		
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/color_green.jpg')));
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 0, 255, 1), $CGraphImageHandler->getColorAt(1, 1));		
		
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/color_blue.jpg')));
		
		$this->assertEquals(imagecolorresolve ($CGraphImageHandler->getImage(), 0, 0, 254), $CGraphImageHandler->getColorAt(1, 1));			
		
	}
	
	public function testGetCharByCoordinate()
	{
		$CGraphImageHandler = new ImageHandler((new Image(__DIR__. '/resource/multi_colors.jpg')));		
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 0), $CGraphImageHandler->getCharByCoordinate(49, 49));

		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 49), $CGraphImageHandler->getCharByCoordinate(49, 0));
		
		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(25, 0), $CGraphImageHandler->getCharByCoordinate(25, 49));

		$this->assertEquals($CGraphImageHandler->getCharByCoordinate(0, 25), $CGraphImageHandler->getCharByCoordinate(49, 25));		
		
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(0, 0)!=$CGraphImageHandler->getCharByCoordinate(0, 49));
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(0, 49)!=$CGraphImageHandler->getCharByCoordinate(25, 0));
		$this->assertTrue($CGraphImageHandler->getCharByCoordinate(25, 0)!=$CGraphImageHandler->getCharByCoordinate(0, 25));
		
	}
}

?>
