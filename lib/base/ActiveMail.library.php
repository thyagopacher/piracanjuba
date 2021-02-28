<?php
include(APP_PATH_PREFIX."lib/other/PHPMailer/PHPMailerAutoload.php");
class ActiveMail {
	private $mail;
	public function __construct()
	{
		$this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPAuth=true;
        $this->mail->SMTPSecure="tls";
        $this->mail->Host="smtp.gmail.com";
        $this->mail->Port=587;
        $this->mail->Username="piracanjuba.site@gmail.com";
        $this->mail->Password="f-15ceagle";
        $this->mail->From="piracanjuba.site@gmail.com";
        $this->mail->FromName="Piracanjuba";
	}
	public function addSubject($subject)
	{
		$this->mail->Subject = $subject;
	}
	public function addMessage($message)
	{
		$this->mail->Body = $message;
        $this->mail->AltBody = strip_tags($message);
	}
	public function addAttachment($file, $name){
		$this->mail->AddAttachment($file, $name);
	}
	public function addAddresses($arr)
	{
		foreach($arr as $email => $name)
		{
			$this->addAddress($name, $email);
		}
	}
	public function addAddress($name, $email)
	{
		$this->mail->AddAddress($email,$name);
	}
	public function sendMail()
	{
		if(!$this->mail->Send()){
			return false;
        }else{
          	return true;
        }
	}
}
?>
