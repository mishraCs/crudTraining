<?php
namespace HtDocs\Controller;
ob_start();
class ProfileUser{

    public function sessionFile($conn, $profile_id, $Image){
        try {
                $userId = $_SESSION['user_id'];
                // echo $Image; exit();
                $sql = "select * from users where profile_image = '$Image'";
                $result = $conn->query($sql);
                if(mysqli_num_rows($result)>0){
                        return "Please add another profile picture before deleted";
                }else{
                    return "please delete";
                }
            }
            catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function chekuser($conn,$email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0){
            return "Choose another email! <br> This email already exist";
        }
    }
    

    

    public function delete_user_file($conn, $user_id){
        $stmt = "Delete from user_profile where user_id = $user_id";
        $result = $conn->query($stmt);
    }

    public function login_user_profile_picture($conn, $profilePath, $profileId, $userId){
        if (!empty($profilePath)){
            try {
                $sql = "UPDATE users SET profile_image ='$profilePath', profile_id ='$profileId' WHERE user_id = '$userId' ";
                $conn->query($sql);
               return  header('Location:dashboard.php');
                return "Profile updated";
            } catch (\Throwable $th) {
                //throw $th;
                return $th->getmessage();
            }
        }
    }

    public function update_profile_picture($conn, $profilePath, $userId){
        $stmt = "SELECT * FROM user_profile WHERE profile_image ='$profilePath'";
        $result = $conn->query($stmt);
        $profileRow = $result->fetch_assoc();
        $profileId = $profileRow['profile_id'];
        if (!empty($profilePath) && !empty($userId)) {
            $stmt = $conn->prepare("UPDATE users SET profile_image = ?, profile_id = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $profilePath, $profileId, $userId);
            if ($stmt->execute()){
                header('Location:view.php');
                return "profile updated";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        $stmt->close();
        }
    }
}

class InsertMultipleImage {
    public function name_fil($conn, $user_id, $userFile) {
        if(isset($_POST['submit'])){
            foreach ($userFile['name'] as $key => $name) {
                if ($userFile['error'][$key] === 0) {
                    $tmpName = $userFile['tmp_name'][$key];
                    $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if ($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png') {
                        $fileName = time() . '_' . basename($name);
                        $uploadDir = 'uploads/' . $fileName;
                        if (move_uploaded_file($tmpName, $uploadDir)) {
                            try {
                                //code...
                                $stmt = $conn->prepare("INSERT INTO user_profile (profile_image, user_id) VALUES (?, ?)");
                                $stmt->bind_param("si", $uploadDir, $user_id);
                                if ($stmt->execute()) {
                                    echo $fileName . " uploaded successfully<br>";
                                } else {
                                    echo "Error uploading file $fileName: " . $stmt->error . "<br>";
                                }
                                $stmt->close();
                            } catch (\Throwable $th) {
                                echo $th->getMessage();
                            }
                        } else {
                            echo "Error moving file $fileName<br>";
                        }
                    } else {
                        echo "Only JPEG and PNG files are allowed. File '$name' has an invalid extension.<br>";
                    }
                } else {
                    echo "Error uploading file $name<br>";
                }
            }
        }
        return "File upload complete";
    }
}




