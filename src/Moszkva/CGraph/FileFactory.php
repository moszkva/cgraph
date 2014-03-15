<?php

namespace Moszkva\CGraph;

class FileFactory
{	
	/**
	 * @var IImageHandler 
	 */
	private $ImageHandler;
	
	/**
	 * @var integer 
	 */
	private $maxWidth			= 100;
	
	/**
	 * @var integer 
	 */
	private $maxHeight			= 75;
	
	/**
	 * @param \Moszkva\CGraph\IImageHandler $ImageHandler
	 */
	public function __construct(IImageHandler $ImageHandler)
	{
		$this->ImageHandler = $ImageHandler;
	}
	
	public function getImageHandler()
	{
		return $this->ImageHandler;
	}
	
	/**
	 * @param string $outputFilePath
	 * @return type
	 */
	public function create($outputFilePath = '')
	{	
		$this->initImage();
		
		$width			= $this->getImageHandler()->getImageWidth();
		$height			= $this->getImageHandler()->getImageHeight();	
		
		$Builder	= new Builder();
		
		$Builder->setBackgroundCharacter('-');		
		$Builder->setCanvasSize($width, $height);

		for($y=0; $y <= $height-1; $y++)
		{
			for($x=0; $x <= $width-1; $x++)
			{		
				$Builder->setPoint(new Point(new Coordinate($x, $y), $this->getImageHandler()->getCharByCoordinate($x, $y)));
			}
		}
		
		if(trim($outputFilePath)=='')
		{
			return $Builder->render(true);
		}
		
		file_put_contents($outputFilePath, $Builder->render(true));
	}
	
	public function initImage()
	{
		$width			= $this->getImageHandler()->getImageWidth();
		$height			= $this->getImageHandler()->getImageHeight();	
		
		if($width > $this->maxWidth)
		{
			$oldWidth	= $width;
			$oldHeight	= $height;
			
			$rate = $this->maxWidth / $width ;
			
			$width	= $this->maxWidth;
			
			$height = $rate * $height;
			
			$this->getImageHandler()->resize($width, $height);
		}
		
		if($height > $this->maxHeight)
		{
			$oldWidth	= $width;
			$oldHeight	= $height;
			
			$rate = $this->maxHeight / $height ;
			
			$width	= $rate * $width;
			$height	= $this->maxHeight;

			$this->getImageHandler()->resize($width, $height);
		}
		
		$this->getImageHandler()->setContrast(-90);
	}
}

?>