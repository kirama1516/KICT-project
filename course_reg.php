<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['Register'])) {

        $fullname = $_POST['fullname'];
        $date = $_POST['date'];
        $nationality = $_POST['nationality'];
        $state = $_POST['state'];
        $lga = $_POST['lga'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $occupation = $_POST['occupation'];
        $p_occupation = $_POST['placeofoccupation'];
        $gender = $_POST['gender'];
        $course1 = $_POST['course1'];
        $course2 = $_POST['course2'];
        $course3 = $_POST['course3'];
        $course4 = $_POST['course4'];
        $course5 = $_POST['course5'];
        $course6 = $_POST['course6'];
        $edu_details1 = $_POST['educationaldetails1'];
        $edu_details2 = $_POST['educationaldetails2'];
        $edu_details3 = $_POST['educationaldetails3'];
        $edu_details4 = $_POST['educationaldetails4'];

        if (empty($fullname) || empty($date) || empty($nationality) || empty($state) || empty($lga) || empty($phone) || empty($address) || empty($gender)) {
            header("Location: home.php?error=emptyfields&fullname=" . $fullname );
            exit();
        } else {
            
            $sql = "INSERT INTO `users` (Fullname, DOB, Nationality, State, LGA, Phonenumber, Address, Occupation, Placeofoccupation, Gender, Course1, Course2, Course3, Course4, Course5, Course6, Educationaldetails1, Educationaldetails2, Educationaldetails3, Educationaldetails4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $_SESSION['Fullname'] = $fullname;
                header("Location: home.php?error=sqlerror");
                exit();
            } else {

                mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $fullname, $date, $nationality, $state, $lga, $phone, $address, $occupation, $p_occupation, $gender, $course1, $course2, $course3, $course4, $course5, $course6, $edu_details1, $edu_details2, $edu_details3, $edu_details4);
                mysqli_stmt_execute($stmt);
                header("Location: dashboard.php?register=success");
                exit();
            }
        }
    }
}


?>