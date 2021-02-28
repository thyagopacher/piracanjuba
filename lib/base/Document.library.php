<?php
class Document {
	static function writeFile($path, $content){
		$file = fopen($path, "w+");
				fwrite($file, $content);
				fclose($file);
		// Change Permission
		//self::changePerms($path);
		
		if(preg_match("/(uploads)\//i", $path))
		{
			//$const = constant("AMAZON_SAVE_THUMBS");
			//if(!empty($const) && $const != false)
			//{
			//	$client = AmazonS3::init();
			//		$result = $client->uploadFileReference($path, $path);
			//}
		}
		
		
	}
	static function appendtoFile($path, $content){
		$file = fopen($path, "a+");
				fwrite($file, $content);
				fclose($file);
		// Change Permission
		//self::changePerms($path);
		
		
	}
	
	static function openFile($path){
		$file = fopen($path, "r");
		$content = fread($file, filesize($path));
		fclose($file);
		return $content;
	}
	static function hasFile($file)
	{
		return file_exists($file);	
	}
	static function isDir($file)
	{
		return is_dir($file);
	}
	static function changePerms($filename, $perm = "0777")
	{
		return chmod($filename, $perm);
	}
	static function generateFilePrefix($fileName, $path)
	{
		
		$fileExt = self::getFileExtension($fileName);
		$fileName = str_replace(".".$fileExt,"",$fileName);
		
		$i = 1;
		
		do {
			$pathFile = $path . $fileName . "({$i}).".$fileExt;
			if(!self::hasFile($pathFile))
			{
				return $fileName . "({$i}).".$fileExt;
			}
			
			$i++;
		} while($i <= 100);
		return false;
	}
	static function createDirIfNotExists($name, $path)
	{
		$path = (substr($path, -1) != "/")?$path."/":$path;
		if(!Document::hasFile($path.$name))
		{
			if(Document::createDirectory($name, $path))
			{
				return true;
			}
		}
		return true;
	}
	static function createDirectory($name, $path)
	{
		if(substr($path, -1) != "/"){
			$path .= "/";
		}
		
		$ret = mkdir(sprintf("%s%s", $path,$name));
		//self::changePerms(sprintf("%s%s", $path,$name));
		return $ret;
	}
	static function getModTime($file)
	{
		return filemtime($file);
	}
	static function getFileName($filePath){
		preg_match("/([a-zA-Z0-9_-]+).[a-zA-Z0-9]{3,4}$/", $filePath, $matches);
		return $matches[0];
	}
	static function renameFile($oldFile, $newFile){
		return rename($oldFile, $newFile);
	}
	static function removeFile($file){
		return unlink($file);
	}
	static function moveFile($file, $dest){
		if(self::copyFile($file, $dest)){
			return self::removeFile($file);
		}
		return false;
	}
	static function deleteFile($fileName)
	{
		if(self::hasFile($fileName))
		{
			return unlink($fileName);
		}
		return false;
	}
	static function getFileExtension($fileName)
	{
		preg_match("/\.([a-z0-9]+)$/i", $fileName, $matches);
		return $matches[1];
	}
	static function moveUploadedFile($file, $dest)
	{
		$ret =  move_uploaded_file($file, $dest);
		
		
		
		//if(preg_match("/(uploads)\//i", $dest))
		//{
		//	$client = AmazonS3::init();
		//	$result = $client->uploadFileReference($dest, $dest);
		//}
		
		return $ret;
	}
	static function copyFile($local, $dest){
		return copy($local, $dest);
	}
	static function listDirectory($dir)
	{
		$files = array();
		if($handle = opendir($dir))
		{
			while(false !== ($entry = readdir($handle)))
			{
				if($entry != "." && $entry != "..")
				{
					$files[] = $entry;
				}
			}
			closedir($handle);
		}
		return $files;
	}
	static function openZipFile($file, $to){
		$zip = zip_open($file);
		$extractedFiles = array();
		while($entry = zip_read($zip))
		{
			$name = basename(zip_entry_name($entry));
			
			if(!preg_match("/^\.(.+)$/i", $name) && $name != "__MACOSX" && $name != "thumbs.db")
			{
				$file = zip_entry_open($zip, $entry, "rb");
				$size = zip_entry_filesize($entry);
				preg_match("/\.([a-zA-Z0-9]+)$/i", $name, $matches);
				$ext = $matches[0];
				
				$content = zip_entry_read($entry, $size);
				$newFname = $to. md5(basename($name, $ext)) . $ext;
				Document::writeFile($newFname, $content);
				
				$extractedFiles[$name] = $newFname;
			}
		}
		return ((!empty($extractedFiles))?$extractedFiles:false);
	}
	static function renderDirStructure($id, $folder)
	{
		if(!Document::hasFile("{$folder}/".substr("0000".$id,-4,-2)))
		{
			Document::createDirectory(substr("0000".$id,-4,-2), "{$folder}/");
		}
		if(!Document::hasFile("{$folder}/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
		{
			Document::createDirectory(substr("00".$id,-2), "{$folder}/".substr("0000".$id,-4,-2));
		}
		if(Document::hasFile("{$folder}/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
		{
			return "{$folder}/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/";
		}
		return false;
	}
	static function generateDirStructure($id)
	{
		return APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/";
	}
	static function renderYMDStructure($folder, $timestamp = null)
	{
		if($timestamp == null)
		{
			$timestamp = time();
		}
		if(!Document::hasFile("{$folder}/".date("Y", $timestamp)))
		{
			Document::createDirectory(date("Y", $timestamp), "{$folder}/");
		}
		if(!Document::hasFile("{$folder}/".date("Y", $timestamp)."/".date("m", $timestamp)))
		{
			Document::createDirectory(date("m", $timestamp), "{$folder}/".date("Y", $timestamp));
		}
		if(!Document::hasFile("{$folder}/".date("Y", $timestamp)."/".date("m", $timestamp)."/".date("d", $timestamp)))
		{
			Document::createDirectory(date("d", $timestamp), "{$folder}/".date("Y", $timestamp)."/".date("m", $timestamp));
		}
		if(Document::hasFile("{$folder}/".date("Y", $timestamp)."/".date("m", $timestamp)."/".date("d", $timestamp)))
		{
			return "{$folder}/".date("Y", $timestamp)."/".date("m", $timestamp)."/".date("d", $timestamp)."/";
		}
		return false;
	}
}