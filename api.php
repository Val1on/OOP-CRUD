<?php
header("Content-Type: application/json");
require_once 'database.php';
require_once 'student.php';

$database = new Database();
$student = new Student($database->conn);

$action = $_GET['action'] ?? '';

if ($action === 'read') {
    $search = $_GET['search'] ?? '';
    echo json_encode($student->read($search));
} 

elseif ($action === 'create') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data['student_name']) && !empty($data['course']) && !empty($data['year_level'])) {
        

        $student->student_name = $data['student_name'];
        $student->course = $data['course'];
        $student->year_level = $data['year_level'];
        
        echo json_encode(["success" => $student->create()]);
    } else {
        echo json_encode(["success" => false, "message" => "All fields required"]);
    }
} 

elseif ($action === 'update') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data['id']) && !empty($data['student_name']) && !empty($data['course']) && !empty($data['year_level'])) {
        
        $student->id = $data['id'];
        $student->student_name = $data['student_name'];
        $student->course = $data['course'];
        $student->year_level = $data['year_level'];
        
        echo json_encode(["success" => $student->update()]);
    } else {
        echo json_encode(["success" => false]);
    }
} 

elseif ($action === 'delete') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!empty($data['id'])) {
        
        $student->id = $data['id'];
        echo json_encode(["success" => $student->delete()]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>