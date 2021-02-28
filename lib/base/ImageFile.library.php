<?php

/*
GD Image creation library

Usage:
$img = new ImageFile("Beach.jpg");
$img->createThumbnail(300, 200);

Copyright:
	All rights reserved to Fábio Arantes.

*/

class ImageFile {
	protected $originalFile, $imgAttrs, $thumb, $maxWdt, $maxHgt, $x, $y, $imgW, $imgH;
	const JPEG_QUALITY = 100;
	const PNG_QUALITY = 9;
	public function __construct($imageFile){
		$this->imgAttrs = getimagesize($imageFile);
		$this->createImageFromType($imageFile);
	}
	public function saveOptimizedImage($filename)
	{
		$type = $this->determineType($filename);
		
		switch($type)
		{
			case "JPEG":
				imagejpeg($this->originalFile, $filename, self::JPEG_QUALITY);
			break;
			case "GIF":
				imagegif($this->originalFile, $filename);
			break;
			case "PNG":
				imagepng($this->originalFile, $filename, self::PNG_QUALITY, PNG_ALL_FILTERS);
			break;
		}
		$const = constant("AMAZON_SAVE_THUMBS");
		if(!empty($const) && $const != false)
		{
			$client = AmazonS3::init();
			$result = $client->uploadFileReference($filename, $filename);
		}
	}
	private function createImageFromType($url){
		switch($this->imgAttrs["mime"])
		{
			case "image/jpeg":
				$this->originalFile = imagecreatefromjpeg($url);
			break;
			case "image/png":
				$this->originalFile = imagecreatefrompng($url);
			break;
			case "image/gif":
				$this->originalFile = imagecreatefromgif($url);
			break;
		}
	}
	private function determineType($fname)
	{		
		
		preg_match("/\.([a-z]+)$/i", $fname, $matches);

		switch(strtolower($matches[1]))
		{
			case "jpeg":
				$type = "JPEG";
			break;
			case "jpg":
				$type = "JPEG";
			break;
			case "gif":
				$type = "GIF";
			break;
			case "png":
				$type = "PNG";
			break;
		}
		return $type;
	}
	private function saveAlpha()
	{
			switch($this->imgAttrs["mime"])
			{
				case "image/png":
					imagealphablending($this->thumb, false);

			        // turning on alpha channel information saving (to ensure the full range 
			        // of transparency is preserved)
			        imagesavealpha($this->thumb, true);
				break;
				
			}
			
	}
	public function createSafeThumbnail($Wdt, $Hgt)
	{
		list($newW, $newH) = $this->calculateDimensions($Wdt, $Hgt);
		
		
		
		if($this->imgW > $newW)
		{
			$this->thumb = imagecreatetruecolor($newW, $newH);
			$this->saveAlpha();
			imagecopyresampled($this->thumb, $this->originalFile, 0, 0, 0, 0, $newW, $newH, $this->imgW, $this->imgH);
		} else {
			$this->thumb = imagecreatetruecolor($this->imgW, $this->imgH);
			$this->saveAlpha();
			imagecopyresampled($this->thumb, $this->originalFile, 0, 0, 0, 0, $this->imgW, $this->imgH, $this->imgW, $this->imgH);
		}
		
		
		//$this->thumb->thumbnailImage($newW, $newH);
	}
	public function createThumbnail($Wdt, $Hgt)
	{
		list($newW, $newH) = $this->calculateDimensions($Wdt, $Hgt);
		$this->thumb = imagecreatetruecolor($newW, $newH);
		$this->saveAlpha();
		imagealphablending($this->thumb, false);
		imagesavealpha($this->thumb, true);
		
		imagecopyresampled($this->thumb, $this->originalFile, 0, 0, 0, 0, $newW, $newH, $this->imgW, $this->imgH);
		//$this->thumb->thumbnailImage($newW, $newH);
	}
	private function calculateDimensions($Wdt, $Hgt, $minor = true)
	{
		
		$imgW = $this->imgAttrs[0];
		$imgH = $this->imgAttrs[1];
		
		$this->imgW = $imgW;
		$this->imgH = $imgH;
		
		if($imgW > $Wdt || $imgH > $Hgt)
		{
			if($imgW > 0){ $rW = $Wdt/$imgW; }
			if($imgH > 0){ $rH = $Hgt/$imgH; }
			
			/*
			if($rW > $rH)
			{
				$ratio = $rH;
			} else 
			{
				$ratio = $rW;
			}
			
			
			$newW = intval($imgW*$ratio);
			$newH = intval($imgH*$ratio);
			
			return array($newW, $newH);*/
		} else {
			if($imgW > 0){ $rW = $Wdt/$imgW; }
			if($imgH > 0){ $rH = $Hgt/$imgH; }
			
			/*
			if($rW > $rH)
			{
				$ratio = $rH;
			} else 
			{
				$ratio = $rW;
			}
			
			$newW = intval($imgW*$ratio);
			$newH = intval($imgH*$ratio);
			
			return array($newW, $newH);*/
		}
		if($minor == true)
		{
			if($rW > $rH)
			{
				$ratio = $rH;
			} else 
			{
				$ratio = $rW;
			}
		} else 
		{
			if($rW > $rH)
			{
				$ratio = $rW;
			} else 
			{
				$ratio = $r;
			}	
		}
		
		
		$newW = intval($imgW*$ratio);
		$newH = intval($imgH*$ratio);
		
		return array($newW, $newH);
	}
	
