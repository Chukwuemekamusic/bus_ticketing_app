<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<?php

// creating the seat array
$seat_array = array();
for ($i = 1; $i <= 40; $i++){
    array_push($seat_array, $i);
    echo '<button>',$i.'</button>'. '<br>';
}

// file_get_contents, file_put_contents
$image_path = 'Businterior.png';

?>
    <img src="<?php echo $image_path; ?>" alt="description of the image">
</body>
</html>