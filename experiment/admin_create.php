<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/cmm004_bus_app/Assets/css/stylenew.css">
    <link rel="stylesheet" href="unsemantic-grid-responsive-tablet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap-theme.min.css">
</head>

<body>
    <?php
    // include_once('./connection_pdoheader.php');
    // $statement = $conn->prepare('SELECT * FROM buses ORDER BY departure_date'); 
    // $statement->execute();
    // $buses = $statement->fetchAll(PDO::FETCH_ASSOC);

    ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <h1>Fill new bus schdule</h1>
                <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" value="Upload" name="submit">
    </form> -->

                <form action="./admin_populate.php" method="post">
                    <div class="mb-3">
                        <label for="departure" class="form-label">Departure</label>
                        <input type="text" class="form-control" id="departure" name="departure">
                    </div>
                    <div class="mb-3">
                        <label for="arrival" class="form-label">Arrival</label>
                        <input type="text" class="form-control" id="arrival" name="arrival">
                    </div>
                    <div class="mb-3">
                        <label for="departure_date" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date">
                    </div>
                    <div class="mb-3">
                        <label for="departure_time" class="form-label">Departure Time</label>
                        <input type="time" class="form-control" id="departure_time" name="departure_time">
                    </div>
                    <div class="mb-3">
                        <label for="arrival_date" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" id="arrival_date" name="arrival_date">
                    </div>
                    <div class="mb-3">
                        <label for="arrival_time" class="form-label">Arrival Time</label>
                        <input type="time" class="form-control" id="arrival_time" name="arrival_time">
                    </div>
                    <div class="mb-3">
                        <label for="bus_capacity" class="form-label">Bus Capacity</label>
                        <input type="number" class="form-control" id="bus_capacity" name="bus_capacity">
                    </div>
                    <div class="mb-3">
                        <label for="bus_number" class="form-label">Bus Number</label>
                        <input type="text" class="form-control" id="bus_number" name="bus_number">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <!-- <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> -->




</body>

</html>