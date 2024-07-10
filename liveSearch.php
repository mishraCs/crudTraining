<?php
// include 'helper/header.php';
include 'helper/db.php';
if(isset($_GET['q'])){
    $searchValue = $_GET['q'];
    $sql = "SELECT * FROM category WHERE category_name LIKE '%{$searchValue}%' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
          echo "<li><a class='dropdown-item' href='#'>" . $row['category_name'] . "</a></li><br>";
        }
    }else{
        $value = "not any result";
        echo "<li><a class='dropdown-item' href='#'>" . $value . "</a></li><br>";
    }
}else{
    echo "chalo";
}
?>

