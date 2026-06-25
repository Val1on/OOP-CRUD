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
    if (!empty($_POST['student_name']) && !empty($_POST['course']) && !empty($_POST['year_level'])) {
        

        $student->student_name = $_POST['student_name'];
        $student->course       = $_POST['course'];
        $student->year_level   = $_POST['year_level'];
        

        $result = $student->create();
        echo json_encode(["success" => $result]);
    } else {
        echo json_encode(["success" => false, "message" => "All fields required"]);
    }
} 


elseif ($action === 'update') {

    if (!empty($_POST['id']) && !empty($_POST['student_name']) && !empty($_POST['course']) && !empty($_POST['year_level'])) {
        
        $student->id           = $_POST['id'];
        $student->student_name = $_POST['student_name'];
        $student->course       = $_POST['course'];
        $student->year_level   = $_POST['year_level'];
        
        $result = $student->update();
        echo json_encode(["success" => $result]);
    } else {
        echo json_encode(["success" => false, "message" => "Missing update information"]);
    }
} 


elseif ($action === 'delete') {

    if (!empty($_POST['id'])) {
        
        $student->id = $_POST['id'];

        $result = $student->delete();
        echo json_encode(["success" => $result]);
    } else {
        echo json_encode(["success" => false, "message" => "ID required for deletion"]);
    }
}
?>