<?php
include 'helper/db.php';

if(isset($_GET['q'])){
    $searchValue = $_GET['q'];
    $sql = "SELECT * FROM category WHERE category_name LIKE '%$searchValue%'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($category = $result->fetch_assoc()){
            $categoryImage = $category["category_image"];
            $categoryName = $category['category_name'];
            $category_id = $category['category_id'];
            try {
              $Checksql = "SELECT * FROM latest_search WHERE latest_search_category = '$categoryName'";
                $findResult = $conn->query($Checksql);
                if($findResult->num_rows > 0){
                    while($rowfindResult = $findResult->fetch_assoc()){
                        $bigNo = $rowfindResult['big_no'];
                        // echo $bigNo; exit();
                        $bigNo++;
                        $sql = "UPDATE latest_search SET big_no = $bigNo WHERE latest_search_category = '$categoryName' ";
                        $conn->query($sql);    
                    }
                }
            }catch (\Throwable $th) {
                echo $th->getmessage();
           }
            echo "<li>
                    <div style='display:flex'>
                        <i class='bx bx-grid-alt' style='color: green;'></i>
                        <span class='links_name user_div dropdown'>
                            <button type='button' data-toggle='dropdown' style='background-color: transparent; border: none; color: green;'>$categoryName
                                <span class='caret'></span>
                            </button>
                            <ul class='dropdown-menu'>";
            $sub_sql = "SELECT * FROM sub_category WHERE category_id = $category_id";
            $sub_result = $conn->query($sub_sql);
            if($sub_result->num_rows > 0){
                while($subCategory = $sub_result->fetch_assoc()){
                    $subCategoryImage = $subCategory['sub_category_image'];
                    $subCategoryId = $subCategory['sub_category_id'];
                    $subCategoryName = $subCategory['sub_category_name'];
                    echo "<li>
                            <div class='second_dropdown'>
                                <img class='header_user_image' src='$subCategoryImage'>
                                <a tabindex='-1' href='sub_category_view.php?subCategoryId=$subCategoryId&category=$subCategoryName'>$subCategoryName</a>
                            </div>
                          </li>";
                }
            } else {
                echo "<li><a class='dropdown-item' href='#'>No subcategories</a></li>";
            }

            echo "        </ul>
                        </span>
                    </div>
                  </li>";
        }
    } else {
        echo "<li><a class='dropdown-item' href='#'>No results found</a></li><br>";
    }
} else {
    echo "Again try!!";
}
?>
