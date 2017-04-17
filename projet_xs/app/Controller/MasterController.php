<?php

namespace Controller;

use \W\Security\AuthentificationModel;

class MasterController extends \W\Controller\Controller
{
    protected $mail;

    protected function mailer($fromAddress, $fromName, $toAddress, $toName, $subject, $msgHTML)
    {
        $app = getApp();

        //Create a new PHPMailer instance
        $this->mail = new \PHPMailer;
        //Tell PHPMailer to use SMTP
        $this->mail->isSMTP();
        $this->mail->CharSet = 'utf-8';
        //Set the hostname of the mail server
        $this->mail->Host = $app->getConfig('phpmailer_host');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->mail->Port = $app->getConfig('phpmailer_port');
        //Set the encryption system to use - ssl (deprecated) or tls
        $this->mail->SMTPSecure = $app->getConfig('phpmailer_SMTPSecure');
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = $app->getConfig('phpmailer_SMTPAuth');
        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = $app->getConfig('phpmailer_username');
        //Password to use for SMTP authentication
        $this->mail->Password = $app->getConfig('phpmailer_password');

        //Set who the message is to be sent from
        $this->mail->setFrom($fromAddress, $fromName);
        //Set who the message is to be sent to
        $this->mail->addAddress($toAddress, $toName);
        //Set the subject line
        $this->mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $this->mail->msgHTML($msgHTML);
        //send the message, check for errors
        if (!$this->mail->send()) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        }
    }

    protected function paginate($page, $limit, $model, $modelMethod)
    {
            $params['page'] 	= $page;
            $params['limit'] 	= $limit;
            $params['set'] 		= $model->{$modelMethod}('id', 'id', 'ASC', $limit, ($page - 1) * $limit);
            $params['total'] 	= $model->lastFoundRows();

            return $params;
    }

}
