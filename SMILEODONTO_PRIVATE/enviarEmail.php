<?php

	require "../../SMILEODONTO_PRIVATE/PHPMailer/Exception.php";
	require "../../SMILEODONTO_PRIVATE/PHPMailer/OAuth.php";
	require "../../SMILEODONTO_PRIVATE/PHPMailer/PHPMailer.php";
	require "../../SMILEODONTO_PRIVATE/PHPMailer/POP3.php";
	require "../../SMILEODONTO_PRIVATE/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	$destinatario      = $_POST['destinatario'];
	$mensagem          = $_POST['mensagem'];
	$assunto           = $_POST['assunto'];


	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->CharSet = 'UTF-8';
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'mariaeduardaleal66@gmail.com';                 // SMTP username
	    $mail->Password = 'projota12';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                // TCP port to connect to

	    //Recipients
	    $mail->setFrom('mariaeduardaleal66@gmail.com', 'Maria Eduarda Remetente');
	    $mail->addAddress('mariaeduardaleal66@gmail.com', 'Maria Eduarda Destinatário');     // Add a recipient
	    //$mail->addReplyTo('mariaeduardaleal66@gmail.com', 'Maria Eduarda');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Oi. Eu sou o assunto.';
	    $mail->Body    = 'Oi. Eu sou o <strong> corpo </strong>.';
	    $mail->AltBody = 'Oi. Eu sou o corpo.';

	    $mail->send();
	    echo 'Sucesso';
	} catch (Exception $e) {
	    echo 'Não foi possível enviar este e-mail! Por favor, tente novamente mais tarde.';
	    echo 'Detalhes do erro: ' . $mail->ErrorInfo;
	}


?>