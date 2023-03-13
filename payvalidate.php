<?php

class Card_validator {
    private $card_number;
    private $expiry_month;
    private $expiry_year;
    private $cvv;

    public function __construct() {
        $this->card_number = trim($_POST['card_number']);
        $this->expiry_month = trim($_POST['expiry_month']);
        $this->expiry_year = trim($_POST['expiry_year']);
        $this->cvv = trim($_POST['cvv']);
    }

    public function is_valid_card_number() {
        if (strlen($this->card_number) < 13 || strlen($this->card_number) > 19) {
            return false;
        }
        if (!is_numeric($this->card_number)) {
            return false;
        }
        return true;
    }

    public function is_valid_cvv() {
        if (strlen($this->cvv) < 3 || strlen($this->cvv) > 4 || !is_numeric($this->cvv)) {
            return false;
        }
        return true;
    }

    public function is_valid_expiry_date() {
        if (!is_numeric($this->expiry_month) || !is_numeric($this->expiry_year)) {
            return false;
        }
        $current_year = date("Y");
        $current_month = date("m");
        if ((int)$this->expiry_year < $current_year || ((int)$this->expiry_year == $current_year && (int)$this->expiry_month < $current_month)) {
            return false;
        }
        return true;
    }

    public function is_valid() {
        if ($this->is_valid_card_number() && $this->is_valid_expiry_date() && $this->is_valid_cvv()) {
            return true;
        }
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new Card_validator();
    if ($validator->is_valid()) {
        echo "<p>Credit card number is valid and Approved.. Please proceed.</p>";
        // header("Location: bookingconfirmation.html"); //send user to confirmation page

    } else {
        echo "<p>Credit card number is invalid.. Please return to <a href='payment.html'>Payment page</a> input correct details</p>";
    }
}
?>
