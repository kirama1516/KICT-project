<?php
include './db/config.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the search query
    $search = $conn->real_escape_string($_POST['search']);

    // $sql = "INSERT INTO `students` (name, score,) VALUES ('Abdullahi farook', 23),('Ahmad farooq', 22),('Ibrahim faruk', 19),('Walida farouk' 27),('fatima farouq' 30),('Bashir faruq' 33);"
    // $result = mysqli_query($conn,$sql);
    
    //SQL query to search for student by name
    $sql = "SELECT id, name, score FROM students WHERE name LIKE '%$search%'";
    $result = $conn->query($sql);
    
    //Check if any result were found
    if ($result->num_rows > 0) {
        echo "<h2> search results:</h2>";
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Score</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["score"] . "</td</tr>";
        }
        echo "</table>";
    } else {
        echo "No result found";
    }
    
    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search student</title>
</head>

<body>
    <h2>search student</h2>
    <form action="" method="post">
        <label for="search">Enter student name:</label>
        <input type="search" name="search" id="search">
        <button type="submit">search</button>
    </form>
</body>

</html>