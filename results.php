<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
    <title>KICT Products</title>
</head>
<style>
    div {
        display: inline-flex;
        /* padding: 20px; */
    }

    h1 {
        align-items: center;
    }

    input {
        width: 35px;
        margin-left: 20px;
        background-color: green;
        padding: 3px;
        cursor: pointer;
        /* margin-top: 10%; */
    }

    .price {
        position: fixed;
        margin-top: 13%;
        margin-left: -15%;
    }
</style>

<body>
    <h1>Kict Search Products</h1>

<?php

    // create short variable names
    $searchtype = $_POST['searchtype'];
    $searchterm = trim($_POST['searchterm']);

    if (!$searchtype || !$searchterm) {
        echo 'You have not entered search details. Please go back and try again.';
        exit;
    }

    // if ($row = mysqli_fetch_assoc($result)) {
    //     $image = $row['image'];
    //     // echo "<script> alert('Success! You are logged in '); </script>";
    // }

    // if (!get_magic_quotes_gpc()) {
    //     $searchtype = addslashes($searchtype);
    //     $searchterm = addslashes($searchterm);
    // }

    @$db = new mysqli('localhost', 'admin', '6680Afa.', 'Myshop');

    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database. Please try again later.';
        exit;
    }

    $query = "select * from product where " . $searchtype . " like '%" . $searchterm . "%'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    echo "<p>Number of item found: " . $num_results . "</p>";

    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        echo "<div><strong>" . ($i + 1) . ". Title: ";
        echo htmlspecialchars(stripslashes($row['title']));
        echo "</strong><br />Model number: ";
        echo stripslashes($row['modelNum']);
        echo "<br />Iem name: ";
        echo stripslashes($row['item_name']);
        echo "<br />Processer: ";
        echo stripslashes($row['cpu']);
        echo "<br />Generation: ";
        echo stripslashes($row['gen']);
        echo "<br />Ram: ";
        echo stripslashes($row['ram']);
        echo "<br />Hard drive: ";
        echo stripslashes($row['ssd']);
        echo "<br />Touch: ";
        echo stripslashes($row['touch']);
        echo "<br />Graphics: ";
        echo stripslashes($row['graphics']);
        echo '<img src="' . $row['image'] . '" width="96" height="96">';
        // echo "<br />Price: ";
        // echo stripslashes($row['price']);
        echo "</div>";

        echo "<div class='price'>";
        echo "Price: ";
        echo "<strong>" .stripslashes($row['price']). "</strong>";
        echo '<input type="submit" name="submit" value="buy"/>';
        echo "</div>";
    }

    $result->free();
    $db->close();

    ?>

</body>

</html>