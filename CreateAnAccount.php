<?php

$name = "logIn.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user = $_POST['username'];
  $pass = $_POST['password'];

  $profile = file($name, FILE_IGNORE_NEW_LINES);
  $Found = false;

  for ($i = 0; $i < count($profile); $i++) {
    $person = explode(':', $profile[$i]);
    if ($user  === $person[0]) {
      $message = "This username already exists. Please try again.";
      $Found = true;
      break;
    }
  }

  if (!$Found) {
    if (preg_match("/^[a-zA-Z0-9]+$/", $user) && preg_match("/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]{4,}$/", $pass)) {
      $page = fopen($name, "a");
      fwrite($page, $user . ":" . $pass . "\n");
      fclose($page);

      $message = "Your account has been successfully set up.";
    } else {
      $message = "The format of the username or password entered is not valid. The username should only contain uppercase and lowercase letters along with digits. Meanwhile, the password must have a minimum length of four characters and can only consist of letters and digits. Additionally, the password should contain at least one letter and one digit.";
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
  <title> Create An Account </title>
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
          <li><a class="maincolor active" href="CreateAnAccount.php">&#128100; Create An Account </a></li>
          <li><a class="maincolor" href="GiveAway.php"> <img id="give-love" src="give-love.png" alt="give-love"> Have a
              Pet to Give Away </a></li>
          <li><a class="maincolor" href="ContactUs.php">&#128222; Contact Us </a></li>
          <li><a class="maincolor" href="logOut.php"> &#8598; LogOut </a></li>
        </ul>
      </nav>
    </aside>
    <!DOCTYPE html>




    <main class="paragraph">
      <h2>Create an account</h2>
      <p> The username may consist of letters (both uppercase and lowercase) and digits exclusively. The password should be no less than four characters in length, and must contain at least one letter and one digit.</p>
      <form action="" method="post" class="formCreate">
        <label for="username" class="Loginlabel">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password" class="Loginlabel">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <br><br>
        <input type="submit" value="Submit &#128062;" class="bottonLogin"><br><br>

        <?php
        if (isset($message) == "Your account has been successfully set up.") {
          echo '<div class="form_message form_message--success">' . $message . '</div>';
        } else if (isset($message) == "The format of the username or password entered is not valid. The username should only contain uppercase and lowercase letters along with digits. Meanwhile, the password must have a minimum length of four characters and can only consist of letters and digits. Additionally, the password should contain at least one letter and one digit.")
          echo '<div class="form_message form_message--error">' . $message . '</div>';
        else if (isset($message) == "Username already exists. Please choose another one.")
          echo '<div class="form_message form_message--error">' . $message . '</div>';
        ?>
        <br>
      </form>

    </main>





  </div>

  <?php
  include 'Footer.html';


  ?>
  <script src="project.js"></script>



</body>

</html>