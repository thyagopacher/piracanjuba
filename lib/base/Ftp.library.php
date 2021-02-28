<?php
	require_once("Document.class.php");
	
	class FTP {
		private $con;
		public function __construct($host, $user, $pass, $initialDir, $port = 21){
			$this->con = ftp_connect($host, $port, 5);
			if($this->con){
				if(ftp_login($this->con, $user, $pass)){
					$this->changeDir($initialDir);
				}
			}
		}
		public function cwd(){
			return ftp_pwd($this->con);
		}
		public function __destruct(){
			ftp_close($this->con);
		}
		public function makeDir($dirName){
			return ftp_mkdir($this->con, $dirName);
		}
		public function changeDir($dir){
			if(!@ftp_chdir($this->con, $dir)){
				return false;
			} else {
				return true;
			}
		}
		public function rename($fileOld, $newName){
			return ftp_rename($this->con, $fileOld, $newName);
		}
		public function downloadFile($localfileName, $serverFile){
			return ftp_fget($this->con, $localfileName, $serverFile, FTP_BINARY);
		}
		public function hasFile($fileName){
			$files = $this->listFiles();
			$keys = array_keys($files, $fileName);
			if(count($keys) >= 1){
				return true;
			} else {
				return false;
			}
		}
		public function listFiles(){
			return ftp_nlist($this->con, ".");
		}
		public function uploadFile($fileLocal, $serverDir){
			$fileOp = fopen($fileLocal, "r");
			$this->changeDir($serverDir);
			
			if(ftp_alloc($this->con, filesize($fileLocal))){
				if(ftp_fput($this->con, Document::getFileName($fileLocal), $fileOp, FTP_BINARY)){
					return true;
				} else {
					return false;
				}
			} else {
				echo "Unable allocate space on server";
				return false;
			}
		}
	}
	
	
?>