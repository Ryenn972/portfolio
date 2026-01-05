<?php

// Remplacer par un autoloader qui gère les namespaces
require 'config/database.php';

spl_autoload_register(function ($class) {
    
    require str_replace('\\', '/', lcfirst($class)).'.php';
    
});

// Si le paramètre route existe alors on le teste pour savoir quelle page afficher
if(isset($_GET['route'])){
    switch($_GET['route']){
        case 'home':
            $controller = new Controllers\HomeController();
            $controller->display();
            break;
            
        case 'login':
            $controller = new Controllers\LoginController();
            $controller->display();
            break;
        
        case 'login_submit':
            $controller = new Controllers\LoginController();
            $controller->login();
            break;
        
        case 'dashboard':
            $controller = new Controllers\DashboardController();
            $controller->display();
            break;
        
        case 'edit_profile':
            $controller = new Controllers\ProfileController();
            $controller->editProfile();
            break;
        
        case 'update_profile':
            $controller = new Controllers\ProfileController();
            $controller->updateProfile();
            break;
            
        case 'logout':
            session_start();
            session_destroy();
            header('Location: index.php?route=home');
            exit;
        
        case 'project_details':
            if (isset($_GET['id'])) {
                $controller = new Controllers\ProjectDetailsController();
                $controller->display($_GET['id']); 
            } else {
                echo "Projet introuvable";
            }
            break;
        
        case 'edit_profile_submit':
            $controller = new Controllers\ProfileController();
            $controller->updateProfile();
            break;
            
        case 'add_project':
            $controller = new Controllers\AddProjectController();
            $controller->display();
            break;
        
        case 'create_project':
            $controller = new Controllers\AddProjectController();
            $controller->create();
            break;
        
        case 'edit_project':
            if (isset($_GET['id'])) {
                $controller = new Controllers\ProjectController();
                $controller->editProject($_GET['id']);
            }
            break;
        
        case 'update_project':
            if (isset($_GET['id'])) {
                $controller = new Controllers\ProjectController();
                $controller->updateProject($_GET['id']);
            }
            break;
        
        case 'delete_project':
            if (isset($_GET['id'])) {
                $controller = new Controllers\ProjectController();
                $controller->deleteProject($_GET['id']);
            }
            break;
                
        default:
            $controller = new Controllers\ErrorController();
            $controller->display();
            break;
    }
}
// Sinon on va sur la page d'accueil
else {
    $controller = new Controllers\HomeController();
    $controller->display();
}