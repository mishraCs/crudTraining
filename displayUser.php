<?php 
include 'helper/header.php';
include 'users.php';
$user = new DisplayMembersConnectionModifiers();
$result = $user->displayLoginUser();
if ($result) {?>
<table>
    <tr>
        <th colspan="3">Login User</th>
    </tr>
    <tr>
        <th>First Name</th>
            <th>Last Name</th>
    </tr>
    <tr>
        <td><?php echo $result['first_name'] ?></td>
        <td><?php echo $result['last_name'] ?></td>
    </tr><br>
</table><?php
} else {
    echo "No users found in the database.";
}
// $tableUsers = "users"; below function have optional argument
$result = $user->displayAllUser(); // by derived DisplayMembersConnectionModifiers class
if ($result) {?>
<table>
    <tr>
        <th colspan="3">All User</th>
    </tr>
    <tr>
        <th>First Name</th>
            <th>Last Name</th>
    </tr><?php
    foreach ($result as $row) {?>
    <tr>
        <td><?php echo $row['first_name'] ?></td>
        <td><?php echo $row['last_name'] ?></td>
    </tr>
<?php }?>
</table><?php
} else {
    echo "No users found in the database.";
}



