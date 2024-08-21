<?php
namespace Controller;

use Controller\CreateConnection;

class SubCategory extends CreateConnection {

    public function selectSubCategoryByName($categoryId) {
        try {
            $this->connectionMysqli(); 
            $sql = "SELECT * FROM sub_category WHERE category_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $categoryId);
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

    public function categoryLike($searchKeyword) {
        try {
            $this->connectionMysqli(); 
            $sql = "SELECT * FROM category WHERE category_name LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $likeKeyword = '%' . $searchKeyword . '%';
            $stmt->bind_param("s", $likeKeyword); 
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
        } 
    }

    public function checkAndUpdateLatestSearch($categoryName) {
        try {
            $this->connectionMysqli();
            $Checksql = "SELECT * FROM latest_search WHERE latest_search_category = ?";
            $stmt = $this->conn->prepare($Checksql);
            $stmt->bind_param("s", $categoryName);
            $stmt->execute();
            $findResult = $stmt->get_result();

            if($findResult->num_rows > 0){
                while($rowfindResult = $findResult->fetch_assoc()){
                    $bigNo = $rowfindResult['big_no'];
                    $bigNo++;
                    $updateSql = "UPDATE latest_search SET big_no = ? WHERE latest_search_category = ?";
                    $updateStmt = $stmt = $this->conn->prepare($updateSql);
                    $updateStmt->bind_param("is", $bigNo, $categoryName);
                    $updateStmt->execute();
                }
            }
            $stmt->close();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function subCategoryView($subCategoryId) {
        try {
            $this->connectionMysqli();
            $subCategoryId = (int)$subCategoryId;
            $sql = "SELECT * FROM sub_category WHERE sub_category_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $subCategoryId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $subCategory = $result->fetch_assoc();
                return $subCategory;
            } else {
                return "Subcategory not found.";
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        } finally {
            $this->closeConnection();
        }
    }

    public function subCategoryInsert() {
        try {
            $this->connectionMysqli();
            $subCategoryName = htmlspecialchars($_POST['sub_category_name']);
            $subCategoryImage = $_FILES['sub_category_image'];
            $subCategoryPrice = $_POST['sub_category_price'];
            $subCategoryQuantity = $_POST['sub_category_quantity'];
            $subCategoryDescription = htmlspecialchars($_POST['sub_category_description']);
            $categorySelect = $_POST['category_select']; 
            
            if (!empty($subCategoryImage['name'])) {
                $subCategoryDirectory = "category/";
                $subCategoryPathName = $subCategoryDirectory . basename($subCategoryImage['name']);
                $fileExtension = strtolower(pathinfo($subCategoryPathName, PATHINFO_EXTENSION));
    
                if (in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png', 'webp'])) {
                    if (move_uploaded_file($subCategoryImage['tmp_name'], $subCategoryPathName)) {
                        $sql = "INSERT INTO sub_category 
                                (sub_category_name, sub_category_image, category_id, sub_category_description, sub_category_price, sub_category_quantity) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bind_param("ssiids", $subCategoryName, $subCategoryPathName, $categorySelect, $subCategoryDescription, $subCategoryPrice, $subCategoryQuantity);
                        if ($stmt->execute()) {
                            return "Sub-category added successfully.";
                        } else {
                            return "Failed to add sub-category: " . $stmt->error;
                        }
                    } else {
                        return "Failed to upload image.";
                    }
                } else {
                    return "Invalid file type. Only JPEG, JPG, AVIF, PNG, and WEBP are allowed.";
                }
            } else {
                return "Please upload an image.";
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    }
    
}
?>
