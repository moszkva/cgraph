<?php

require __DIR__ . '/../vendor/autoload.php';

use Moszkva\CGraph\FileFactory;
use Moszkva\CGraph\Exception;

if(is_array($argv) && trim($argv[1])!='')
{
	$CGraphFileFactory = new FileFactory($argv[1]);

	$CGraphFileFactory->create('php://output');
}
else
{
	throw new Exception('Input image file is a mandatory param.');
}

?>