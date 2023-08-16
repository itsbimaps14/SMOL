<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = Array(
	'protocol' 	=> 'smtp',
	'smtp_host' => 'ssl://smtp.googlemail.com',
	'smtp_port' => 465,
	'smtp_user' => '#changethistoyourownsmtp',
	'smtp_pass' => '#changethistoyourownsmtp',
	'mailtype'  => 'html',
	'charset'   => 'utf-8',
	'newline'	=> "\r\n",
	'wordwrap' 	=> 'true'
);
/* / Last Line of Email Config, Location application/config.email.php */