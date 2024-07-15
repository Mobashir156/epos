<?php
class Sales {
    private $conn;
    private $table_name = "sales";

    public $sales_id;
    public $barcode;
    public $pname;
    public $user_id;
    public $qty;
    public $price;
    public $discount;
    public $shipping;
    public $c_paid;
    public $due;
    public $status;
    public $remark;
    public $total;
    public $salesman;
    public $courier_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getSaleById($sales_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sales_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $sales_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateSale() {
        $query = "UPDATE " . $this->table_name . " 
                  SET barcode = ?, pname = ?, user_id = ?, qty = ?, price = ?, discount = ?, shipping = ?, c_paid = ?, due = ?, status = ?, remark = ?, total = ?, salesman = ?, courier_id = ?
                  WHERE sales_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiiddddidissii", $this->barcode, $this->pname, $this->user_id, $this->qty, $this->price, $this->discount, $this->shipping, $this->c_paid, $this->due, $this->status, $this->remark, $this->total, $this->salesman, $this->courier_id, $this->sales_id);
        return $stmt->execute();
    }
}
?>
