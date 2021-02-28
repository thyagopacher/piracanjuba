<?php
	class FuriousValidationFile extends FuriousValidation
	{
		
		
		public function __construct (array $params = null)
		{
			parent::__construct($params);
			$this->messages["Format"] = "Arquivo de formato incorreto";
		}
		public function validateDefault()
		{
			return true;	
		}
		public function validateMinLength ( $v, $min )
		{
			if(strlen(trim($v)) >= $min)
			{
				return true;
			}
			return false;
		}
		public function validateRequired ($v, $param)
		{
			if(!empty($v) && $v != null && $v != false)
			{
				return true;
			}
			return false;
		}
		public function validateFormat ( $v, $param )
		{
			// Detect if has Fileinfo Extension
			$file = $this->field->getFile();
			$mime = $file->type;
			if($mime != null)
			{
				if( !in_array( $mime, $param ) )
				{
					if( file_exists( $v ) )
					{
						Document::removeFile( $v );	
					}
					return false;
				}
			}
			return true;
			
		}
	}
?>