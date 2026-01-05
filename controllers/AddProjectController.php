<?php

namespace Controllers;

class AddProjectController {

    public function display(): void {
        session_start();
        if (!isset($_SESSION['user'])) header('Location: index.php?route=login');
        
        $userRepo = new \Repositories\UserRepository();
        $user = $userRepo->getUserByEmail($_SESSION['user']['email']);
        
        $projectRepo = new \Repositories\ProjectRepository();

        $categories = $projectRepo->getAllCategories();
        $labels = $projectRepo->getAllLabels();

        $errors = [];

        $template = 'add_project';
        require 'views/layout.phtml';
    }

    public function create(): void {
        $errors = [];

        // Vérification des champs
        if (empty($_POST['title'])) { $errors[] = "Title is required"; }
        if (empty($_POST['category'])) { $errors[] = "Category is required"; }
        if (empty($_POST['description'])) { $errors[] = "Description is required"; }

        // Labels → tableau vide si rien coché
        $labels = $_POST['labels'] ?? [];

        // Upload image
        $imageName = null;
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = "assets/img/";
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $errors[] = "Image upload failed.";
            }
        }

        if (!empty($errors)) {
            session_start();
            if (!isset($_SESSION['user'])) header('Location: index.php?route=login');
            
            $userRepo = new \Repositories\UserRepository();
            $user = $userRepo->getUserByEmail($_SESSION['user']['email']);
            $projectRepo = new \Repositories\ProjectRepository();

            $categories = $projectRepo->getAllCategories();
            $labels = $projectRepo->getAllLabels();
            
            $template = 'add_project';
            require 'views/layout.phtml';
            return;
        }

        // Enregistrement du projet
        $projectRepo = new \Repositories\ProjectRepository();
        $newProjectId = $projectRepo->insertProject(
            $_POST['title'],
            $_POST['category'],
            $_POST['description'],
            $imageName,
            $_POST['link'] ?? ""
        );

        // Enregistrer les labels du projet
        $projectRepo->assignLabelsToProject($newProjectId, $labels);

        header("Location: index.php?route=dashboard");
        exit();
    }
}
