<?php
class Browser {
	private $browser, $headers = array();
	public function __construct(){
		$this->browser = curl_init();
		curl_setopt ($this->browser, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($this->browser, CURLOPT_CONNECTTIMEOUT, 5);
	}
	public function setURL($url){
		curl_setopt ($this->browser, CURLOPT_URL, $url);
	}
	public function go(){
		if(count($this->headers) > 0)
		{
			curl_setopt($this->browser, CURLOPT_HTTPHEADER, $this->headers);
		}
		return curl_exec($this->browser);
	}
	public function addHeader($value){
		$this->headers[] = $value;
	}
	public function getInfo(){
		return curl_getinfo($this->browser);
	}
	public function addPOSTData($data)
	{
		curl_setopt($this->browser, CURLOPT_POST, true);
		curl_setopt($this->browser, CURLOPT_POSTFIELDS, $data);
	}
	public function downloadFile($file, $dest){
		if(self::isDownloadableFile($file)){
			$this->setURL($file);
			curl_setopt($this->browser, CURLOPT_FOLLOWLOCATION, true);
			$fileCont = $this->go();
			if($fileCont){
				return Document::writeFile($dest.self::fileName($file), $fileCont);
			} else {
				return false;
			}
		}
	}
	
	static function fileName($url){
		$filePreg = "/([a-zA-Z0-9_()-]+).([a-zA-Z0-9]{3})$/i";
		if(preg_match($filePreg, $url)){
			preg_match($filePreg, $url, $matches, PREG_OFFSET_CAPTURE);
			return $matches[0][0];
		} else {
			return false;
		}
	}
	static function isDownloadableFile($url){
		if(preg_match("/(([a-zA-Z0-9_()-]+).([a-zA-Z0-9]{3}))$/i", $url)){
			return true;
		} else {
			return false;
		}
	}
}
?>