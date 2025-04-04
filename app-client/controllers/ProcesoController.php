<?php
require_once APP_PATH . '/models/Proceso.php';

class ProcesoController {
    private $model;
    
    public function __construct() {
        $this->model = new Proceso();
    }
    
    public function index() {
        $filters = [
            'usuario' => $_GET['usuario'] ?? null,
            'objeto'      => $_GET['objeto'] ?? '',
            'descripcion' => $_GET['descripcion'] ?? '',
            'moneda'      => $_GET['moneda'] ?? '',
            'presupuesto' => $_GET['presupuesto'] ?? '',
            'actividad'   => $_GET['actividad'] ?? '',
            'fecha_inicio' => $_GET['fecha_inicio'] ?? '',
            'fecha_cierre' => $_GET['fecha_cierre'] ?? ''
        ];
    
        $procesos = $this->model->getAll($filters);
        require VIEW_PATH . 'procesos/list.php';
    }
    
    public function show($id) {
        $proceso = $this->model->find($id);
        require VIEW_PATH . 'procesos/show.php';
    }
    
    public function create() {
        require VIEW_PATH . 'procesos/create.php';
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'objeto'      => trim($_POST['objeto']),
                'descripcion' => trim($_POST['descripcion']),
                'moneda'      => trim($_POST['moneda']),
                'presupuesto' => floatval($_POST['presupuesto']),
                'actividad'   => trim($_POST['actividad']),
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_cierre' => $_POST['fecha_fin'],
                'id_usuario'  => $_SESSION['user']['id'] 
            ];

            if ($this->model->create($data)) {
                require VIEW_PATH . 'procesos/list.php';
                exit;
            } else {
                die("Error al guardar el proceso.");
            }
        }
        require VIEW_PATH . 'procesos/list.php';
    }
    
    public function edit() {

        $id = $_GET['id'] ?? null;
        if (!$id) {
            require VIEW_PATH . 'errors/404.php';
            return;
        }
        $proceso = $this->model->find($id);
        require VIEW_PATH . 'procesos/edit.php';
    }
    
    public function update() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        $id = $_GET['id'] ?? null;
        if (!$id) {
            require VIEW_PATH . 'errors/404.php';
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $objeto       = trim($_POST['objeto']);
            $descripcion  = trim($_POST['descripcion']);
            $moneda       = trim($_POST['moneda']);
            $presupuesto  = floatval($_POST['presupuesto']);
            $actividad    = trim($_POST['actividad']);
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_cierre = $_POST['fecha_cierre'];
            $this->model->update($id, $objeto, $descripcion, $moneda, $presupuesto, $actividad, $fecha_inicio, $fecha_cierre);
            header('Location: ' . BASE_URL . '/procesos');
            exit;
        }
    
        require VIEW_PATH . 'procesos/edit.php';
    }
    
    public function destroy() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            $this->model->delete($id);
            header('Location: ' . BASE_URL . '/procesos');
            exit;
        } else {
            http_response_code(400);
        }
    }


    public function exportExcel() {
        // Obtener filtros igual que en el index
        $filters = [
            'objeto'      => $_GET['objeto'] ?? '',
            'descripcion' => $_GET['descripcion'] ?? '',
            'moneda'      => $_GET['moneda'] ?? '',
            'presupuesto' => $_GET['presupuesto'] ?? '',
            'actividad'   => $_GET['actividad'] ?? '',
            'fecha_inicio' => $_GET['fecha_inicio'] ?? '',
            'fecha_cierre' => $_GET['fecha_cierre'] ?? ''
        ];
        
        $procesos = $this->model->getAll($filters);
    
        // Cabeceras para forzar descarga
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=procesos.csv');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        // Crear archivo de salida
        $output = fopen('php://output', 'w');
    
        // Escribir encabezados (mismos que la tabla + extras)
        fputcsv($output, [
            'ID', 
            'Objeto', 
            'Descripción', 
            'Moneda', 
            'Presupuesto', 
            'Actividad', 
            'Fecha Inicio', 
            'Fecha Cierre', 
            'Estado'
        ], ';'); // Usamos ; como delimitador para mejor compatibilidad
    
        // Escribir datos
        foreach ($procesos as $proceso) {
            fputcsv($output, [
                $proceso['id'],
                $proceso['objeto'],
                $proceso['descripcion'],
                $proceso['moneda'],
                $proceso['presupuesto'],
                $proceso['actividad'],
                $proceso['fecha_inicio'],
                $proceso['fecha_cierre'],
                $proceso['estado']
            ], ';');
        }
    
        fclose($output);
        exit;
    }
    
}
