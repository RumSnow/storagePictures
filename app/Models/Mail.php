<?php
namespace App\Models;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mail{
//  private $mailer;
//
//  public function __construct(Swift_Mailer $mailer){
//    $this->mailer = $mailer;
//  }

  public function send($email, $textMessage){
//    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
//    dd($email, $textMessage);
    $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
      ->setUsername('semenovra-es')
      ->setPassword('qwerty12345');
//    var_dump($transport);

    $mailer = new Swift_Mailer($transport);
//    var_dump($mailer);

//    die;

    $message = (new Swift_Message("Проектище"))
      ->setFrom(['semenovra-es@mail.ru' => 'Test'])
      ->setTo($email)
      ->setBody($textMessage);
//    dd($message);
    return $mailer->send($message);
  }
}