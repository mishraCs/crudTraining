<?php
namespace Controller;

use Controller\CreateConnection;

class Category extends CreateConnection {

    public function selectCategory() {
        try {
            $this->connectionMysqli(); 
            $sql = "SELECT * FROM category";
            $result = $this->conn->query($sql);
            if ($result === false) {
                throw new \Exception("Query failed: " . $this->conn->error);
            }
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            return $categories;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    }
    

    public function selectCategoryByName($categoryName) {
        try {
            $this->connectionMysqli(); 
            $sql = "SELECT * FROM category WHERE category_name = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $categoryName); 
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result === false) {
                throw new \Exception("Query failed: " . $this->conn->error);
            }
    
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $categories;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    } 
       
    public function deleteCategory() {
        $categoryId = (int)$_POST['category_select'];
        try {
            $this->connectionMysqli();
            $sql = "DELETE FROM category WHERE category_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $categoryId);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header('Location: home.php?successfullydelete');
                exit();
            } else {
                return "Category not found or could not be deleted.";
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    }

    public function subCategoryInCategory($category_id) {
        try {
            $this->connectionMysqli();
            $category_id = (int)$category_id;
            $sql = "SELECT * FROM sub_category WHERE category_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $subCategories = $result->fetch_all(MYSQLI_ASSOC);
                return $subCategories;
            } else {
                return "Error executing the query: " . $this->conn->error;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        } finally {
            $this->closeConnection();
        }
    }

    public function subCategoryView() {
        $subCategoryId = (int)$_GET['subCategoryId']; 
        try {
            $this->connectionMysqli();
            $sql = "SELECT * FROM sub_category WHERE sub_category_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $subCategoryId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $subCategory = $result->fetch_assoc();
                return $subCategory;
            } else {
                return "Error executing the query: " . $this->conn->error;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        } finally {
            $this->closeConnection();
        }
    }
    
    public function uploadCategory() {
        $categoryName = htmlspecialchars($_POST['category_name']);
        $categoryImage = $_FILES['category_image'];
        $categoryDescription = htmlspecialchars($_POST['category_description']);
        if (!empty($categoryImage['name'])) {
            $categoryDirectory = "category/";
            $categoryPathName = $categoryDirectory . basename($categoryImage['name']);
            $fileExtension = strtolower(pathinfo($categoryPathName, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png'])) {
                return "Invalid file type. Only JPEG, JPG, AVIF, and PNG are allowed.";
            }
            if (!move_uploaded_file($categoryImage['tmp_name'], $categoryPathName)) {
                return "Failed to upload image.";
            }
            try {
                $this->connectionMysqli();  
                $sql = "INSERT INTO category (category_name, category_image, category_description) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($this->conn, $sql);
                if (!$stmt) {
                    throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
                }
                mysqli_stmt_bind_param($stmt, "sss", $categoryName, $categoryPathName, $categoryDescription);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    $this->closeConnection(); 
                    return "Category added successfully.";
                } else {
                    throw new \Exception("Execution failed: " . mysqli_stmt_error($stmt));
                }
            } catch (\Exception $e) {
                if (isset($stmt)) {
                    mysqli_stmt_close($stmt);
                }
                $this->closeConnection(); 
                return "Error: " . $e->getMessage();
            }
        } else {
            return "Please upload an image.";
        }
    }

    public function deleteUserProfile($profileId) {
        try {
            $profileId = (int)$profileId; 
            $this->connectionMysqli();
            $stmt = "SELECT * FROM user_profile WHERE profile_id = ?";
            $stmt = $this->conn->prepare($stmt);
            $stmt->bind_param("i", $profileId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row && unlink($row['profile_image'])) {
                $stmt = "DELETE FROM user_profile WHERE profile_id = ?";
                $stmt = $this->conn->prepare($stmt);
                $stmt->bind_param("i", $profileId);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    return "Profile deleted successfully.";
                } else {
                    return "I can't delete data.";
                }
            } else {
                return "I can't delete the profile image.";
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    }
}
?>
