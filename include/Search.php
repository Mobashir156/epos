<?php
class Search {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function searchcustomer($query) {
        $stmt = $this->db->prepare("SELECT id, name, mobile, balance, due FROM customers WHERE mobile LIKE ?");
        $searchQuery = "%" . $query . "%";
        $stmt->bind_param("s", $searchQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $search = [];
        while ($row = $result->fetch_assoc()) {
            $search[] = $row;
        }

        $stmt->close();
        return $search;
    }
}
?>
