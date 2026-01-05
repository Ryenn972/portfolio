<?php

namespace Controllers;

use Repositories\ProjectRepository;

class ProjectController {

    public function createProject(): void {
        session_start();
        if (!isset($_SESSION['user'])) header('Location: index.php?route=login');

        // Récupération POST
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';

        // Upload image si nécessaire
        $imageName = null;
        if (isset($_FILES['projectImage']) && $_FILES['projectImage']['error'] === UPLOAD_ERR_OK) {
            $imageName = uniqid() . '.' . pathinfo($_FILES['projectImage']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['projectImage']['tmp_name'], './assets/img/' . $imageName);
        }

        // Appel à ProjectRepository (à créer)
        $repo = new ProjectRepository();
        $repo->insertProject($title, $category, $description, $imageName);

        header('Location: index.php?route=dashboard');
        exit;
    }

    public function editProject(int $id): void {
        session_start();
        if (!isset($_SESSION['user'])) header('Location: index.php?route=login');
        
        $userRepo = new \Repositories\UserRepository();
        $user = $userRepo->getUserByEmail($_SESSION['user']['email']);

        $repo = new ProjectRepository();
        $project = $repo->getProjectById($id);
        $categories = $repo->getAllCategories();
        $labels = $repo->getAllLabels();

        $template = 'edit_project';
        require 'views/layout.phtml';
    }

    public function updateProject(int $id): void {
        session_start();
        if (!isset($_SESSION['user'])) header('Location: index.php?route=login');

        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';
        $imageName = null;

        if (isset($_FILES['projectImage']) && $_FILES['projectImage']['error'] === UPLOAD_ERR_OK) {
            $imageName = uniqid() . '.' . pathinfo($_FILES['projectImage']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['projectImage']['tmp_name'], './assets/img/' . $imageName);
        }

        $repo = new ProjectRepository();
        $repo->updateProject($id, $title, $category, $description, $imageName);

        header('Location: index.php?route=dashboard');
        exit;
    }

    public function deleteProject(int $id): void {
        session_start();
        if (!isset($_SESSION['user'])) header('Location: index.php?route=login');

        $repo = new ProjectRepository();
        $repo->deleteProject($id);

        header('Location: index.php?route=dashboard');
        exit;
    }
}
