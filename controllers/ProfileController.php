<?php

namespace Controllers;

use Repositories\UserRepository;

class ProfileController {

    // Affiche le formulaire d'édition
    public function editProfile(): void {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $userRepo = new UserRepository();
        $user = $userRepo->getUserByEmail($_SESSION['user']['email']);

        $template = 'edit_profile';
        require 'views/layout.phtml';
    }

    // Traite le formulaire et met à jour le profil
    public function updateProfile(): void {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?route=login');
            exit;
        }

        // Récupération POST + sanitisation
        $firstname = htmlspecialchars($_POST['firstname'] ?? '');
        $lastname = htmlspecialchars($_POST['lastname'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $phone = htmlspecialchars($_POST['phone'] ?? '');
        $birthdate = htmlspecialchars($_POST['birthdate'] ?? '');
        $description = htmlspecialchars($_POST['description'] ?? '');
        
        // Gestion de l'upload de la photo
        $profilePictureName = null;
        
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = './assets/img/'; // chemin vers assets/img
            $tmpName = $_FILES['profilePicture']['tmp_name'];
            $originalName = basename($_FILES['profilePicture']['name']);
        
            // Vérification de l'extension
            $allowedExtensions = ['jpg','jpeg','png','gif'];
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        
            if (in_array($ext, $allowedExtensions)) {
                // Générer un nom unique pour éviter les collisions
                $profilePictureName = uniqid() . '.' . $ext;
                $destination = $uploadDir . $profilePictureName;
        
                if (!move_uploaded_file($tmpName, $destination)) {
                    $errorMessage = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $errorMessage = "Format d'image non supporté (jpg, png, gif).";
            }
        }

        // Validation minimale
        $errors = [];
        if (empty($firstname)) $errors[] = "First name is required";
        if (empty($lastname)) $errors[] = "Last name is required";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";

        if (!empty($errors)) {
            $errorMessage = implode(' | ', $errors);
            $userRepo = new UserRepository();
            $user = $userRepo->getUserByEmail($_SESSION['user']['email']);
            $template = 'edit_profile';
            require 'views/layout.phtml';
            return;
        }

        try {
            $userRepo = new UserRepository();
            $userRepo->updateUserByEmail(
                $_SESSION['user']['email'],
                $firstname,
                $lastname,
                $email,
                $description,
                $birthdate,
                $phone,
                $profilePictureName
            );

            // Mettre à jour la session si l'email a changé
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['firstname'] = $firstname;
            $_SESSION['user']['lastname'] = $lastname;

            $successMessage = "Profile updated successfully!";
        } catch (\Exception $e) {
            $errorMessage = "An error occurred while updating your profile.";
        }

        // Récupération des données mises à jour
        $user = $userRepo->getUserByEmail($email);
        $template = 'edit_profile';
        require 'views/layout.phtml';
    }
}
