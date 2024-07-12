<div class="sidebar">
      <div class="logo_content">
        <div class="logo">
          <i class="bx bxs-user"></i>
          <div class="logo_name" onclick="alert('hello')">
          BluethinkPhp
          </div>
        </div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav_list">
        <li>
          <i class="bx bx-search"></i>
          <input name="sideCategorySearch" placeholder="Search..." value="" onkeyup="showCategory(this.value)"/>
          <span class="tooltip">Search</span></li>
          <div id="livesearch">
          </div>
          <li>
            <div style="display:flex">
              <i class="bx bx-grid-alt" style="color: green;"></i>
              <span class="links_name  user_div dropdown" >
                    <button class="" type="button" data-toggle="dropdown"style="background-color: transparent; border: none; color: green;">Category
                        <span class="caret"></span>
                    </button>
                    <ul  class="dropdown-menu">
                        <?php
                        $sql = "SELECT * FROM category";
                        $result = $conn->query($sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($category = mysqli_fetch_assoc($result)) { ?>
                                <li class="dropdown-submenu">
                                    <div  style="display:flex">
                                        <img class="header_user_image" src="<?php echo $category['category_image'] ?>" alt="">
                                        <a class="test" tabindex="-1" href="#"><?php echo $category['category_name'] ?></a>
                                        <ul class=" dropdown-menu">
                                            <?php
                                            $category_id = $category['category_id'];
                                            $sub_sql = "SELECT * FROM sub_category WHERE category_id = $category_id";
                                            $sub_result = $conn->query($sub_sql);
                                            if(mysqli_num_rows($sub_result) > 0) {
                                                while($subCategory = mysqli_fetch_assoc($sub_result)) { ?>
                                                    <li><div class="second_dropdown" >
                                                      <img class="header_user_image" src="<?php echo $subCategory['sub_category_image'] ?>" alt="">
                                                      <a tabindex="-1" href="sub_category_view.php?subCategoryId=<?php echo $subCategory['sub_category_id']; ?>&category=<?php echo $category['category_name']; ?>"><?php echo $subCategory['sub_category_name'] ?></a></div></li>
                                                <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php }
                        } ?>
                    </ul>
              </span>
            </div>
          </li>

          <li>
          <a href="./dashboard.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
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
            <i class="bx bx-chat"></i>
            <span class="links_name">Messages</span>
          </a>
          <span class="tooltip">Messages</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Analytics</span>
          </a>
          <span class="tooltip">Analytics</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-folder"></i>
            <span class="links_name">Files Manager</span>
          </a>
          <span class="tooltip">Files</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cart-alt"></i>
            <span class="links_name">Order</span>
          </a>
          <span class="tooltip">Order</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Saved</span>
          </a>
          <span class="tooltip">Saved</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
      </ul>
      <div class="profile_content">
        <div class="profile">
          <div class="profile_details">
            <img
              src="https://cactusthemes.com/blog/wp-content/uploads/2018/01/tt_avatar_small.jpg"
              alt=""
            />
            <div class="name_job">
              <div class="name">William Roger</div>
              <div class="job">Software Developer</div>
            </div>
          </div>
          <i class="bx bx-log-out" id="log_out"></i>
        </div>
      </div>
    </div>