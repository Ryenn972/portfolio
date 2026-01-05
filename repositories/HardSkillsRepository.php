<?php

namespace Repositories;

class HardSkillsRepository {
    
    public function getAllHardSkills():array{
        $pdo = getConnexion();
        $query = $pdo->prepare('SELECT * FROM hard_skills');
        $query->execute();
        
        $hardSkillsData = $query->fetchAll();
        
        // Transformer les données en classe Model Project
        $hardSkillsArray = [];
        foreach ($hardSkillsData as $data){
            $hardSkill = new \Models\HardSkills();
            $hardSkill->sanitize($data);
            $hardSkillsArray[] = $hardSkill;
            
        }
        
        return $hardSkillsArray;
    }
}