<?php
include(APP_PATH_PREFIX."lib/other/aws.phar");
use Aws\S3\S3Client;

class AmazonS3 {
	static $client;
	private $con;
	static function init()
	{
		if(!empty(self::$client))
		{
			return self::$client;
		}
		else {
			self::$client = new AmazonS3();
			return self::$client;
		}
	}
	public function __construct()
	{		
		$this->con = S3Client::factory(array(
			'key' => AMAZON_KEY,
			'secret' => AMAZON_SECRET
		));
	}
	public function listBuckets()
	{
		$result = $this->con->listBuckets();
		return $result;
	}
	public function uploadFile($path, $content)
	{
		$result = $this->con->putObject(array(
		    'Bucket' => AMAZON_BUCKET,
		    'Key'    => $path,
		    'Body'   => $content,
			'ACL'	=> 'public-read'
		));
		return $result;
	}
	public function uploadFileReference($path, $file)
	{
		$result = $this->con->putObject(array(
		    'Bucket' => AMAZON_BUCKET,
		    'Key'    => $path,
		    'SourceFile'   => $file,
			'ACL'	=> 'public-read'
		));
		return $result;
	}
}
?>