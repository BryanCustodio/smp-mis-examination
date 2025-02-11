<?php
// include '../db/dbcon.php';

// if (isset($_POST['id'])) {
//     $id = $_POST['id'];
//     $query = $conn->query("SELECT * FROM questions WHERE id = '$id'");
//     $data = $query->fetch_assoc();
//     echo json_encode($data);
// }
?>
<?php
include '../db/dbcon.php';

if (isset($_POST['question_id'])) {
    $id = $_POST['question_id'];
    $query = $conn->query("SELECT * FROM questions WHERE id = $id");
    
    if ($query->num_rows > 0) {
        echo json_encode($query->fetch_assoc());
    } else {
        echo json_encode(["error" => "Question not found"]);
    }
}
?>
