<?php
session_start();

$uname = 'admin';
$pass = 'admin';

// Proses data yang dikirimkan dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($uname == $username && $pass == $password) {
      $_SESSION['log'] = true;
      header("Location: beranda.php");
    } else {
      echo "Password Salah";
    }
}

if (isset($_SESSION['log']) === true) {
  header('Location: beranda.php');
} else {
?>

<!DOCTYPE html>
<html>

<head>
  <title>Inventaris Lembaga</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <style>
    html,body,h1,h2,h3,h4,h5 
    {
      font-family: "Raleway", sans-serif
    }
    .w3-input, .w3-button {
      width: 200%;
      margin: 0 auto 0 -65px;
    }
  </style>
</head>

<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
    <div class="w3-display-middle w3-center w3-gray w3-padding-16">
        <h1>Login</h1>
        <form action="#" method="POST">
          <p><input class="w3-input w3-border" type="text" placeholder="Username" name="username" required autofocus></p>
          <p><input class="w3-input w3-border" type="password" placeholder="Password" name="password" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Sign In</button>
        </form>
    </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>


</body>

</html>
<?php } ?>