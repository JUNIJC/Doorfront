<?php

function get_json_data($file) {
    return json_decode(file_get_contents(ROOT . 'core/data/' . $file . '.json'));
}

use PHPMailer\PHPMailer\PHPMailer;


function send_server_mail($to, $from, $title, $message) {

    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $title, $message, $headers);
}

function sendmail($to, $title, $message) {
    global $settings;

    if(!empty($settings->smtp_host)) {

        try {
            $mail = new PHPMailer;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;

            if ($settings->smtp_encryption != '0') {
                $mail->SMTPSecure = $settings->smtp_encryption;
            }

            $mail->SMTPAuth = $settings->smtp_auth;
            $mail->isHTML(true);

            $mail->Host = $settings->smtp_host;
            $mail->Port = $settings->smtp_port;
            $mail->Username = $settings->smtp_user;
            $mail->Password = $settings->smtp_pass;

            $mail->setFrom($settings->smtp_from, $settings->title);
            $mail->addReplyTo($settings->smtp_from, $settings->title);
            $mail->addAddress($to);
            $mail->Subject = $title;
            $mail->Body = $message;

            $sent = $mail->send();
        } catch (Exception $e) {
//            echo 'Message could not be sent.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }


    } else {
        send_server_mail($to, $settings->smtp_from, $title, $message);
    }

}


function parse_url_parameters() {
	return (isset($_GET['page'])) ? explode('/', filter_var(rtrim($_GET['page'], '/'), FILTER_SANITIZE_URL)) : [];
}

function redirect($new_page = '') {
	global $settings;

	header('Location: ' . $settings->url . $new_page);
	die();
}

function trim_value(&$value) {
	$value = trim($value);
}

function filter_banned_words($value) {
	global $settings;

	$words = explode(',', $settings->banned_words);
	array_walk($words, 'trim_value');

	foreach($words as $word) {
		$value = str_replace($word, str_repeat('*', strlen($word)), $value);
	}

	return $value;
}


function generate_slug($string, $delimiter = '_') {

		/* Convert accents characters */
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

		/* Replace all non words characters with the specified $delimiter */
		$string = preg_replace('/\W/', $delimiter, $string);

		/* Check for double $delimiters and remove them so it only will be 1 delimiter */
		$string = preg_replace('/_+/', '_', $string);

		/* Remove the $delimiter character from the start and the end of the string */
		$string = trim($string, $delimiter);

		return $string;
}

function generate_string($length) {
	$characters = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
	$content = '';

	for($i = 1; $i <= $length; $i++) {
		$content .= $characters[array_rand($characters, 1)];
	}

	return $content;
}

function remove_emoji($text){
      return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}

function resize($file_name, $path, $width, $height, $center = false) {
	/* Get original image x y*/
	list($w, $h) = getimagesize($file_name);

	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	$y = 0;
	if($center) $y = 250 + $h/1.5;

	/* read binary data from image file */
	$imgString = file_get_contents($file_name);

	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
	0, 0,
	$x, $y,
	$width, $height,
	$w, $h);

	/* Save image */
	imagejpeg($tmp, $path, 100);

	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}

function formatBytes($bytes, $precision = 2) {
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';

    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';

    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

function string_resize($string, $maxchar) {
	$length = strlen($string);
	if($length > $maxchar) {
		$cutsize = -($length-$maxchar);
		$string  = substr($string, 0, $cutsize);
		$string  = $string . '..';
	}
	return $string;
}



function display_notifications() {
	global $language;

	$types = ['error', 'success', 'info'];
	foreach($types as $type) {
		if(isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
			if(!is_array($_SESSION[$type])) $_SESSION[$type] = [$_SESSION[$type]];

			foreach($_SESSION[$type] as $message) {
				$csstype = ($type == 'error') ? 'danger' : $type;

				echo '
					<div class="alert alert-' . $csstype . ' animated fadeInDown">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>' . $language->global->message_type->$type . '</strong> ' . $message . '
					</div>
				';
			}
			unset($_SESSION[$type]);
		}
	}

}

?>
