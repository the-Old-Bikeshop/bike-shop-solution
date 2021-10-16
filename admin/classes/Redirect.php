<?php

class Redirect
{
    public function __construct($location) {
        header("Location: {$location}");
        exit;
    }
}