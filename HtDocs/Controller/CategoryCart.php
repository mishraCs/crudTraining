<?php
namespace Controller;

use Controller\CreateConnection;

class CategoryCart extends CreateConnection{

    public function isSubCategoryInCart($subCategoryId, $userId) {
        try {
            $this->connectionMysqli();
            $subCategoryId = (int)$subCategoryId;
            $userId = (int)$userId;
            
            $sql = "SELECT * FROM cart WHERE sub_category_id = ? AND user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $subCategoryId, $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result->num_rows > 0;
        } catch (\Throwable $th) {
            return false;
        } finally {
            $this->closeConnection();
        }
    }

}
?>