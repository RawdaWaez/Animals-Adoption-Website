<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $divs = '';
  $out = '';
  $check = false;
  $file_path = "HaveAPetToGiveAway.txt";
  $pet_type = $_POST["pet-type"];
  $pet_breed = $_POST["pet-breed"];
  $pet_age = $_POST["pet-age"];
  $pet_gender = $_POST["pet-gender"];
  $gets_along_dogs = isset($_POST["gets-along-dogs"]) ? "gets along with dogs" : "does not get along with dogs";
  $gets_along_cats = isset($_POST["gets-along-cats"]) ? "gets along with cats" : "does not get along with cats";
  $suitable_for_kids = isset($_POST["suitable-for-kids"]) ? "gets along with kids" : "does not get along with children";
  $none = isset($_POST["none"]) ? "yes" : "no";

  $lines = file($file_path);

  foreach ($lines as $record) {
    $arr_data = explode(":", $record);
    if (
      ($pet_type == $arr_data[2] || $pet_type == "any") && ($pet_breed == $arr_data[3] || $pet_breed == "any") && ($pet_age == $arr_data[4]  || $pet_age == "any") &&
      ($pet_gender == $arr_data[5] || $pet_gender == "any") && ($gets_along_dogs == $arr_data[6] || $gets_along_cats == $arr_data[7] || $suitable_for_kids == $arr_data[8] || $none == $arr_data[9])
    ) {
      $try = "<div class=\"pet-item\">
        <p class=\"pet-description\">$arr_data[10]</p>
        <p class=\"petDetail\"><strong>Type:</strong> $arr_data[2] </p>
        <p class=\"petDetail\"><strong>Age:</strong> $arr_data[4]</p>
        <p class=\"petDetail\"><strong>Gender:</strong> $arr_data[5]</p>
        <p class=\"petDetail\"><strong>Breed:</strong> $arr_data[3]</p>
        <p class=\"petDetail\"><strong>$arr_data[6]</strong></p>
        <p class=\"petDetail\"><strong>$arr_data[7]</strong></p>
        <p class=\"petDetail\"><strong>$arr_data[8]</strong></p>
        <p class=\"petDetail\"><strong>None of them: </strong>$arr_data[9]</p>
        <p class=\"petDetail\"><strong>Owner:</strong> $arr_data[1]</p>
        <p class=\"petDetail\"><strong>email:</strong> <a href=\"mailto:$arr_data[12]\"> $arr_data[12]</a></p>
        <button class=\"interested-btn\">Interested &#128062;</button>
      </div><br><br>";
      $divs .= $try;
      $check = true;
    }
  }
  if ($check == true) {
    echo "<style>
    .FormFind{
      display:none;
    }
    .main_browse{
    display: block;
    width: 35%;
   
    }
  </style>
  ";
    $out = $divs;
  } else {
    $error  = "<h3>Not Found! Try again. </h3>";
  }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopte Me Find Dog/Cat </title>
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
          <li><a class="maincolor active" href="Find.php">&#8981; Find a Dog/Cat </a></li>
          <li><a class="maincolor" href="DogCare.php">&#128054; Dog Care </a></li>
          <li><a class="maincolor" href="CatCare.php">&#128049; Cat Care </a></li>
          <li><a class="maincolor" href="CreateAnAccount.php">&#128100; Create An Account </a></li>
          <li><a class="maincolor" href="GiveAway.php"> <img id="give-love" src="give-love.png" alt="give-love"> Have a Pet to Give Away </a></li>
          <li><a class="maincolor" href="ContactUs.php">&#128222; Contact Us </a></li>
          <li><a class="maincolor" href="logOut.php"> &#8598; LogOut </a></li>
        </ul>
      </nav>
    </aside>

    <main class="FormFind" >
      <h2 id="FindHeader">Find a Dog/Cat</h2>
      <form class="pet-search-form" onsubmit="validateForm(event)" method="post">

        <label for="pet-type" class="FindLabel">Cat or Dog:</label>
        <select id="pet-type" name="pet-type" class="FindSelect">
          <option value="">Choose an option</option>
          <option value="any">Doesn't Matter</option>
          <option value="cat">Cat</option>
          <option value="dog">Dog</option>

        </select>
        <br><br>

        <label for="pet-breed" class="FindLabel">Breed:</label>
        <select id="pet-breed" name="pet-breed" class="FindSelect">
          <option value="">Choose an option</option>
          <option value="any">Doesn't Matter</option>
          <option value="British">British Shorthair (Cat)</option>
          <option value="Persian">Persian Cat (Cat)</option>
          <option value="Scottish">Scottish Fold (Cat)</option>
          <option value="Bulldog">Bulldog (Dog)</option>
          <option value="German">German Shepherd (Dog)</option>
          <option value="Husky">Husky (Dog)</option>
          <option value="Poodle">Poodle (Dog)</option>
          <option value="Mixed">Mixed</option>

        </select>
        <br><br>

        <label for="pet-age" class="FindLabel">Age:</label>
        <select id="pet-age" name="pet-age" class="FindSelect">
          <option value="">Choose an option</option>
          <option value="any">Doesn't Matter</option>
          <option value="young">Young</option>
          <option value="adult">Adult</option>
          <option value="senior">Senior</option>
        </select>
        <br><br>

        <label for="pet-gender" class="FindLabel">Gender:</label>
        <select id="pet-gender" name="pet-gender" class="FindSelect">
          <option value="">Choose an option</option>
          <option value="any">Doesn't Matter</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <br><br>

        <label class="FindLabel">Friendliness:</label>
        <br>

        <input class="optionInput" type="checkbox" id="dogs" name="gets-along-dogs" value="dogs">
        <label for="dogs" class="option">Other Dogs</label>
        <br>
        <input class="optionInput" type="checkbox" id="cats" name="gets-along-cats" value="cats">
        <label for="cats" class="option">Other Cats</label>
        <br>
        <input class="optionInput" type="checkbox" id="children" name="suitable-for-kids" value="children">
        <label for="children" class="option">Small Children</label>
        <br>
        <input class="optionInput" type="checkbox" id="none" name="none" value="none">
        <label for="none" class="option">None of them</label>
        <br><br>

        <input type="submit" value="Submit &#128062;" class="bottonColor" name="submit">
        <input type="reset" value="Clear &#128062;" class="reset">
        <?php
        if (isset($error)) {
          echo $error;
        }
        ?>

      </form>

    </main>
    <main class="main_browse" style="display:block;">
      <?php
      if (isset($out)) {
        echo $out;
      }
      ?>
    </main>
  </div>
  <?php
  include 'Footer.html';
  ?>
  <script src="project.js"> </script>
</body>

</html>