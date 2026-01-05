<?php

namespace Repositories;

class ProjectRepository {
    
    public function getProjectById(int $id): ?\Models\Project {
        $pdo = getConnexion();
    
        // Requête SQL pour récupérer un projet et sa catégorie
        $query = $pdo->prepare("SELECT p.*, c.name AS category_name FROM projects p LEFT JOIN categories c ON p.id_categories = c.id WHERE p.id = :id");
        $query->execute(['id' => $id]);
        $projectData = $query->fetch();
    
        if (!$projectData) {
            return null; // Retourne null si aucun projet trouvé
        }
    
        // Créer l'objet Project
        $project = new \Models\Project();
        $project->sanitize($projectData);
        $project->setCategoryName($projectData['category_name']);
    
        // Récupérer les labels associés
        $queryLabels = $pdo->prepare("SELECT l.name FROM labels l INNER JOIN projects_labels pl ON l.id = pl.id_label WHERE pl.id_project = :id");
        $queryLabels->execute(['id' => $id]);
        $labels = $queryLabels->fetchAll();
    
        $project->setLabels($labels);
    
        return $project;
    }
    
    public function getAllProjects():array{
        $pdo = getConnexion();
        $query = $pdo->prepare('SELECT p.*, c.name AS category_name FROM projects p LEFT JOIN categories c ON p.id_categories = c.id');
        $query->execute();
        
        $projectsData = $query->fetchAll();
        
        // Transformer les données en classe Model Project
        $projectsArray = [];
        foreach ($projectsData as $data){
            $project = new \Models\Project();
            $project->sanitize($data);
            $project->setCategoryName($data['category_name']);
            
            $queryLabels = $pdo->prepare('SELECT l.name FROM labels l INNER JOIN projects_labels pl ON l.id = pl.id_label WHERE pl.id_project = :id');
            $queryLabels->execute(['id' => $data['id']]);
            $labels = $queryLabels->fetchALL();
            
            $project->setLabels($labels);
            
            $projectsArray[] = $project;
            
        }
        
        return $projectsArray;
    }
    
    // Ajouter un projet
    public function insertProject(string $title, string $category, string $description, ?string $imageName, string $link): int {
        $pdo = getConnexion();
        $query = $pdo->prepare("
            INSERT INTO projects (title, id_categories, description, image_url, link)
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->execute([$title, $category, $description, $imageName, $link]);
    
        return $pdo->lastInsertId();
    }
    
    // Modifier un projet
    public function updateProject(int $id, string $title, string $category, string $description, ?string $imageName = null): void {
        $pdo = getConnexion();
    
        if ($imageName) {
            $query = $pdo->prepare("UPDATE projects 
                SET title = ?, id_categories = ?, description = ?, image_url = ? 
                WHERE id = ?");
            $query->execute([$title, $category, $description, $imageName, $id]);
        } else {
            $query = $pdo->prepare("UPDATE projects 
                SET title = ?, id_categories = ?, description = ?
                WHERE id = ?");
            $query->execute([$title, $category, $description, $id]);
        }
    }
    
    // Supprimer un projet
    public function deleteProject(int $projectId): void {
        $pdo = getConnexion();
        $query = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $query->execute([$projectId]);
    }
    
    public function getAllCategories(): array {
        $pdo = getConnexion();
        $query = $pdo->prepare("SELECT * FROM categories ORDER BY name ASC");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getAllLabels(): array {
        $pdo = getConnexion();
        $query = $pdo->prepare("SELECT * FROM labels ORDER BY name ASC");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function assignLabelsToProject(int $projectId, array $labels): void {
        $pdo = getConnexion();
    
        // Supprime les liens existants au cas où
        $pdo->prepare("DELETE FROM projects_labels WHERE id_project = ?")->execute([$projectId]);
    
        // Réinsère les nouveaux labels
        $query = $pdo->prepare("INSERT INTO projects_labels (id_project, id_label) VALUES (?, ?)");
    
        foreach ($labels as $labelId) {
            $query->execute([$projectId, $labelId]);
        }
    }
}