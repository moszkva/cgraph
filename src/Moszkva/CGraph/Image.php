<?php

namespace Moszkva\CGraph;

use Moszkva\CGraph\IImage;

class Image implements IImage
{
	/**
	 * @var resource 
	 */
	private $image;
	
	public function __construct($source)
	{
		$this->create($source);
	}
	
	public function create($source)
	{
		if(is_file($source))
		{
			$this->openFile($source);
		}
		elseif(($stream = @file_get_contents($source))!==FALSE && $stream!='')
		{
			$this->openStream($stream);
		}
		else
		{
			throw new ImageHandlerException('File or stream is not readable.');
		}		
	}

	public function getImage()
	{
		return $this->image;
	}
	
	private function openStream($stream)
	{
		if(($this->image = @imagecreatefromstring($stream))===FALSE)
		{
			throw new ImageHandlerException('Unknown file type. Supported file types: jpg, png, gif.');
		}		
	}
	
	private function openFile($filePath)
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
	
	private function getFileExtensionByFileName($fileName)
	{
		$fileName = basename($fileName);
		
		$fileParts = explode('.', $fileName);
		
		return strtolower($fileParts[sizeof($fileParts)-1]);
	}	

}

?>