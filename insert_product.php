<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
    <title>Kict Computer Entry Results</title>
</head>
<body>

    <h1>Kict Computer Entry Results</h1>

    <?php

    // create short variable names
    if (isset($_POST['submit'])) {
        $modelNum = $_POST['modelNum'];
        $title = $_POST['title'];
        $item = $_POST['item'];
        $cpu = $_POST['cpu'];
        $gen = $_POST['gen'];
        $ram = $_POST['ram'];
        $ssd = $_POST['ssd'];
        $touch = $_POST['touch'];
        $graphics = $_POST['graphics'];
        $image = 'upload/' . $_FILES['image']['name'];
        $price=$_POST['price'];
    

        if (!$modelNum || !$title) {
            echo "You have not entered all the required details.<br />"
            ."Please go back and try again.";
            exit;
        }

        if (!get_magic_quotes_gpc()) {
            $modelNum = addslashes($modelNum);
            $title = addslashes($title);
            $item = addslashes($item);
            $cpu = addslashes($cpu);
            $gen = addslashes($gen);
            $ram = addslashes($ram);
            $ssd = addslashes($ssd);
            $touch = addslashes($touch);
            $graphics = addslashes($graphics);
            $image  = addslashes($image );
            $price = doubleval($price);
        }

        @ $db = new mysqli('localhost', 'admin', '6680Afa.', 'Myshop');  

        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database. Please try again later.";
            exit;
        }   

        $query = "insert into product values
        ('".$$modelNum."', '".$title."', '".$item."', '".$cpu."', '".$gen."', '".$ram."', '".$ssd."', '".$touch."', '".$graphics."', '".$image."', '".$price."')";
        $result = $db->query($query);
        if ($result) {
        echo $db->affected_rows." product inserted into database.";
        } else {
        echo "An error has occurred. The item was not added.";
        }
        $db->close();

    //     $query = "insert into product values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //     $stmt = $db->prepare($query);
    //     $stmt->bind_param("ssssssssssd", $modelNum, $title, $item, $cpu, $gen, $ram, $ssd, $touch, $graphics, $image, $price);
    //     $stmt->execute();
    //     echo $stmt->affected_rows.'  inserted into database.';
    //     $stmt->close();

    //     $db->close();
    }

    ?>
    
</body>
</html>