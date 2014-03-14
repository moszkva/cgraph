<?php

namespace Moszkva\CGraph;

class CGraphFileFactory
{
	/**
	 * @var  CGraphImageHandler
	 */
	private $CGraphImageHandler;
	
	/**
	 * @var string 
	 */
	private $sourceFilePath;
	
	/**
	 * @var integer 
	 */
	private $maxWidth			= 100;
	
	/**
	 * @var integer 
	 */
	private $maxHeight			= 75;
	
	public function __construct($sourceFilePath)
	{
		$this->sourceFilePath = $sourceFilePath;
	}
	
	public function getCGraphImageHandler()
	{
		return $this->CGraphImageHandler;
	}
	
	public function create($outputFilePath = '')
	{
		$this->CGraphImageHandler	= new CGraphImageHandler($this->sourceFilePath);
		
		$this->initImage();
		
		$width			= $this->CGraphImageHandler->getImageWidth();
		$height			= $this->CGraphImageHandler->getImageHeight();	
		
		$CGraphBuilder	= new CGraphBuilder();
		
		$CGraphBuilder->setBackgroundCharacter('-');		
		$CGraphBuilder->setCanvasSize($width, $height);

		for($y=0; $y <= $height-1; $y++)
		{
			for($x=0; $x <= $width-1; $x++)
			{		
				$CGraphBuilder->setPoint(new CGraphPoint(new CGraphCoordinate($x, $y), $this->CGraphImageHandler->getCharByCoordinate($x, $y)));
			}
		}
		
		if(trim($outputFilePath)=='')
		{
			return $CGraphBuilder->render(true);
		}
		
		file_put_contents($outputFilePath, $CGraphBuilder->render(true));
	}
	
	public function initImage()
	{
		$width			= $this->CGraphImageHandler->getImageWidth();
		$height			= $this->CGraphImageHandler->getImageHeight();	
		
		if($width > $this->maxWidth)
		{
			$oldWidth	= $width;
			$oldHeight	= $height;
			
			$rate = $this->maxWidth / $width ;
			
			$width	= $this->maxWidth;
			
			$height = $rate * $height;
			
			$this->CGraphImageHandler->resize($width, $height);
		}
		
		if($height > $this->maxHeight)
		{
			$oldWidth	= $width;
			$oldHeight	= $height;
			
			$rate = $this->maxHeight / $height ;
			
			$width	= $rate * $width;
			$height	= $this->maxHeight;

			$this->CGraphImageHandler->resize($width, $height);
		}
		
		//$this->CGraphImageHandler->rotate(90, 1);
		$this->CGraphImageHandler->setContrast(-90);
	}
}

?>