<?php
	error_reporting(0);
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'functions.php';
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';
	
	$req = $_POST['req'];
	
	$response_title = 'Empty Title';
	$response_message = 'Empty Message';
	
	//Уведомления на почту
	$email_charset = 'UTF-8';
	$recipient_email = 'gimailart@gmail.com';
	$smtp_server = 'ssl://smtp.gmail.com';
	$smtp_port = 465;
	$smtp_username = 'salamandra.beauty';
	$smtp_password = 'Okey123450art';
	$smtp_sender = 'salamandra.beauty@gmail.com';
	$smtp_sender_name = 'SALAMANDRA';
	
	//Уведомления телеграмма
	$chatidd = '361456537';
	$telegram_token = '803507711:AAEdwa8HyXjoyhOgDXcfDPN-bgvzo4X7VuM';
	
	if ($req == 'newApplication') {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$people_amount = $_POST['people_amount'];
		$country = $_POST['country'];
		$money = $_POST['money'];
		
		if ($name != '' && $phone != '' && $email != '' && $people_amount != '' && $country != '' && $money != '') {
			$mail = new PHPMailer();
            
			// Settings
			$mail->IsSMTP();
			$mail->CharSet = $email_charset;
			
			$mail->SMTPSecure = 'ssl';
			$mail->Host       = $smtp_server;
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;
			$mail->Timeout	  = 10;
			$mail->SMTPKeepAlive = false;
			$mail->Port       = $smtp_port;
			$mail->Username   = $smtp_username;
			$mail->Password   = $smtp_password;
			
			
			//Recipents
			$mail->setFrom($smtp_sender, $smtp_sender_name);
			$mail->addAddress($recipient_email);
			
			//Content
			$mail->isHTML(true);
			$mail->Subject = 'Новая заявка';
			$mail->Body    = 'Имя: ' . $name . '<br>Телефон: ' . $phone . '<br>EMAIL: ' . $email . '<br>Кол-во людей: ' . $people_amount . '<br>Страна: ' . $country . '<br>Бюджет: ' . $money;
			$mail->AltBody = 'Имя: ' . $name . '
			Телефон: ' . $phone . '
			EMAIL: ' . $email . '
			Кол-во людей: ' . $people_amount . '
			Страна: ' . $country . '
			Бюджет: ' . $money;
			
			$mail->send();
			
			sendMessage($chatidd, 'Новая заявка на сайте'.PHP_EOL.'Имя: ' . $name . ''.PHP_EOL.'Телефон: ' . $phone . ''.PHP_EOL.'EMAIL: ' . $email . ''.PHP_EOL.'Кол-во людей: ' . $people_amount . ''.PHP_EOL.'Страна: ' . $country . ''.PHP_EOL.'Бюджет: ' . $money, $telegram_token);
			
			$response_title = 'Спасибо, ваша заявка принята!';
			$response_message = 'Мы свяжемся с вами в ближайшее время';
		} else {
			$response_title = 'Ошибка';
			$response_message = 'Укажите все данные в форме';
		}
	} elseif ($req == 'newCallback') {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		
		if ($name != '' && $phone != '') {
			$mail = new PHPMailer();
            
			// Settings
			$mail->IsSMTP();
			$mail->CharSet = $email_charset;
			
			$mail->SMTPSecure = 'ssl';
			$mail->Host       = $smtp_server;
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;
			$mail->Timeout	  = 10;
			$mail->SMTPKeepAlive = false;
			$mail->Port       = $smtp_port;
			$mail->Username   = $smtp_username;
			$mail->Password   = $smtp_password;
			
			
			//Recipents
			$mail->setFrom($smtp_sender, $smtp_sender_name);
			$mail->addAddress($recipient_email);
			
			//Content
			$mail->isHTML(true);
			$mail->Subject = 'Новая заявка';
			$mail->Body    = 'Имя: ' . $name . '<br>Телефон: ' . $phone;
			
			$mail->send();
			
			sendMessage($chatidd, 'Новая заявка перезвонить'.PHP_EOL.'Имя: ' . $name . ''.PHP_EOL.'Телефон: ' . $phone, $telegram_token);
			
			$response_title = 'Спасибо, ваша заявка принята!';
			$response_message = 'Мы свяжемся с вами в ближайшее время';
		} else {
			$response_title = 'Ошибка';
			$response_message = 'Укажите все данные в форме';
		}
	} else {
		$response_title = 'Ошибка';
		$response_message = 'Неверный запрос к серверу';
	}
	echo json_encode(array('response_title' => $response_title, 'response_message' => $response_message));
?>