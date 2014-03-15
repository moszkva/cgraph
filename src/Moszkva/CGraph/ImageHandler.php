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
	
	public function __construct($filePath)
	{
		if(is_file($filePath))
		{
			$this->openFile($filePath);
		}
		elseif(($stream = @file_get_contents($filePath))!==FALSE && $stream!='')
		{
			$this->openStream($stream);
		}
		else
		{
			throw new ImageHandlerException('File or stream is not readable.');
		}
		
		$this->charMapCount = count(ImageHandler::$charMap);
	}
	
	public function openStream($stream)
	{
		if(($this->image = @imagecreatefromstring($stream))===FALSE)
		{
			throw new ImageHandlerException('Unknown file type. Supported file types: jpg, png, gif.');
		}		
	}
	
	public function openFile($filePath)
	{
		switch($this->getFileExtensionByFileName($filePath))
		{
			case 'jpg':
			case 'jpeg':
				$this->image = imagecreatefromjpeg($filePath);		
			break;
		
			case 'png':
				$this->image = imagecreatefrompng($filePath);		
			break;
		
			case 'gif':
				$this->image = imagecreatefromgif($filePath);		
			break;
		
			default:							
				throw new ImageHandlerException('Unknown file type. Supported file types: jpg, png, gif.');				
			break;
		}
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
	
	private function getFileExtensionByFileName($fileName)
	{
		$fileName = basename($fileName);
		
		$fileParts = explode('.', $fileName);
		
		return strtolower($fileParts[sizeof($fileParts)-1]);
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