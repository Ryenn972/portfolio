<?php

namespace Controllers;

use Repositories\UserRepository;

class DashboardController {

    // Affiche le dashboard principal
    public function display(): void {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $userRepo = new UserRepository();
        $user = $userRepo->getUserByEmail($_SESSION['user']['email']);
        
        $projectRepo = new \Repositories\ProjectRepository();
        $projectsArray = $projectRepo->getAllProjects();
        
        $hardSkillsRepo = new \Repositories\HardSkillsRepository();
        $hardSkillsArray = $hardSkillsRepo->getAllHardSkills();
        
        $softSkillsRepo = new \Repositories\SoftSkillsRepository();
        $softSkillsArray = $softSkillsRepo->getAllSoftSkills();

        $template = 'dashboard';
        require 'views/layout.phtml';
    }
}
