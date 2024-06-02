<?php

class DatabaseConnection {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function executeStatement($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false;
        }

        if (!empty($params)) {
            $types = "";
            $bindParams = [];
            foreach ($params as $param) {
                $types .= $param['type'];
                $bindParams[] = &$param['value'];
            }
            array_unshift($bindParams, $types);
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
        }

        $success = $stmt->execute();

        // Close statement
        $stmt->close();

        return $success;
    }

    public function fetchcourier() {
        $couriers = array();
        $query = "SELECT id, name FROM couriers";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $couriers[] = $row;
            }
        }
        return $couriers;
    }

    public function fetchcustomers() {
        $customers = array();
        $query = "SELECT id, name FROM customers";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }
        return $customers;
    }

    public function fetchSuppliers() {
        $suppliers = array();
        $query = "SELECT id, name FROM suppliers";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $suppliers[] = $row;
            }
        }
        return $suppliers;
    }

    public function fetchDueAmount($supplier_id) {
        $due_amount = 0;
        $query = "SELECT due FROM suppliers WHERE id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $supplier_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if the result contains any rows
        if ($result->num_rows > 0) {
            // Fetch the due amount
            $row = $result->fetch_assoc();
            $due_amount = $row['due'];
        }
        
        // Close the statement
        $stmt->close();
        
        return $due_amount;
    }

    public function fetchBalance($customer_id) {
        $balance = 0;
        $due = 0;
        $query = "SELECT balance, due FROM customers WHERE id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $customer_id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $balance = $row['balance'];
            $due = $row['due'];
        }
        
        $stmt->close();
        
        return ['balance' => $balance, 'due' => $due];
    }

    //search

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function getCustomerNameById($customerId) {
        $stmt = $this->conn->prepare("SELECT name FROM customers WHERE id = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $stmt->bind_result($customerName);
        $stmt->fetch();
        $stmt->close();

        return $customerName;
    }

    public function close() {
        return $this->conn->close();
    }
}


?>