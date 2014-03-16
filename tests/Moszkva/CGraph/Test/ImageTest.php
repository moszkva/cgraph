<?php

namespace Moszkva\CGraph\Test;

use \Moszkva\CGraph\Image;

class ImageTest extends \PHPUnit_Framework_TestCase 
{
	public function testOpenFile()
	{
		$Image = new Image(__DIR__. '/resource/empty.jpg');
		
		$this->assertTrue(is_resource($Image->getImage()));
		
		$Image = new Image(__DIR__. '/resource/empty.png');
		
		$this->assertTrue(is_resource($Image->getImage()));
		
		$Image = new Image(__DIR__. '/resource/empty.gif');
		
		$this->assertTrue(is_resource($Image->getImage()));
	}
	
	/**
	 * @group net
	 */
	public function testOpenStream()
	{
		$Image = new Image('https://raw.github.com/moszkva/cgraph/master/tests/Moszkva/CGraph/Test/resource/empty.jpg');
		
		$this->assertTrue(is_resource($Image->getImage()));
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\Exceptions\ImageHandlerException
	 */
	public function testOpenFileUnknownFileTypeError()
	{
		$Image = new Image(__DIR__. '/resource/empty.bmp');		
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\Exceptions\ImageHandlerException
	 * @expectedExceptionMessage File or stream is not readable. 
	 */
	public function testOpenFileNoReadableFileError()
	{
		$Image = new Image(__DIR__. '/resource/does_not_exists');		
	}
	
	/**
	 * @expectedException \Moszkva\CGraph\Exceptions\ImageHandlerException
	 * @expectedExceptionMessage Unknown file type. Supported file types: jpg, png, gif.
	 * @group net
	 */
	public function testOpenStreamFileTypeError()
	{
		$Image = new Image('https://github.com/moszkva/cgraph/raw/master/tests/Moszkva/CGraph/Test/resource/empty.bmp');		
	}	
}

?>
