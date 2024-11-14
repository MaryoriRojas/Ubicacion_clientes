<?php
class Ubicacion {
    private $conn;
    private $table_name = "ubicacion";

    public $id;
    public $nombre;
    public $disponible;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerLibre() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE disponible = 1 ORDER BY id ASC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarDisponibilidad($id, $disponible) {
        $query = "UPDATE " . $this->table_name . " SET disponible = :disponible WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":disponible", $disponible, PDO::PARAM_BOOL);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
    }
}
