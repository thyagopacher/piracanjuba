<?php
class Akismet {
	private $key;
	private $akismet_ua = "CMS Container Digital/1.0 | Akismet/2.5.3";
	public function __construct($key)
	{
		$this->key = $key;
	}
	public function verifyKey()
	{
		$site = urlencode("http://".$_SERVER['SERVER_NAME']);
		$request = 'key='.$this->key."&blog=".$site;
		$host = $http_host = "rest.akismet.com";
		$path = '/1.1/verify-key';
		$port = 80;
		// Set Akismet User Agent
		
		
		$content_length = strlen( $request );
		$http_request = "POST $path HTTP/1.0".PHP_EOL;
		$http_request .= "Host: $host".PHP_EOL;
		$http_request .= "Content-Type: application/x-www-form-urlencoded".PHP_EOL;
		$http_request .= "Content-Length: {$content_length}".PHP_EOL;
		$http_request .= "User-Agent: {$this->akismet_ua}".PHP_EOL;
		$http_request .= PHP_EOL;
		$http_request .= $request;
		
		$response = "";
		if(false != ( $fs = @fsockopen( $http_host, $port, $errno, $errstr, 10 ) ) )
		{
			fwrite( $fs, $http_request);
			while ( !feof( $fs ) )
			{
				$response .= fgets( $fs, 1160 ); // 1160 = One TCP-IP Packet
			}
			$response = explode("\r\n\r\n", $response, 2);
			if( 'valid' == $response[1] )
			{
				return true;
			}
		}
		return false;
	}
	public function validate($name, $mail, $message, $url = NULL)
	{
		$data = array(
			"blog" => "http://".$_SERVER['SERVER_NAME']."/",
			"user_ip" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			
			"referrer" => ( !empty( $_SERVER['HTTP_REFERER'] ) )?$_SERVER['HTTP_REFERER']:"",
			"permalink" => "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],
			"comment_type" => "comment",
			"comment_author" => $name,
			"comment_author_email" => $mail,
			"comment_author_url" => $url,
			"comment_content" => $message,
		);
		$request = array();
		
		foreach($data as $key => $value)
		{
			$request[] = $key."=".urlencode($value);
		}
		
		$query_string = join( "&", $request );
		
		// Requisition Parameters
		$host = $this->key . ".rest.akismet.com";
		$path = "/1.1/comment-check";
		$port = 80;
		
		$content_length = strlen( $query_string );
		
		$http_request = "POST $path HTTP/1.0\r\n";
		$http_request .= "Host: $host\r\n";
		$http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$http_request .= "Content-Length: {$content_length}\r\n";
		$http_request .= "User-Agent: {$this->akismet_ua}\r\n";
		$http_request .= "\r\n";
		$http_request .= $query_string;
		
		$response = "";
		if( false != ( $fs = @fsockopen( $host , $port, $errno, $errstr, 10 ) ) )
		{
			
			fwrite( $fs, $http_request );
			while( !feof( $fs ) )
			{
				$response .= fgets( $fs, 1160 ); // 1160 = One TCP-IP Packet
			}
			fclose( $fs );
			
			$response = explode("\r\n\r\n", $response, 2) ;
			
			if( 'true' == $response[1])
			{
				return true;
			} else {
				return false;
			}
		}
		return true; 
	}
}
?>