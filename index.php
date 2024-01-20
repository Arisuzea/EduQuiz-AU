<?php 
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <?php 
      include("php/config.php");
      if(isset($_POST['submit'])){
        $loginIdentifier = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE Email='$loginIdentifier' OR Username='$loginIdentifier'") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row) && password_verify($password, $row['Password'])){
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['id'] = $row['Id'];
            header("Location: home.php");
            exit();
        } else {
            echo "<div class='message'>
              <p>Wrong Username or Password</p>
               </div> <br>";
            echo "<a href='index.php'><button class='btn'>Go Back</button>";
        }
      }
    ?>
    <h2>Login</h2>
    <form action="" method="post">
      <div>
        <label for="email">Email / Username</label>
        <input type="text" name="email" id="email" autocomplete="off" placeholder="Enter Email or Username" required>
      </div>
      <div class="field input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter your Password" required>
      </div>

      <button type="submit" name="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="registration.php">Register</a></p>
  </div>
</body>
</html>
