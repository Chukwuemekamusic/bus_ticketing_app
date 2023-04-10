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
        include_once('./connection_pdoheader.php');
        $statement = $conn->prepare('SELECT * FROM bus_schedules ORDER BY departure_date'); 
        $statement->execute();
        $buses = $statement->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <h1>Bus Schedule</h1>

    <p><a href="admin_create.php" class="btn btn-success">Add new route</a></p>
<table class="table table-striped">
<thead>
    <tr>
      <th scope="col" data-sortable>#</th>
      <th scope="col" data-sortable>Departure</th>
      <th scope="col" data-sortable>Arrival</th>
      <th scope="col" data-sortable>Departure_date</th>
      <th scope="col" data-sortable>Departure_time</th>
      <th scope="col" data-sortable>Arrival_date</th>
      <th scope="col" data-sortable>Arrival_time</th>
      <th scope="col" data-sortable>Bus_capacity</th>
      <th scope="col" data-sortable>Seats_booked</th>
      <th scope="col" data-sortable>Seats_remaining</th>
      <th scope="col" data-sortable>Bus_number</th>
      <th scope="col" data-sortable><b>Action!</b></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($buses as $i => $bus) : ?>
    <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td><?php echo $bus['departure']?></td>
      <td><?php echo $bus['arrival']?></td>
      <td><?php echo $bus['departure_date']?></td>
      <td><?php echo $bus['departure_time']?></td>
      <td><?php echo $bus['arrival_date']?></td>
      <td><?php echo $bus['arrival_time']?></td>
      <td><?php echo $bus['bus_capacity']?></td>
      <td><?php echo $bus['seats_booked']?></td>
      <td><?php echo $bus['seats_available']?></td>  
      <td><?php echo $bus['bus_number']?></td>
      <td>
        <button type="button" class="btn-sm btn-primary">Edit</button>
        <button type="button" class="btn-sm btn-danger">Delete</button>
      </td>
      
      
    </tr>
    <?php endforeach ?>
    
  </tbody>
</table>
</body>
</html>