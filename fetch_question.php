<?php 
include 'admin/dbcon.php';
$sql = "SELECT * FROM questions ORDER BY RAND() ";
$result = mysqli_query($conn,$sql);

$questions = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }
}

echo json_encode($questions);


?>