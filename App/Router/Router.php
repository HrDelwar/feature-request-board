<?php

namespace Hr\WpFRB\Router;

class Router
{
    public function __construct()
    {
        new Admin();
        new Frontend();
    }
}