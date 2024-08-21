<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <i class="bx bxs-user"></i>
            <a class="logo_name proNam" href="../index.php">Multithink</a>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav_list">
        <li>
            <i class="bx bx-search"></i>
            <input name="sideCategorySearch" placeholder="Search..." value="" onkeyup="showCategory(this.value)" />
            <span class="tooltip">Search</span>
        </li>
        <div id="livesearch"></div>
        <li class="nav-item dropdown">
            <div style="display:flex">
                <i class="bx bx-grid-alt" style="color: green;"></i>
                <button class="dropdown-toggle links_name" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent; border: none; color: green;">
                    Category
                </button>
                <ul class="dropdown-menu">
                    <?php
                    $categories = $CategoryObj->selectCategory();
                    if (is_array($categories) && count($categories) > 0) {
                        foreach ($categories as $category) { ?>
                            <li class="dropdown-submenu">
                                <div style="display:flex; align-items:center;">
                                    <img class="header_user_image" src="<?php echo htmlspecialchars($category['category_image']); ?>" alt="Category Image">
                                    <a class="test" tabindex="-1" href="#"><?php echo htmlspecialchars($category['category_name']); ?></a>
                                    <ul class="dropdown-menu cat-ul">
                                        <?php
                                        $category_id = $category['category_id'];
                                        $subCategoriesInCategory = $SubCategoryObj->selectSubCategoryByName($category_id);
                                        if (is_array($subCategoriesInCategory) && count($subCategoriesInCategory) > 0) {
                                            foreach ($subCategoriesInCategory as $subCategory) { ?>
                                                <li>
                                                    <div class="second_dropdown" style="display:flex; align-items:center;">
                                                        <img class="header_user_image" src="<?php echo htmlspecialchars($subCategory['sub_category_image']); ?>" alt="Subcategory Image">
                                                        <a tabindex="-1" href="sub_category_view.php?subCategoryId=<?php echo htmlspecialchars($subCategory['sub_category_id']); ?>&category=<?php echo htmlspecialchars($category['category_name']); ?>">
                                                            <?php echo htmlspecialchars($subCategory['sub_category_name']); ?>
                                                        </a>
                                                    </div>
                                                </li>
                                            <?php }
                                        } else {
                                            echo "<li>No subcategories available</li>";
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                        <?php }
                    } else {
                        echo "<li>No categories available</li>";
                    }
                    ?>
                </ul>
            </div>
        </li>

        <li>
            <a href="index.php">
                <i class="bx bx-user"></i>
                <span class="links_name">User</span>
            </a>
            <span class="tooltip">User</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-cog"></i>
                <span class="links_name">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
    </ul>
</div>
