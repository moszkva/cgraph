<?php

namespace Moszkva\CGraph;

interface IImage
{
	public function __construct($source);
	public function create($source);
	public function getImage();
}

?>