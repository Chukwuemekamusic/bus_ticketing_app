<?php
session_start();
$first_n = $_POST['first_n'];
$last_n = $_POST['last_n'];

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

    public function is_valid_month() {
        if (($this->expiry_month) < 1 || ($this->expiry_month) > 12 ) {
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
        if ($this->is_valid_card_number() && $this->is_valid_expiry_date() && $this->is_valid_cvv() && $this->is_valid_month()) {
            return true;
        }
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new Card_validator();
    if ($validator->is_valid()) {
        // echo "<p>Credit card number is valid and Approved.. Please proceed.</p>";
        $_SESSION['first_n'] = $first_n;
        $_SESSION['last_n'] = $last_n;
        header("Location: bookingconfirmation.php"); //send user to confirmation page
        exit();

    } else {
        echo "<p>Credit card details is invalid.. Please return to <a href='payment.php'>Payment page</a> input correct details</p>";
    }
}
?>
