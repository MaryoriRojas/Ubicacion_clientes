<?php
class Cliente {
    private $conn;
    private $table_name = "cliente";

    public $id;
    public $nombre;
    public $placa;
    public $telefono;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, placa=:placa, telefono=:telefono";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":telefono", $this->telefono);

        return $stmt->execute();
    }

    public function obtenerID() {
        return $this->conn->lastInsertId();
    }
}
