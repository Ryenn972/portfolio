<?php

namespace Models;

class HardSkills {
    private int $id;
    private string $hardSkillName;
    private string $hardSkillPercentage;
    
    // Getter et setter pour toutes les propriétés

    public function getId():int{
        return $this->id;
    }
    
    public function setId(int $id):void{
        $this->id = $id;
    }
    
    public function getHardSkillName():string{
        return $this->hardSkillName;
    }
    
    public function setHardSkillName(string $hardSkillName):void{
        $this->hardSkillName = $hardSkillName;
    }
    
    public function getHardSkillPercentage():int{
        return $this->hardSkillPercentage;
    }
    
    public function setHardSkillPercentage(int $hardSkillPercentage):void{
        $this->hardSkillPercentage = $hardSkillPercentage;
    }
    
    public function sanitize(array $hardSkillsData){
        // Transformer ce qui vient de la base de données en un objet de la classe User
        
        $this->id = $hardSkillsData['id'];
        $this->hardSkillName = $hardSkillsData['name'];
        $this->hardSkillPercentage = $hardSkillsData['percentage'];
        
        return $this;
    }
}