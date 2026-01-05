<?php

namespace Controllers;

class HomeController{
    
    public function display(){
        session_start();
        
        // De quoi j'ai besoin ? (des données)
        $userRepo = new \Repositories\UserRepository();
        $user = $userRepo->getUserByEmail('ryenn.mith-catan@3wacademy.fr');
        
        $projectRepo = new \Repositories\ProjectRepository();
        $projectsArray = $projectRepo->getAllProjects();
        
        $hardSkillsRepo = new \Repositories\HardSkillsRepository();
        $hardSkillsArray = $hardSkillsRepo->getAllHardSkills();
        
        $softSkillsRepo = new \Repositories\SoftSkillsRepository();
        $softSkillsArray = $softSkillsRepo->getAllSoftSkills();
        
        // Où vais-je l'afficher ? 
        $template = 'home';
        require 'views/layout.phtml';
    }
}