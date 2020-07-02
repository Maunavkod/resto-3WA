<?php

class UserModel
{
    /**
     * @param $lastName - Ceci est la valeur du champ last_name dans notre formulaire
     * @param $firstName
     * @param $email
     * @param $password
     * @param $address
     * @param $zipCode
     * @param $city
     * @param $phone
     * @return string
     * @throws DomainException
     */
    public function signUp(
        string $lastName,
        string $firstName,
        string $email,
        string $password,
        string $address,
        string $zipCode,
        string $city,
        string $phone
    )
    {
        $db = new Database();
        
        // (laissez de côté) Vérifier s'il n'existe pas déjà un utilisateur avec l'adresse email spécifiée -> Requete SQL
        $user = $db->queryOne('SELECT email FROM user WHERE email = ?', [$email]);
        if (!empty($user)) {
            throw new DomainException(
                sprintf(
                    'Il existe déjà un utilisateur avec l\'adresse email : %s',
                    $email
                )
            );
        }
        
        // 1 - Ajouter un utilisateur dans la BDD
        $sql = '
        INSERT INTO user
            (last_name, first_name, email, password, address, zip_code, city, phone, created_at)
        VALUES
            (:last_name, :first_name, :email, :password, :address, :zip_code, :city, :phone, :created_at)
        ';
        
        return $db->executeSql($sql, [
            ':last_name'  => $lastName,
            ':first_name' => $firstName,
            ':email'      => $email,
            ':password'   => $this->hashPassword($password),
            ':address'    => $address,
            ':zip_code'   => $zipCode,
            ':city'       => $city,
            ':phone'      => $phone,
            ':created_at' => date_create()->format('Y-m-d H:i:s'),
        ]);
    }
    
    private function hashPassword(string $password): string
    {
        // $salt = '$2y13$' . bin2hex(random_bytes(22));
        // return crypt($password, $salt);
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    /**
     * @param string $password Mot de passe en clair saisi dans le formulaire
     * @param string $hashedPassword - Mot de passe hashé provenant de la base de donnée
     * @return bool
     */
    private function verifyPassword(string $password, string $hashedPassword): bool
    {
        // return crypt($password, $hashedPassword) === $hashedPassword;
        return password_verify($password, $hashedPassword);
    }
}