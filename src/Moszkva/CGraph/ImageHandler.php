<?php

namespace Moszkva\CGraph;

class ImageHandler implements IImageHandler
{
	/**
	 * @var Resource
	 */
	private $image;
	
	/**
	 * @var array
	 * 
	 */
	private static $charMap				= array('#', '0', 'X', 'T', '|', ':', '.', '\'', ' ');
	
	private $charMapCount;
	
	public function __construct(IImage $image)
	{
		$this->image		= $image->getImage();
		$this->charMapCount = count(ImageHandler::$charMap);
	}
	
	public function getImageWidth()
	{
		return imagesx($this->image);
	}
	
	public function getImageHeight()
	{
		return imagesy($this->image);
	}	
	
	public function getColorAt($x, $y)
	{
		return imagecolorat($this->image, $x, $y);
	}
	
	public function setContrast($contrast)
	{
		imagefilter($this->image, IMG_FILTER_CONTRAST, $contrast);
	}
	
	/**
	 * @return array
	 */
	public static function getCharMap()
	{
		return ImageHandler::$charMap;
	}
		
	public function resize($newWidth, $newHeight)
	{
		$imageTEMP = imagecreatetruecolor($newWidth, $newHeight);

		if(imagecopyresized($imageTEMP, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $this->getImageWidth(), $this->getImageHeight()))
		{
			$this->image = $imageTEMP;		
		}
		else
		{
			throw new ImageHandlerException('Image resizing failed.');
		}
	}
		
	public function getCharByCoordinate($x, $y)
	{
		$rgb = $this->getColorAt($x, $y);

		$r = (($rgb >> 16) & 0xFF);
		$g = (($rgb >> 8) & 0xFF);
		$b = ($rgb & 0xFF);

		$sat = ($r + $g + $b) / (255 * 3);

		return ImageHandler::$charMap[ (int)( $sat * ($this->charMapCount - 1) ) ];
	}
	
	public function __destruct()
	{
		if(is_resource($this->image))
		{
			imagedestroy($this->image);
		}
	}
	
	public function getImage()
	{
		return $this->image;
	}	
}

?>