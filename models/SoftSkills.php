<?php

namespace Models;

class SoftSkills {
    private int $id;
    private string $softSkillName;
    private string $softSkillPercentage;
    
    // Getter et setter pour toutes les propriétés

    public function getId():int{
        return $this->id;
    }
    
    public function setId(int $id):void{
        $this->id = $id;
    }
    
    public function getSoftSkillName():string{
        return $this->softSkillName;
    }
    
    public function setSoftSkillName(string $softSkillName):void{
        $this->softSkillName = $softSkillName;
    }
    
    public function getSoftSkillPercentage():int{
        return $this->softSkillPercentage;
    }
    
    public function setSoftSkillPercentage(int $softSkillPercentage):void{
        $this->softSkillPercentage = $softSkillPercentage;
    }
    
    public function sanitize(array $softSkillsData){
        // Transformer ce qui vient de la base de données en un objet de la classe User
        
        $this->id = $softSkillsData['id'];
        $this->softSkillName = $softSkillsData['name'];
        $this->softSkillPercentage = $softSkillsData['percentage'];
        
        return $this;
    }
}