<?php

class Session
{
    // public function __construct()
    // {
    //     session_start();
    // }
    public static function setMessage($message)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['message'] = $message;
    }

    public static function getMessage()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['message'])) {
            return  $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }
}
