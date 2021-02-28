<?php
	class IndexController extends DefaultController
	{

		public function index($vars = null)
		{

			echo "oiiiiiiii";
			exit;
		}


		public function enviaEmail(){

			require APP_PATH_PREFIX."/lib/other/PHPMailer/class.phpmailer.php";


			$nome = $_POST['nome'];
			$email = $_POST['email'];
			//$telefone = $_POST['telefone'];
			$mensagem = $_POST['mensagem'];

			// Inicia a classe PHPMailer
			$mail = new PHPMailer();
			$mail->IsSMTP(); // Define que a mensagem será SMTP
			$mail->SMTPAuth=true;
			$mail->SMTPSecure="tls";
			$mail->Host="smtp.mailgun.org";
			//$mail->Host="email-smtp.us-east-1.amazonaws.com";
			$mail->Port=587;
			//$mail->Username="AKIAJB7YSUK5VXFGP6NQ";
			//$mail->Password="AvASyGfXYuOQHrCPH+s8M9cxmjInadTbBXMaWKgTY6hC";
			$mail->Username="postmaster@sandboxfe4124033db140d59fe16d6e2d9bac73.mailgun.org";
			$mail->Password="00d522cf0f2f81137efabb7eab8127a8";
			$mail->From=$email;

			$mail->From = $email; // Seu e-mail
			$mail->FromName = $nome; // Seu nome
			$mail->AddAddress('suggestion@exceda.com', 'Exceda');
			//$mail->AddAddress('ciclano@site.net');

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML




			$mail->Subject  = "Contato do site Exceda"; // Assunto da mensagem
			$mail->Body = "<p>Nome :$nome</p><p>Email: $email</p><br /><p>Mensagem: $mensagem</p>";

			$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";

			$enviado = $mail->Send();

			$mail->ClearAllRecipients();
			$mail->ClearAttachments();



			if ($enviado) {
				echo 1;
			} else {
				echo "<pre>";
				print_r($mail->ErrorInfo);
				echo "</pre>";
				exit;
			}


		}
	}
?>