	public function createCropThumbnail($wdt, $hgt, $x = NULL, $y = NULL)
	{
		
		
		$imgW = $this->imgAttrs[0];
		$imgH = $this->imgAttrs[1];
		$imgRatio = $imgW / $imgH;
		
		$cropRatio = $wdt / $hgt;
		
		/*
		
		100 = 1000
		---   ----
		x     300
		
		*/
		$xPerc = NULL;
		$yPerc = NULL;
		
		if($x != NULL && $y != NULL)
		{
			$xPerc = (((100*$x)/$imgW)/100);
			$yPerc = (((100*$y)/$imgH)/100);
		}
		
		if($cropRatio >= 1)
		{
			$cropW = $imgW;
			$cropH = $cropW/$cropRatio;
			
			$x = 0;
			$y = ($imgH-$cropH) / 2;
			
		} else 
		{
			$cropH = $imgH;
			$cropW = $cropH*$cropRatio;
			
			$x = ($imgW-$cropW) / 2;
			$y = 0;
			
		} 
		
		
		$this->thumb = imagecreatetruecolor($wdt, $hgt);
		$this->saveAlpha();
		imagealphablending($this->thumb, false);
		imagesavealpha($this->thumb, true);
		
		if($cropW > $imgW || $cropH > $imgH)
		{
			if($cropW > $imgW)
			{
				$cropW = $imgW;
				$cropH = $cropW/$cropRatio;
				
				$x = 0;
				$y = ($imgH-$cropH) / 2;
				
			} 
			if($cropH > $imgH) {
				$cropH = $imgH;
				$cropW = $cropH*$cropRatio;
				
				$x = ($imgW-$cropW) / 2;
				$y = 0;
				
			}
		}
		if($xPerc != NULL && $yPerc != NULL)
		{
			$x = (($imgW*$xPerc)-($cropW/2));
			$y = (($imgH*$yPerc)-floor($cropH/2));
		}
		
		if(($x+$cropW) > $imgW){
			
			$x = $imgW - $cropW; 
		}
		if(($y+$cropH) > $imgH){
			$y = $imgH - $cropH;
		}
		
		if($x < 0)
		{
			$x = 0;
		}
		if($y < 0)
		{
			$y = 0;
		}
		
		imagecopyresampled($this->thumb, $this->originalFile, 0, 0, $x, $y, $wdt, $hgt, $cropW, $cropH);
		
		$tolerance = 0.3;
		
		
		if($wdt > $imgW || $hgt > $imgH)
		{
			//$this->gaussianBlur();
			//$this->sharpen();
			//$this->sharpen();
		}
		//print("Crop Size: " . $wdt . "x" . $hgt . " Crop ratio: ".$cropRatio." Image Size: " . $imgW . "x" . $imgH . " Image Ratio:" .$imgRatio . "<br />");
		//print("Crop Size 2: " . $cropW . "x" . $cropH); 
		
	}
	public function save($filename)
	{
		$type = $this->determineType($filename);
		
		switch($type)
		{
			case "JPEG":
				imagejpeg($this->thumb, $filename, self::JPEG_QUALITY);
			break;
			case "GIF":
				imagegif($this->thumb, $filename);
			break;
			case "PNG":
				imagepng($this->thumb, $filename, self::PNG_QUALITY, PNG_ALL_FILTERS);
			break;

		}
		$const = constant("AMAZON_SAVE_THUMBS");
		if(!empty($const) && $const != false)
		{
			$client = AmazonS3::init();
			$result = $client->uploadFileReference($filename, $filename);
		}
		//$this->thumb->writeImage($filename);
	}
	public function showBrowser($type)
	{
	
		switch(strtoupper($type))
		{
			case "JPEG":
				header('Content-Type: image/jpeg');
				imagejpeg($this->thumb);
			break;
			case "JPG":
				header('Content-Type: image/jpeg');
				imagejpeg($this->thumb);
			break;
			case "GIF":
				header('Content-Type: image/gif');
				imagegif($this->thumb);
			break;
			case "PNG":
				header('Content-Type: image/png');
				imagepng($this->thumb);
			break;
		}		
	}
	public function sharpen(){
		if($this->thumb)
		{
			$sharpenMatrix = array 
            ( 
                array(-1.2, -1, -1.2), 
                array(-1, 20, -1), 
                array(-1.2, -1, -1.2) 
            ); 

            // calculate the sharpen divisor 
            $divisor = array_sum(array_map('array_sum', $sharpenMatrix));            

            $offset = 0; 
            
            // apply the matrix 
            imageconvolution($this->thumb, $sharpenMatrix, $divisor, $offset); 

		}
		return false;
	}
	public function gaussianBlur()
	{
		if($this->thumb)
		{
			$Matrix = array 
            ( 
			
				array(0, 1.0, 0), 
                array(1.0, 2.0, 1.0), 
                array(0, 1.0, 0)
            );
			/*
			$Matrix = array 
            ( 
				array(0.5, 1.5, 0.5), 
                array(1.5, 2.5, 1.5), 
                array(0.5, 1.5, 0.5) 
				
				 
            );*/ 

            // calculate the sharpen divisor 
            $divisor = array_sum(array_map('array_sum', $Matrix));            

            $offset = 0; 
            
            // apply the matrix 
            imageconvolution($this->thumb, $Matrix, $divisor, $offset); 

		}
		return false;
	}
	public function grayscale()
	{
		if($this->thumb && function_exists("imagefilter") && imagefilter($this->thumb, IMG_FILTER_GRAYSCALE))
		{
			return true;	
		}
		return false;
	}
	public function colorize($R, $G, $B)
	{
		if($this->thumb && function_exists("imagefilter") && imagefilter($this->thumb, IMG_FILTER_COLORIZE, $R, $G, $B))
		{
			return true;	
		}
		return false;
	}
	public function imageHue($R, $G, $B)
	{
		$rgb = $R+$G+$B;
		$col = array($R/$rgb, $G/$rgb, $B/$rgb);
		$wdt = imagesx($this->thumb);
		$hgt = imagesy($this->thumb);
		
		for($y=0; $y<$hgt; $y++)
		{
			for($x=0; $x<$wdt; $x++)
			{
				$rgb = ImageColorAt($this->thumb, $x, $y);
				
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				
				$newR = $r*$col[0] + $g*$col[1] + $b*$col[2];
				$newG = $r*$col[2] + $g*$col[0] + $b*$col[1];
				$newB = $r*$col[1] + $g*$col[2] + $b*$col[0];
				
				imagesetpixel($this->thumb, $x, $y, imagecolorallocate($this->thumb, $newR, $newG, $newB));
			}
		}
	}
	
	
	public function __destruct()
	{
		if(!empty($this->thumb))
		{
			imagedestroy($this->thumb);	
		}
		imagedestroy($this->originalFile);
	}
}