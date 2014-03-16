<?php

namespace Moszkva\CGraph;

class Image implements Interfaces\Image
{
	/**
	 * @var resource 
	 */
	private $image;
	
	/**
	 * {@inheritdoc}
	 */
	public function __construct($source)
	{
		$this->create($source);
	}
	
	/**
	 * {@inheritdoc}
	 * @throws ImageHandlerException
	 */
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
			throw new Exceptions\ImageHandlerException('File or stream is not readable.');
		}		
	}

	/**
	 * {@inheritdoc}
	 */
	public function getImage()
	{
		return $this->image;
	}
	
	/**
	 * @param string $stream
	 * @throws ImageHandlerException
	 */
	private function openStream($stream)
	{
		if(($this->image = @imagecreatefromstring($stream))===FALSE)
		{
			throw new Exceptions\ImageHandlerException('Unknown file type. Supported file types: jpg, png, gif.');
		}		
	}
	
	/**
	 * @param string $filePath
	 * @throws ImageHandlerException
	 */	
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
				throw new Exceptions\ImageHandlerException('Unknown file type. Supported file types: jpg, png, gif.');				
			break;
		}
	}
	
	/**
	 * @param string $fileName
	 * @return type
	 */
	private function getFileExtensionByFileName($fileName)
	{
		$fileName = basename($fileName);
		
		$fileParts = explode('.', $fileName);
		
		return strtolower($fileParts[sizeof($fileParts)-1]);
	}	

}

?>