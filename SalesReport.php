<?php
class SalesReport {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getSalesReport($customerId) {
        $customerName = $this->db->getCustomerNameById($customerId);
        if (!$customerName) {
            return ['error' => 'Customer not found'];
        }
        
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM sales WHERE user_id = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $salesData = [
            'pending' => [],
            'completed' => [],
        ];
        
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == 1) {
                $salesData['completed'][] = [
                    'invoice_no' => $row['sales_id'],
                    'customer_name' => $customerName,
                    'total' => $row['total'],
                    'paid' => $row['c_paid'],
                    'uniqueid' => $row['id'],
                ];
            } elseif ($row['status'] == 2) {
                $salesData['pending'][] = [
                    'invoice_no' => $row['sales_id'],
                    'customer_name' => $customerName,
                    'total' => $row['total'],
                    'paid' => $row['c_paid'],
                    'uniqueid' => $row['id'],
                ];
            }
        }
        
        $stmt->close();
        
        return $salesData;
    }

    public function generateInvoiceNumber() {
        $stmt = $this->db->prepare("SELECT MAX(sales_id) AS max_invoice_no FROM sales");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row['max_invoice_no']) {
            return $row['max_invoice_no'] + 1;
        } else {
            return 1;
        }
    }
}
?>
