<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
      <h2>Customer Feedback</h2>
    <div>
    <?php
      include("connection.php");
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
      }

      $sql = "SELECT * FROM feedback";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Delete</th></tr>";
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["subject"]. "</td><td>" . $row["message"]. "</td><td><a href='deletefeedback.php?id=" . $row["id"]. "'>Delete</a></td></tr>";
        }
        echo "</table>";
      } else {
        echo "<h6>No feedback found</h6>.";
      }

      $conn->close();
      ?>
    </div>
  
    </main>
    <footer>
        <p>&copy; 2023 Bus Inc. All rights reserved.</p>
    </footer>
</body>

</html>