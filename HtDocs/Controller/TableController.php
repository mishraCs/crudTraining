<?php

namespace Controller;

class table {
    public function createParentTable($conn, $parentTableName) {
        $parentTableName = preg_replace('/[^a-zA-Z0-9_]+/', '', $parentTableName);
        $sql = "CREATE TABLE IF NOT EXISTS $parentTableName (
            user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            user_name VARCHAR(35) NOT NULL,
            email VARCHAR(50) NOT NULL,
            profile_picture VARCHAR(255) NOT NULL,
            user_password VARCHAR(35) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createChildTable($conn, $tableName, $referenceTable) {
        $tableName = preg_replace('/[^a-zA-Z0-9_]+/', '', $tableName);
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            profile_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            profile_picture VARCHAR(255) NOT NULL,
            user_id INT NOT NULL,
            FOREIGN KEY(user_id) REFERENCES $referenceTable(user_id) ON DELETE CASCADE
        )";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }


}
?>
