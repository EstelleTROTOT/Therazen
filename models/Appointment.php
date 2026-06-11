<?php

require_once __DIR__ . '/../core/Database.php';

class Appointment
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAppointmentsByDate($date)
    {
        $sql = "SELECT * FROM appointments
                WHERE DATE(appointment_start) = :date
                AND appointment_status = 'scheduled'
                ORDER BY appointment_start ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':date' => $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastAppointmentByDate($date)
    {
        $sql = "SELECT * FROM appointments
                WHERE DATE(appointment_start) = :date
                AND appointment_status = 'scheduled'
                ORDER BY appointment_end DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':date' => $date]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBlockedSlotsByDate($date)
    {
        $sql = "SELECT * FROM blocked_slots
                WHERE DATE(blocked_start) = :date
                ORDER BY blocked_start ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':date' => $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppointmentsOrderedByDate($date)
    {
        $sql = "SELECT *
                FROM appointments
                WHERE DATE(appointment_start) = :date
                AND appointment_status = 'scheduled'
                ORDER BY appointment_start ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':date' => $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createAppointment(
    int $patientId,
    string $consultationType,
    string $motif,
    ?string $address,
    ?string $postalCode,
    ?string $city,
    string $appointmentStart,
    string $appointmentEnd
): bool {

    $sql = "INSERT INTO appointments (
        patient_id,
        consultation_type,
        motif,
        address,
        postal_code,
        city,
        appointment_start,
        appointment_end,
        appointment_status,
        payment_status
    ) VALUES (
        :patient_id,
        :consultation_type,
        :motif,
        :address,
        :postal_code,
        :city,
        :appointment_start,
        :appointment_end,
        'scheduled',
        'pending'
    )";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':patient_id' => $patientId,
        ':consultation_type' => $consultationType,
        ':motif' => $motif,
        ':address' => $address,
        ':postal_code' => $postalCode,
        ':city' => $city,
        ':appointment_start' => $appointmentStart,
        ':appointment_end' => $appointmentEnd
    ]);
}
}