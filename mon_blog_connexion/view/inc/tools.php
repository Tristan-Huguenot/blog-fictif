<?php

    function handleSessionMessage(){

        if(!isset($_SESSION['message'])) return false;

        $message = $_SESSION['message'];
        unset($_SESSION['message']);

        return $message;

    }