<?php

require __DIR__ . '/../vendor/autoload.php';

use Moszkva\CGraph\IImage;
use Moszkva\CGraph\Image;
use Moszkva\CGraph\IImageHandler;
use Moszkva\CGraph\ImageHandler;
use Moszkva\CGraph\FileFactory;
use Moszkva\CGraph\Exception;

try
{
	if(is_array($argv) && sizeof($argv) > 1)
	{
		$CGraphFileFactory = new FileFactory(new ImageHandler(new Image($argv[1])));

		$CGraphFileFactory->create('php://output');
	}
	else
	{
		throw new Exception('Input image file is a mandatory param.');
	}
}
catch(Exception $e)
{
	file_put_contents('php://stderr', $e->getMessage());
}

?>