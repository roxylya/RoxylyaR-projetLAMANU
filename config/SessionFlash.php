<?php

class Session
{
    public function __construct()
    {
        session_start();
    }
    public function setFlash($message)
    {
        $_SESSION['flash'] = $message;
    }
}
