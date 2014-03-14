<?php

require __DIR__ . '/../vendor/autoload.php';

use Moszkva\CGraph\CGraphFileFactory;
use Moszkva\CGraph\CGraphException;

if(is_array($argv) && trim($argv[1])!='')
{
	$CGraphFileFactory = new CGraphFileFactory('c:\\wamp\\www\\testapp\\cgraph\\test.jpg');

	$CGraphFileFactory->create('php://output');
}
else
{
	throw new CGraphException('Input image file is a mandatory param.');
}

?>