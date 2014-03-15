<?php

namespace Moszkva\CGraph;

interface IImage
{
	/**
	 * @see IImage::create=()
	 */
	public function __construct($source);
	
	/**
	 * @param string $source -  Valid readable stream or filepath
	 */
	public function create($source);
	
	/**
	 * @return resource - Image resource
	 */
	public function getImage();
}

?>