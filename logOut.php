<?php
session_start();
session_destroy();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopte Me Home</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">


</head>



<body>


    <?php
    include 'Header.html';


    ?>

    <div class="content">
        <aside>
            <nav>
                <ul>
                    <li><a class="maincolor" href="Home.php">&#127968; Home</a></li>
                    <li><a class="maincolor" href="Find.php">&#8981; Find a Dog/Cat </a></li>
                    <li><a class="maincolor" href="DogCare.php">&#128054; Dog Care </a></li>
                    <li><a class="maincolor" href="CatCare.php">&#128049; Cat Care </a></li>
                    <li><a class="maincolor" href="CreateAnAccount.php">&#128100; Create An Account </a></li>
                    <li><a class="maincolor" href="GiveAway.php"> <img id="give-love" src="give-love.png" alt="give-love"> Have a Pet to Give Away </a></li>
                    <li><a class="maincolor" href="ContactUs.php">&#128222; Contact Us </a></li>
                    <li><a class="maincolor active" href="logOut.php"> &#8598; LogOut </a></li>
                </ul>
            </nav>
        </aside>



        <main class="paragraph">


            <h2> Log Out Page</h2>


            <?php
            if (isset($_SESSION["username"])) {
                echo "<p>Thank you <span style='font-weight:bold;'>" . $_SESSION["username"] . "</span> you logged out </p>";
            } else {
                echo  "<p>You are not logged in </p>";
            }
            ?>





        </main>
    </div>
    <?php
    include 'Footer.html';


    ?>
    <script src="project.js"></script>

</body>

</html>