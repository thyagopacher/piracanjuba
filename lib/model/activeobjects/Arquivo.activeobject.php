<?php
//define("APP_UPLOADS_PREFIX ", "uploads/");
	class Arquivo extends ActiveObject {
		protected $activeModel = "ArquivoModel";
		protected $FID = "ARQ_ID";
		private $fileFormats;

		public function __construct(){
			$configs = Configurator::init();

			$this->fileFormats = $configs->getViewConfig("imageFormats");
		}
		public function getId()
		{
			return $this->getARQID();
		}
		public function getARQID()
		{
			return $this->returnKey("ARQ_ID");
		}

		public function getARQEXT()
		{
			return $this->returnKey("ARQ_EXT");
		}

		public function getARQNOM()
		{
			return $this->returnKey("ARQ_NOM");
		}
		public function getURL()
		{
			return $this->getARQNOM();
		}
		public function getARQSTS()
		{
			return $this->returnKey("ARQ_STS");
		}
		public function getARQDTA()
		{
			return $this->returnKey("ARQ_DTA");
		}

		public function getARQDIR()
		{
			return $this->returnKey("ARQ_DIR");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function getImageDimensions(){
			$path = $this->getPath();
			if(file_exists($path))
			{
				list($width, $height, $type, $attr) = getimagesize($path);

				return $width."x".$height;
			} else {
				return "";
			}

		}
		public function getPath()
		{

			$path = (($this->getARQDIR()).(date("Y", strtotime($this->getARQDTA())))."/".(date("m", strtotime($this->getARQDTA())))."/".(date("d", strtotime($this->getARQDTA())))."/".$this->getARQNOM());
			return $path;
		}

		public function getPath2(){
			$path = $this->getPath();

			return str_replace("./","/",$path);;
		}
		public function getFormat($format)
		{
			if(!$this->checkIsImage()){
				return APP_WEB_PREFIX . "../web/images/icn-multimedia.png";
			}
			if(in_array($format, array_keys($this->fileFormats)))
			{
				$path = $this->getPath();
				$ext = $this->getARQEXT();
				return  str_replace("//", "/", str_replace("./","/",str_replace($this->getARQDIR(), $this->getARQDIR(), str_replace(".{$ext}", ".{$format}.{$ext}", "/".$path))));
			}
		}
		public function getSize()
		{
			return (@filesize($this->getPath())/1000);
		}
		public function toJSON()
		{
			$ret = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$ret->$prop = utf8_encode($value);
			}
			$ret->size = $this->getSize();
			if($this->checkIsImage())
			{
				$ret->dimensions = $this->getImageDimensions();

			}

			$ret->fileString = "".$this;

			$ret->url = utf8_encode(($this->getARQDIR()).(date("Y", strtotime($this->getARQDTA())))."/".(date("m", strtotime($this->getARQDTA())))."/".(date("d", strtotime($this->getARQDTA())))."/".$this->getARQNOM());
			$ret->url = str_replace('./','/', $ret->url);
			foreach($this->fileFormats as $Format => $dimensions)
			{

				if($this->checkIsImage())
				{
					$ext = Document::getFileExtension($ret->url);
					$ret->$Format = str_replace(".".$ext, ".{$Format}.{$ext}", $ret->url);
				} else {
					$ret->$Format = "/images/icn-multimedia.png";
				}

			}

			return $ret;
		}
		public function generateThumbs()
		{
			foreach($this->fileFormats as $Format => $dim)
			{
				$ext = Document::getFileExtension($this->getPath());
				$cPath = str_replace(".".$ext, ".{$Format}.{$ext}", $this->getPath());
				$img = new ImageFile($this->getPath());
				if(empty($dim[2]))
				{
					$img->createCropThumbnail($dim[0], $dim[1], NULL, NULL);
				} else {
					$img->createSafeThumbnail($dim[0], $dim[1], false);
				}
				$img->save($cPath);

			}
		}
		public function __toString()
		{
			$html = "";

			switch(strtolower($this->getARQEXT()))
			{
				case "mp3":
					$html = "<div class=\"audioPlayer player\" data-audio-mpeg=\"".("/uploads/" . $this->getPath())."\"><a href=\"#\" class=\"fa fa-play btn-play\"></a><a href=\"#\" class=\"fa fa-pause btn-pause hidden\"></a></div>";
				break;
				case "mp4":
					$html = "<video width=\"320\" height=\"240\" controls><source src=\"".("/uploads/" . $this->getPath())."\" type=\"video/mp4\">Your browser does not support the video tag.</video>";
				break;
				case "jpg":
					$html = "<img src=\"".("/uploads/" . $this->getPath())."\" />";
				break;
				case "png":
					$html = "<img src=\"".("/uploads/" . $this->getPath())."\" />";
				break;
				case "gif":
						$html = "<img src=\"".("/uploads/" . $this->getPath())."\" />";
				break;
				default:
					$html = ("/uploads/" . $this->getPath());
				break;
			}
			return $html;
		}
		public function isExtension($ext)
		{
			if(is_array($ext))
			{
				if(in_array(strtolower($this->getARQEXT()), $ext))
				{
					return true;
				}
			} else {
				if(strtolower($this->getARQEXT()) == $ext)
				{
					return true;
				}
			}
			return false;
		}
		public function checkIsImage(){
			$imageFormats = array("png", "gif", "jpg", "jpeg");
			if(in_array(strtolower($this->getARQEXT()), $imageFormats))
			{
				return true;
			}
			return false;
		}
		public function save()
		{

			if(empty($this->params['ARQ_DIR'])){
				$this->params['ARQ_DIR'] = APP_UPLOADS_PATH;
			}
			if($this->checkIsImage())
			{
				$this->generateThumbs();
			}

		  	return parent::save();
		}
	}
?>
