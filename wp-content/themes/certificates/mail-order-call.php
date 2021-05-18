<?php
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'); 
    $recepient = 'info@sootvetstvie.by';
    $sender = 'admin@noreply';
    $sitename = 'Sootvetstvie';
    $name = trim($_POST["username"]);
    $phone = trim($_POST["phone"]);
    $message = "Клиент: <b>$name</b> просит вас перезвонить ему! Номер телефона: <b>$phone</b>.";
    $pagetitle = "Новая заявка с сайта \"$sitename\"";
    mail($recepient, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\n From: $sender");