<?php
require_once 'Database.php';

class Proceso {
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function getAll($filters = []) {
        // Realizamos el JOIN con la tabla usuarios para obtener el nombre
        $sql = "SELECT pe.*, u.nombre AS usuario_nombre 
                FROM procesos_eventos pe 
                JOIN usuarios u ON pe.id_usuario = u.id 
                WHERE 1=1";
        $params = [];
    
        // Filtrar por el nombre del usuario (si se proporciona)
        if (!empty($filters['usuario'])) {
            $sql .= " AND u.nombre LIKE ?";
            $params[] = "%" . $filters['usuario'] . "%";
        }
        
        // Filtros para procesos
        if (!empty($filters['objeto'])) {
            $sql .= " AND pe.objeto LIKE ?";
            $params[] = "%" . $filters['objeto'] . "%";
        }
        if (!empty($filters['descripcion'])) {
            $sql .= " AND pe.descripcion LIKE ?";
            $params[] = "%" . $filters['descripcion'] . "%";
        }
        if (!empty($filters['moneda'])) {
            $sql .= " AND pe.moneda = ?";
            $params[] = $filters['moneda'];
        }
        if (!empty($filters['presupuesto'])) {
            $sql .= " AND pe.presupuesto = ?";
            $params[] = $filters['presupuesto'];
        }
        if (!empty($filters['actividad'])) {
            $sql .= " AND pe.actividad LIKE ?";
            $params[] = "%" . $filters['actividad'] . "%";
        }
        if (!empty($filters['fecha_inicio'])) {
            $sql .= " AND pe.fecha_inicio >= ?";
            $params[] = $filters['fecha_inicio'];
        }
        if (!empty($filters['fecha_cierre'])) {
            $sql .= " AND pe.fecha_cierre <= ?";
            $params[] = $filters['fecha_cierre'];
        }
    
        $sql .= " ORDER BY pe.fecha_inicio DESC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM procesos_eventos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO procesos_eventos (objeto, descripcion, moneda, presupuesto, actividad, fecha_inicio, fecha_cierre, id_usuario) 
                                    VALUES (:objeto, :descripcion, :moneda, :presupuesto, :actividad, :fecha_inicio, :fecha_cierre, :id_usuario)");
        return $stmt->execute([
            ':objeto'       => $data['objeto'],
            ':descripcion'  => $data['descripcion'],
            ':moneda'       => $data['moneda'],
            ':presupuesto'  => $data['presupuesto'],
            ':actividad'    => $data['actividad'],
            ':fecha_inicio' => $data['fecha_inicio'],
            ':fecha_cierre' => $data['fecha_cierre'],
            ':id_usuario'   => $data['id_usuario']
        ]);
    }
    
    public function update($id, $objeto, $descripcion, $moneda, $presupuesto, $actividad, $fecha_inicio, $fecha_cierre) {
        $stmt = $this->db->prepare("UPDATE procesos_eventos SET objeto = ?, descripcion = ?, moneda = ?, presupuesto = ?, actividad = ?, fecha_inicio = ?, fecha_cierre = ? WHERE id = ?");
        return $stmt->execute([$objeto, $descripcion, $moneda, $presupuesto, $actividad, $fecha_inicio, $fecha_cierre, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM procesos_eventos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}




