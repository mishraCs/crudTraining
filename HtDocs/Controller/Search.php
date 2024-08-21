<?php
namespace Controller;

use Controller\CreateConnection;

class Search extends CreateConnection {

    public function LatestCategory() {
        $this->connectionMysqli(); 
        $sql = "SELECT latest_search_category FROM latest_search ORDER BY latest_search_category DESC LIMIT 5";
        try {
            $result = $this->conn->query($sql);
            if ($result === false) {
                throw new \Exception("Query failed: " . $this->conn->error);
            }
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $categories;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        } finally {
            $this->closeConnection();
        }
    }
}
?>
