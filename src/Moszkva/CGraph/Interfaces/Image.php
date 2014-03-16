<?php

namespace Moszkva\CGraph\Interfaces;

interface Image
{
	/**
	 * @see Image::create=()
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