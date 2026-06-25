<?php
class Student {
    private $db;
    
    public $id;
    public $student_name;
    public $course;
    public $year_level;

    public function __construct($databaseConnection) {
        $this->db = $databaseConnection;
    }


    public function read($search = '') {
        $query = "SELECT * FROM students";
        if (!empty($search)) {
            $search = $this->db->real_escape_string($search);
            $query .= " WHERE student_name LIKE '%$search%' OR course LIKE '%$search%' OR year_level LIKE '%$search%'";
        }
        $query .= " ORDER BY id DESC";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function create() {
        $stmt = $this->db->prepare("INSERT INTO students (student_name, course, year_level) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->student_name, $this->course, $this->year_level);
        return $stmt->execute();
    }

    public function update() {
        $stmt = $this->db->prepare("UPDATE students SET student_name = ?, course = ?, year_level = ? WHERE id = ?");
        $stmt->bind_param("sssi", $this->student_name, $this->course, $this->year_level, $this->id);
        return $stmt->execute();
    }


    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>