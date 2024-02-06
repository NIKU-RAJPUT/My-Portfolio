<?php

class PHP_Email_Form
{
    private $to;
    private $from_name;
    private $from_email;
    private $subject;
    private $message;
    private $headers;
    private $additional_headers;

    public function __construct()
    {
        $this->additional_headers = array();
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setFrom($name, $email)
    {
        $this->from_name = $name;
        $this->from_email = $email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function addHeader($header)
    {
        $this->additional_headers[] = $header;
    }

    public function send()
    {
        $this->headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
        $this->headers .= "Reply-To: {$this->from_email}\r\n";
        $this->headers .= "MIME-Version: 1.0\r\n";
        $this->headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

        foreach ($this->additional_headers as $header) {
            $this->headers .= $header . "\r\n";
        }

        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}

?>
