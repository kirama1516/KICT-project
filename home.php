<?php
include "./db/config.php";

if (isset($_SESSION['userId'])) {

    $sql =  "SELECT * FROM `sign_database` WHERE Id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $image = $row['Image'];
            // echo "<script> alert('Success! You are logged in '); </script>";
        }
    }
} else {
    header('location:index.php?error=InvalidData');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">

    <title>Home page</title>
</head>

<body>
    <header>
        <h1>
            <b>KICT</b><sub><i>experience IT</i></sub>
        </h1>

        <div class=" chip">
            <?php echo '<img src="' . $image . '" width="96" height="96">'; ?>
        </div>

    </header>

    <!-- <li><a class="active" href="#home">Home</a></li> -->
    <!-- <li><a href="create.php">Form registration</a></li> -->
    <!-- <li><a href="#contact">Contact us</a></li> -->
    <!-- <li><a href="#about">About us</a></li> -->

    <div class="side-nav">
        <ul>
            <li><a href="#" class="user-link" data-user="dashbord">Dashbord</a></li>
            <li><a href="#" class="user-link" data-user="product">Buy products</a></li>
            <li><a href="#" class="user-link" data-user="form">Course registration</a></li>
            <li><a href="#" class="user-link" data-user="contact">Contact us</a></li>
            <li><a href="#" class="user-link" data-user="about">About us</a></li>
        </ul>
    </div>


    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <!-- <div id="home" class="tabcontent"> -->
    <div class="content-area">
        <div id="dashbord" class="user-content show">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="assets/images/avatars/Computer Repairs North Lakes - Expert & Fast Service - Computer Super Heroes.jpeg" style="width:100%; height:500px; ">
                    <div class="text">Hardware</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="assets/images/avatars/Thought — Why Is Computer Science a Good Topic to Study_.jpeg" style="width:100%; height:500px; ">
                    <div class="text">Software</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="assets/images/avatars/IT and Consultancy.jpeg" style="width:100%; height:500px; ">
                    <div class="text">Networking</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">4 / 4</div>
                    <img src="assets/images/avatars/Home.jpeg" style="width:100%; height:500px; ">
                    <div class="text">Printer</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
            </div>
        </div>
        <div id="product" class="user-content hide">
            <div>
                <h1>Kict Catalog Search</h1>
                <form action="results.php" method="post">
                    Choose Search Type:<br />
                    <select name="searchtype">
                        <option value="modelNum">model number</option>
                        <option value="title">title</option>
                        <option value="item">item name</option>
                        <option value="cpu">processer</option>
                        <option value="gen">generation</option>
                        <option value="ram">ram</option>
                        <option value="ssd">hard drive</option>
                        <option value="graphics">graphics</option>
                    </select>
                    <br />
                    Enter Search Term:<br />
                    <input name="searchterm" type=”"text" placeholder="Search" size="40" />
                    <!-- <input type="submit" name="submit" value="Search" /> -->

                </form>
            </div>

        </div>
        <!-- <div id="form" class="tabcontent"> -->
        <div id="form" class="user-content hide">
            <form action="course_reg.php" method="post">
                <i>
                    <address>
                        No. 23 Albarka Plaza,Justice Dahiru Mustapha Avenue Farm Center Kano.<br>
                        Phone No.:08034099090,08095743914,08038933443. Email:knowitict@gmail.com.
                        Google:kict.online.
                    </address>
                </i>
                <hr>
                <h3>
                    APPLICATION FORM
                </h3>
                </hr>
                <h4>
                    <mark>
                        PERSONAL DETAILS <span>👤</span>
                    </mark>
                </h4>
                <div class="section">
                    <div>
                        <p>
                            <label for="name">FULL NAME:</label><br>
                            <input type="text" name="fullname" id="fullname" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="date">DATE OF BIRTH:</label><br>
                            <input type="date" name="date" id="date" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="nationality">NATIONALITY:</label><br>
                            <input type="text" name="nationality" id="nationality" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="state">STATE:</label><br>
                            <input type="text" name="state" id="state" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="lga">LGA:</label><br>
                            <input type="text" name="lga" id="lga" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="phone">PHONE NO.:</label><br>
                            <input type="tel" name="phone" id="phone" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="address">ADDRESS:</label><br>
                            <textarea id="address" name="address"></textarea>
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="occupation">OCCUPATION:</label><br>
                            <input type="text" name="occupation" id="occupation" size="35">
                        </p>
                    </div>
                    <div>
                        <p>
                            <label for="place of occupation">PLACE OF OCCUPATION</label><br>
                            <input type="text" name="placeofoccupation" id="place of occupation" size="35">
                        </p>
                    </div>
                    <div class="gender">
                        <p>
                            GENDER:<br>
                            <label for="male">MALE</label>
                            <input type="radio" name="gender" id="male" value="male">
                            <label for="female">FEMALE</label>
                            <input type="radio" name="gender" id="female" value="female">
                        </p>
                    </div>
                </div>
                <br>
                <div>
                    <!-- <h3>Computer Beginner, Must Pay N5,000 Before Any of This Courses.</h3> -->
                    <table class="tables">
                        <tr>
                            <th>COURSES</th>
                            <th>DURATION</th>
                            <th>PRICE</th>
                            <th>OPTION</th>
                        </tr>
                        <tr>
                            <td>
                                <li>Computer Software</li>
                            </td>
                            <td>2months</td>
                            <td>₦20,000</td>
                            <td>
                                <input type="checkbox" name="course1" id="Computer software"
                                    value="Computer software">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li>Computer Hardware</li>
                            </td>
                            <td>2months</td>
                            <td>₦40,000</td>
                            <td>
                                <input type="checkbox" name="course2" id="Computer hardware"
                                    value="Computer hardware">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li>Networking</li>
                            </td>
                            <td>1month</td>
                            <td>₦15,000</td>
                            <td>
                                <input type="checkbox" name="course3" id="Networking" value="Networking">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li>Graphics Design</li>
                            </td>
                            <td>1month</td>
                            <td>N30,000</td>
                            <td>
                                <input type="checkbox" name="course4" id="Graphics Design" value="Graphics Design">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li>Printer Repair</li>
                            </td>
                            <td>1month</td>
                            <td>₦30,000</td>
                            <td>
                                <input type="checkbox" name="course5" id="Printer Repair" value="Printer Repair">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <li>CCTV Installation</li>
                            </td>
                            <td>1month</td>
                            <td>₦20,000</td>
                            <td>
                                <input type="checkbox" name="course6" id="CCTV Installation"
                                    value="CCTV Installation">
                            </td>
                        </tr>
                    </table>
                </div>
                <br><br>
                <div>
                    <mark>EDUCATIONAL DETAILS 📚</mark></label>
                    <br><br><br>
                    1.<input type="text" name="educationaldetails1" size="80"><br>
                    2.<input type="text" name="educationaldetails2" size="80"><br>
                    3.<input type="text" name="educationaldetails3" size="80"><br>
                    4.<input type="text" name="educationaldetails4" size="80"><br>
                </div>
                <div>
                    <input type="reset" class="rcorners1" value="RESET" />
                </div>
                <div>
                    <input type="submit" name="Register" class="rcorners2" value="Sign Up" />
                </div>
                <div>
                    <footer>Copyright © W3Schools.com</footer>
                </div>
            </form>
        </div>
        <!-- <div id="contact" class="tabcontent"> -->
        <div id="contact" class="user-content hide">
            <div>
                <h1>
                    <b>KICT</b><sup>experience IT</sup>
                </h1>
                <h2>KNOW IT ICT LTD. </h2>
                <address>
                    ADD: No. 23 Albarka Plaza,Justice Dahiru Mustapha Avenue Farm Center Kano.<br>
                    Phone No.:08034099090,08095743914,08038933443. Email:knowitict@gmail.com.
                    Google:kict.online.
                </address>
            </div>

        </div>
        <!-- <div id="about" class="tabcontent"> -->
        <div id="about" class="user-content hide">
            <!-- <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p> -->
        </div>
    </div>
    <script src="assets/js/home.js"></script>
</body>

</html>