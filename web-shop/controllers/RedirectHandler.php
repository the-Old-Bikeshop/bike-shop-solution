<?php

class RedirectHandler
{
    public function __construct($location) {
        header("Location: {$location}");
        exit;
    }
}