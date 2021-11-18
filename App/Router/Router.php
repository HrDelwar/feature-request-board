<?php

namespace Hr\WpFRB\Router;

class Router
{
    public function __construct()
    {
        if(is_admin()){
            new Admin();
        }else{
            new Frontend();
        }
    }
}