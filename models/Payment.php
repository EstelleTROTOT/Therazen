<?php

require_once __DIR__ . '/../core/Database.php';

class Payment
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(
        int $appointmentId,
        float $amount,
        string $method,
        string $status,
        ?string $stripeSessionId,
        ?string $transactionReference
    ): bool {

        $sql = "INSERT INTO payments (
            appointment_id,
            amount,
            method,
            status,
            stripe_session_id,
            transaction_reference
        ) VALUES (
            :appointment_id,
            :amount,
            :method,
            :status,
            :stripe_session_id,
            :transaction_reference
        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':appointment_id' => $appointmentId,
            ':amount' => $amount,
            ':method' => $method,
            ':status' => $status,
            ':stripe_session_id' => $stripeSessionId,
            ':transaction_reference' => $transactionReference
        ]);
    }
}