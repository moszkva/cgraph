<?php

namespace Moszkva\CGraph;

interface ICGraphImageHandler
{
	public function openFile($filePath);
	public function getImageWidth();
	public function getImageHeight();
	public function getColorAt($x, $y);
	public function setContrast($contrast);
	public function resize($newWidth, $newHeight);
	public function getCharByCoordinate($x, $y);
	public function getImage();
}

?>