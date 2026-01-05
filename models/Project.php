<?php

namespace Models;

class Project {
    private int $id;
    private string $title;
    private string $projectDescription;
    private string $projectImg;
    private string $projectLink;
    private string $categoryName;
    private int $categoryId;
    private array $labels;
    
    // Getter et setter pour toutes les propriétés

    public function getId():int{
        return $this->id;
    }
    
    public function setId(int $id):void{
        $this->id = $id;
    }
    
    public function getTitle():string{
        return $this->title;
    }
    
    public function setTitle(string $title):void{
        $this->title = $title;
    }
    
    public function getProjectDescription():string{
        return $this->projectDescription;
    }
    
    public function setProjectDescription(string $projectDescription):void{
        $this->projectDescription = $projectDescription;
    }
    
    public function getProjectImg():string{
        return $this->projectImg;
    }
    
    public function setProjectImg(string $projectImg):void{
        $this->projectImg = $projectImg;
    }
    
    public function getProjectLink():string{
        return $this->projectLink;
    }
    
    public function setProjectLink(string $projectLink):void{
        $this->projectLink = $projectLink;
    }
    
    public function getCategoryName():string{
        return $this->categoryName;
    }
    
    public function setCategoryName(string $categoryName):void{
        $this->categoryName = $categoryName;
    }
    
    public function getCategoryId(): int {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void {
       $this->categoryId = $categoryId;
    }

    
    public function setLabels(array $labels):void{
        $this->labels = $labels;
    }
    
    public function getLabels():array{
        return $this->labels;
    }
    
    public function sanitize(array $projectsData){
        // Transformer ce qui vient de la base de données en un objet de la classe User
        
        $this->id = $projectsData['id'];
        $this->title = $projectsData['title'];
        $this->projectDescription = $projectsData['description'];
        $this->projectImg = $projectsData['image_url'];
        $this->projectLink = $projectsData['link'];
        $this->categoryId = $projectsData['id_categories'];
        $this->categoryName = $projectsData['category_name'];

        
        return $this;
    }
}