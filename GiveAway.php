<?php session_start();
$sub = false;

if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    $noLogin = "";
    $loginState = "success";


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            $_POST['pet-type'] != "N/A" && ($_POST['breed']) != "N/A" && ($_POST['age']) != "N/A" && isset($_POST['gender']) &&
            (isset($_POST["gets-along-dogs"]) || isset($_POST["gets-along-cats"]) || isset($_POST["suitable-for-kids"]) ||  isset($_POST["none"])) &&
            ($_POST['comments']) != "" && ($_POST['owner-name'])  != "" && ($_POST['owner-email'] != "")
        ) {
            $file = fopen("HaveAPetToGiveAway.txt", "a") or die("The file cannot be opened!");
            $Path = "HaveAPetToGiveAway.txt";
            $line = count(file($Path)) + 1;
            $type = $_POST['pet-type'];
            $breed = $_POST['breed'];
            $age = $_POST['age'];
            $gender = ($_POST['gender']);
            $gets_along_dogs = isset($_POST["gets-along-dogs"]) ? "gets along with dogs" : "does not get along with dogs";
            $gets_along_cats = isset($_POST["gets-along-cats"]) ? "gets along with cats" : "does not get along with cats";
            $suitable_for_kids = isset($_POST["suitable-for-kids"]) ? "gets along with kids" : "does not get along with children";
            $none = isset($_POST["none"]) ? "yes" : "no";
            $text = $_POST['comments'];
            $ownerName = $_POST['owner-name'];
            $ownerEmail = $_POST['owner-email'];
            $sub = true;

            fwrite($file, $line . ":" . $_SESSION["username"] . ":" . $type . ":" . $breed . ":" . $age . ":" . $gender . ":" . $gets_along_dogs . ":" .  $gets_along_cats . ":" . $suitable_for_kids . ":" .  $none . ":" . $text . ":" . $ownerName . ":" . $ownerEmail . "\n");
            fclose($file);
        }
    }
} else {

    $noLogin = $loginState = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valid = false;
        if (isset($_POST["loginSubmit"])) {
            $loginName = $_POST["username"];
            $loginPassword = $_POST["password"];
            if (file_exists("logIn.txt")) {
                $path = fopen("logIn.txt", "r");
                $arrName = [];
                $arrPassword = [];
                while (!feof($path)) {
                    $line = fgets($path);
                    if (!empty($line)) {
                        $userpass = explode(":", $line);
                        array_push($arrName, $userpass[0]);
                        array_push($arrPassword, $userpass[1]);
                    }
                }
                fclose($path);

                for ($i = 0; $i < sizeof($arrName); $i++) {
                    if ($loginPassword == trim($arrPassword[$i]) && $loginName == trim($arrName[$i])) {
                        $valid = true;
                        break;
                    }
                }
            }
            if ($valid) {
                $_SESSION["username"] = $loginName;
                $_SESSION["password"] = $loginPassword;
                $loginState = "success";
            } else
                $noLogin = "User does not exist!";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopte Me Give Away </title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
</head>

<body>

    <?php
    include 'Header.html';


    ?>

    <div id="giveAwayDiv">
        <form id="GiveAwaylogin" method="post" action="">
            <label for="username">
                <h3>Enter your username:</h3>
            </label>
            <input type="text" id="username" name="username" required>
            <label for="password">
                <h3>Enter your Password</h3>
            </label>
            <input type="password" id="password" name="password" required> <br>
            <input type="submit" class="GiveAwayButton" name="loginSubmit" value="Login &#128062;">
            <?php
            if (!empty($noLogin)) {
                echo "<h4 style='color:red'>" . $noLogin . "</h4>";
            }
            ?>
        </form>
    </div>








    <div class="content">
        <aside>
            <nav>
                <ul>
                    <li><a class="maincolor" href="Home.php">&#127968; Home</a></li>
                    <li><a class="maincolor" href="Find.php">&#8981; Find a Dog/Cat </a></li>
                    <li><a class="maincolor" href="DogCare.php">&#128054; Dog Care </a></li>
                    <li><a class="maincolor" href="CatCare.php">&#128049; Cat Care </a></li>
                    <li><a class="maincolor" href="CreateAnAccount.php">&#128100; Create An Account </a></li>
                    <li><a class="maincolor active" href="GiveAway.php"> <img id="give-love" src="give-love.png" alt="give-love"> Have a Pet to Give Away </a></li>
                    <li><a class="maincolor" href="ContactUs.php">&#128222; Contact Us </a></li>
                    <li><a class="maincolor" href="logOut.php"> &#8598; LogOut </a></li>

                </ul>
            </nav>
        </aside>
        <div class="beforeLogin">


            <main style='display:block;'>

                <form class="pet-search-form" action="" method="post" onsubmit="validateForm2(event)">
                    <?php
                    if (isset($_SESSION["username"]))


                        echo "<div style = ' text-align:center;'><h2 style='margin-bottom:4%;'>Hello <span style='color: purple'>" . $_SESSION["username"] . '!</span> Welcome to Adopte me<br></h2></div>';

                    echo "<h3 style = 'text-align: center;'>Do you have a pet you are willing to give away? If so, kindly complete this form.</h3><br>";
                    ?>

                    <label for="pet-type" class="GiveAwaylabel">Cat or Dog:</label><br>
                    <select id="pet-type" name="pet-type" class="GiveAwaySelect">
                        <option value="N/A" selected>N/A</option>
                        <option value="cat">Cat</option>
                        <option value="dog">Dog</option>
                    </select>

                    <label class="GiveAwaylabel" for="breed">Breed:</label><br>
                    <select class="GiveAwaySelect" id="breed" name="breed">
                        <option value="N/A" selected>N/A</option>
                        <option value="British">British Shorthair (Cat)</option>
                        <option value="Persian">Persian Cat (Cat)</option>
                        <option value="Scottish">Scottish Fold (Cat)</option>
                        <option value="Bulldog">Bulldog (Dog)</option>
                        <option value="German">German Shepherd (Dog)</option>
                        <option value="Husky">Husky (Dog)</option>
                        <option value="Poodle">Poodle (Dog)</option>
                        <option value ="Mixed">Mixed</option>


                    </select>


                    <label for="age" class="GiveAwaylabel">Age:</label><br>
                    <select id="age" name="age" class="GiveAwaySelect">
                        <option value="N/A" selected>N/A</option>
                        <option value="young">Young</option>
                        <option value="adult">Adult</option>
                        <option value="senior">Senior</option>
                    </select>

                    <label class="GiveAwaylabel">Gender:</label>
                    <input type="radio" id="gender-male" name="gender" value="male">
                    <label for="gender-male" class="GiveAwaylabel">Male</label>
                    <input type="radio" id="gender-female" name="gender" value="female">
                    <label for="gender-female" class="GiveAwaylabel">Female</label>
                    <br><br>

                    <label for="gets-along-dogs" class="GiveAwaylabel">Gets along with other dogs:</label>
                    <input type="checkbox" id="gets-along-dogs" name="gets-along-dogs">
                    <br>
                    <label for="gets-along-cats" class="GiveAwaylabel">Gets along with other cats:</label>
                    <input type="checkbox" id="gets-along-cats" name="gets-along-cats">
                    <br>
                    <label for="suitable-for-kids" class="GiveAwaylabel">Suitable for a family with small children:</label>
                    <input type="checkbox" id="suitable-for-kids" name="suitable-for-kids">
                    <br>
                    <label for="none" class="GiveAwaylabel">None:</label>
                    <input type="checkbox" id="none" name="none">
                    <br><br>
                    <label for="comments" class="GiveAwaylabel">Comments:</label>
                    <textarea id="comments" class="GiveAwayTextArea" name="comments" rows="4" cols="50" placeholder="Tell us more about your pet"></textarea>

                    <label for="owner-name" class="GiveAwaylabel">Owner's Name:</label>
                    <input type="text" class="GiveAwayText" id="owner-name" name="owner-name" placeholder="Your Name">

                    <label for="owner-email" class="GiveAwaylabel">Owner's Email:</label>
                    <input type="email" id="owner-email" name="owner-email" placeholder="Your Email"><br>

                    <input type="submit" value="Submit &#128062;" class="bottonColor" name="submit">
                    <input type="reset" value="Clear &#128062;" class="reset">
                    <?php
                    if ($sub == true) {
                        echo "<h2 style='color:lightsteelblue;'>" . $_SESSION["username"] . " you have successfully submitted your pet</h2>";
                        $sub = false;
                    }
                    ?>

                </form>



            </main>
        </div>

        <?php
        include 'Footer.html';


        ?>
        <script src="project.js"></script>

        <?php
        if ($loginState == "success") {
            echo "<style>
            #giveAwayDiv{
              display:none;
            }
            .beforeLogin{
              display:block;
             
            }
          </style>
          ";
        }
        ?>
    </div>


</body>

</html>