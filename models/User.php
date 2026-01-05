<?php

namespace Models;

class User {
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    
    // Getter et setter pour toutes les propriétés
    
    public function getId():int{
        return $this->id;
    }
    
    public function setId(int $id):void{
        $this->id = $id;
    }
    
    public function getFirstname():string{
        return $this->firstname;
    }
    
    public function setFirstname(string $firstname):void{
        $this->firstname = $firstname;
    }
    
    public function getLastname():string{
        return $this->lastname;
    }
    
    public function setLastname(string $lastname):void{
        $this->lastname = $lastname;
    }
    
    public function getEmail():string{
        return $this->email;
    }
    
    public function setEmail(string $email):void{
        $this->email = $email;
    }
    
    public function getProfilePicture():string{
        return $this->profilePicture;
    }
    
    public function setProfilePicture(string $profilePicture):void{
        $this->profilePicture = $profilePicture;
    }
    
    public function getProfileDescription():string{
        return $this->profileDescription;
    }
    
    public function setProfileDescription(string $profileDescription):void{
        $this->profileDescription = $profileDescription;
    }
    
    public function getBirthdate():string{
        return $this->birthdate;
    }
    
    public function setBirthdate(string $birthdate):void{
        $this->birthdate = $birthdate;
    }
    
    public function getPhoneNumber():string{
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber(string $phoneNumber):void{
        $this->phoneNumber = $phoneNumber;
    }
    
    public function sanitize(array $usersData){
        // Transformer ce qui vient de la base de données en un objet de la classe User
        
        $this->id = $usersData['id'];
        $this->firstname = $usersData['firstname'];
        $this->lastname = $usersData['lastname'];
        $this->email = $usersData['email'];
        $this->profilePicture = $usersData['profile_picture'];
        $this->profileDescription = $usersData['profile_description'];
        $this->birthdate = $usersData['birthdate'];
        $this->phoneNumber = $usersData['phone_number'];
        
        return $this;
    }
}
