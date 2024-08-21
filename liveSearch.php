<?php
require_once 'HtDocs/Controller/DbConnectionController.php';
require_once 'HtDocs/Controller/CategoryController.php';
require_once 'HtDocs/Controller/SubCategoryController.php';

use Controller\Category\Category;
use Controller\SubCategory\SubCategory;

$CategoryObj = new Category();
$SubCategoryObj = new SubCategory();

if (isset($_GET['q'])) {
    $searchValue = $_GET['q'];
    $categories = $SubCategoryObj->categoryLike($searchValue);

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $categoryName = htmlspecialchars($category['category_name']);
            $category_id = htmlspecialchars($category['category_id']);
            $SubCategoryObj->checkAndUpdateLatestSearch($categoryName);

            echo "<li>
                    <div style='display:flex'>
                        <i class='bx bx-grid-alt' style='color: green;'></i>
                        <span class='links_name user_div dropdown'>
                            <button class='live-btn' type='button' data-toggle='dropdown' style='background-color: transparent; border: none; color: green;'>$categoryName
                                <span class='caret'></span>
                            </button>
                            <ul class='dropdown-menu'>";

            $subcategories = $CategoryObj->subCategoryInCategory($category_id);
            if (!empty($subcategories)) {
                foreach ($subcategories as $subCategory) {
                    $subCategoryImage = htmlspecialchars($subCategory['sub_category_image']);
                    $subCategoryId = htmlspecialchars($subCategory['sub_category_id']);
                    $subCategoryName = htmlspecialchars($subCategory['sub_category_name']);
                    echo "<li>
                            <div class='second_dropdown'>
                                <img class='header_user_image' src='$subCategoryImage' alt='Subcategory Image'>
                                <a tabindex='-1' href='sub_category_view.php?subCategoryId=$subCategoryId&category=$categoryName'>$subCategoryName</a>
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
    echo "Please enter a search term!";
}
?>
