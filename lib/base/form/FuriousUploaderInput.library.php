<?php
	class FuriousUploaderInput extends FuriousFormElement
	{
		protected $hasUpload = true;
		protected $fileOpts;
		protected $file;
		protected $tmpfile, $destFile;
		public function __construct($name, $label, array $fileOpts, array $params = null){
			$this->name = $name;

			$this->label = new htmlElement("label");
			$this->label->setContent($label);

			$this->input = new htmlElement("input");
			$this->input->setAttribute("type", "file");
			$this->input->setAttribute("name", $name);
			
			$this->fileOpts = $fileOpts;
			 
			if(isset($params))
			{
				foreach($params as $key => $value)
				{
					$this->input->setAttribute($key, $value);
				}
			}
		}
		public function setFile($file)
		{
			if(is_object($file))
			{
				if(get_class($file) == "stdClass")
				{				
					$tmpfile = $file->tmpName;
					$destFile = $this->fileOpts["fileStorage"]."".md5($file->name.date("d/m/Y h:i:s:u"));
					$ext = Document::getFileExtension($file->name);
					$destFile .= ".{$ext}";

					$this->destFile = $destFile;
					$this->tmpFile = $tmpfile;
					$this->file = $file;

				}
			}
		}
		public function save()
		{
			if(isset($this->tmpFile))
			{
				if(Document::moveUploadedFile($this->tmpFile, $this->destFile))
				{
					$this->setValue($this->destFile);
				}
			} else {
				$this->setValue("");
			}
			
		}
		public function getFile()
		{
			return $this->file;
		}
	}
?>