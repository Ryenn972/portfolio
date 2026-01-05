<?php

namespace Controllers;

class ErrorController {
    
    public function display() {
        $userRepo = new \Repositories\UserRepository();
        $user = $userRepo->getUserByEmail('ryenn.mith-catan@3wacademy.fr');
        
        $template = 'error';
        require 'views/layout.phtml';
    }
}