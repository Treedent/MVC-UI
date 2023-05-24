<?php

namespace SYRADEV\Model;

use SYRADEV\app\UsersController;

class UserModel
{
    public int $active;
    public string $role;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;


    /**
     * Système :
     * Constructeur du modèle User
     * @param $userInfos
     * @return UserModel $UserModel L'objet User
     */
    public function __construct($userInfos) {

        // Récupération du jeton CSRF pour le décryptage du mot de passe
        $usersObj = UsersController::getInstance();
        $csrfToken = $usersObj->getCsrfToken();

        // On affecte les valeurs du post à l'objet UserModel
        $this->active = isset($userInfos['active']) ? (int)$userInfos['active'] : 0;
        $this->role = (string)$userInfos['role'];
        $this->firstname = (string)$userInfos['firstname'];
        $this->lastname = (string)$userInfos['lastname'];
        // On décrypte l'adresse email reçue
        $this->email = (string)$usersObj->aesDecrypt(base64_decode($userInfos['cryptedEmail']), $csrfToken);

        // Si un mot de passe est foourni
        if(!empty($userInfos['cryptedPw'])) {
        // On décrypte le mot de passe reçu et on le hash avec l'algorythme argon2id
            $this->password = $usersObj->argon2idHash($usersObj->aesDecrypt(base64_decode($userInfos['cryptedPw']), $csrfToken));
        }
        return $this;
    }
}