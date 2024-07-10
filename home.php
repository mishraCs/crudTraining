<?php
$urlValue = $_SERVER['PHP_SELF'];
die($urlValue);
include 'helper/header.php'; 
if(isset($_SESSION['admin_id']) != 1){
    header('location:login.php') ;
    exit();
}
$limit =2; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page-1) * $limit; 
$sql = "SELECT * FROM users LIMIT $startFrom, $limit";
$result = $conn->query($sql);
$sqlTotal = "SELECT COUNT(*) FROM users";
$resultTotal = $conn->query($sqlTotal);
$totalRecords = $resultTotal->fetch_array()[0];
$totalPages = ceil($totalRecords / $limit);?>
 <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categry</button>
  <div class="dropdown-menu pointer">
    <a class="dropdown-item" href="upload_category.php">Add Category</a>
    <a class="dropdown-item" href="delete_category.php">Delete Category</a>
    <a class="dropdown-item" href="upload_sub_category.php">Upload Subcategory</a>
    <!-- <a class="dropdown-item" href="delete_subcategory.php">Delete Subcategory</a> -->

  </div>
</div>
<div class="container">
  <h2>User List</h2>
  <table class="table table-bordered justify-content-center">
      <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Profile Image</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      <?php if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {?>
              <tr>
                  <td><?php echo $row['first_name']; ?></td>
                  <td><?php echo $row['last_name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><img class="UsersImg" src="<?php echo $row['profile_image']; ?>" width="100"></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                      <div class="dropdown-menu pointer">
                      <a class="dropdown-item" href="view.php?user_id=<?php echo $row['user_id']; ?>">View</a>
                        <a class="dropdown-item" href="update.php?user_id=<?php echo $row['user_id']; ?>">Update</a>
                        <a class="dropdown-item" type="btn" data-toggle="modal" data-target="#deletemodal">Delete</a>
                        <a class="dropdown-item" href="upload_multi_file.php?user_id=<?php echo $row['user_id']; ?>">Upload File</a>
                      </div>
                    </div>
                  </td>
              </tr>
              <!-- Modal delete -->
              <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">Please confirm!! are you want delete your profile.</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-primary" onclick="window.location.href='delete.php?user_id=<?php echo $row['user_id']; ?>'" >Yes</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal delete -->
      <?php }
      } else {
          echo "<tr><td colspan='5'>No users found.</td></tr>";
      }?>
      </tbody>
  </table>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1); } ?>">Previous</a>
      </li>
      <?php for($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?php if($page == $i){ echo 'active'; } ?>">
          <a class="page-link" href="home.php?page=<?php echo  $i ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($page < $totalPages){ echo "?page=".($page + 1); } ?>">Next</a>
      </li>
    </ul>
  </nav>  
</div>
<?php include 'helper/footer.php';?>



