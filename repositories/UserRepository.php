<?php

namespace Repositories;

class UserRepository {
    
    public function getUserByEmail(string $email):\Models\User{
        $pdo = getConnexion();
        $query = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        // Transformer les données en classe Model User
        $user = new \Models\User();
        $user->sanitize($query->fetch());
        return $user;
    }
    
    public function updateUserByEmail(
        string $currentEmail,
        string $newFirstName,
        string $newLastName,
        string $newEmail,
        string $newProfileDescription,
        string $newBirthdate,
        string $newPhoneNumber,
        ?string $profilePicture = null
    ): void {
        $pdo = getConnexion();

        if ($profilePicture) {
            $query = $pdo->prepare("
                UPDATE users 
                SET firstname = ?, lastname = ?, email = ?, profile_description = ?, birthdate = ?, phone_number = ?, profile_picture = ?
                WHERE email = ?
            ");
            $query->execute([
                $newFirstName,
                $newLastName,
                $newEmail,
                $newProfileDescription,
                $newBirthdate,
                $newPhoneNumber,
                $profilePicture,
                $currentEmail
            ]);
        } else {
            $query = $pdo->prepare("
                UPDATE users 
                SET firstname = ?, lastname = ?, email = ?, profile_description = ?, birthdate = ?, phone_number = ?
                WHERE email = ?
            ");
            $query->execute([
                $newFirstName,
                $newLastName,
                $newEmail,
                $newProfileDescription,
                $newBirthdate,
                $newPhoneNumber,
                $currentEmail
            ]);
        }
    }
}