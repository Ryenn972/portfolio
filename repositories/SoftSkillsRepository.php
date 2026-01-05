<?php

namespace Repositories;

class SoftSkillsRepository {
    
    public function getAllSoftSkills():array{
        $pdo = getConnexion();
        $query = $pdo->prepare('SELECT * FROM soft_skills');
        $query->execute();
        
        $softSkillsData = $query->fetchAll();
        
        // Transformer les données en classe Model Project
        $softSkillsArray = [];
        foreach ($softSkillsData as $data){
            $softSkill = new \Models\SoftSkills();
            $softSkill->sanitize($data);
            $softSkillsArray[] = $softSkill;
            
        }
        
        return $softSkillsArray;
    }
}