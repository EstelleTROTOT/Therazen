<?php

require_once __DIR__ . '/../core/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create($firstName, $lastName, $email, $password, $phone)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, password, phone, role)
                VALUES (:first_name, :last_name, :email, :password, :phone, 'patient')";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':phone' => $phone
        ]);
    }

   public function findByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([':email' => $email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateProfile($id, $firstName, $lastName, $email, $phone)
{
    $sql = "UPDATE users
            SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone
            WHERE id = :id";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':id' => $id,
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':email' => $email,
        ':phone' => $phone
    ]);
}
}