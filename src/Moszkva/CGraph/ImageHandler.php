<?php

namespace Moszkva\CGraph;

class ImageHandler implements Interfaces\ImageHandler
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
	
	/**
	 * @param \Moszkva\CGraph\Image $image
	 */
	public function __construct(Image $image)
	{
		$this->image		= $image->getImage();
		$this->charMapCount = count(ImageHandler::$charMap);
	}
	
	/**
	 * @return integer
	 */
	public function getImageWidth()
	{
		return imagesx($this->image);
	}
	
	/**
	 * @return integer
	 */
	public function getImageHeight()
	{
		return imagesy($this->image);
	}	
	
	/**
	 * @param integer $x
	 * @param integer $y
	 * @return integer
	 */
	public function getColorAt($x, $y)
	{
		return imagecolorat($this->image, $x, $y);
	}
	
	/**
	 * 
	 * @param integer $contrast ( Max: -100, Min: 100)
	 */
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
		
	/**
	 * @param integer $newWidth
	 * @param integer $newHeight
	 * @throws ImageHandlerException
	 */
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
	
	/**
	 * @param integer $x
	 * @param integer $y
	 * @return char
	 */
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