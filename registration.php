<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="container">
    <?php
        include("PHP/config.php");

        $username = $email = $password = $confirm_password = '';
        $username_error = $email_error = $password_error = '';

        if(isset($_POST['submit'])){
           $username = $_POST['username'];
           $email = $_POST['email'];
           $password = $_POST['password'];
           $confirm_password = $_POST['confirm_password'];

           if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[@#]/', $password)) {
               $password_error = "Passwords must contain 8 characters, A-Z, a-z and special characters (@, #, $ etc.)";
           }

           if ($password != $confirm_password) {
               $password_error = "Passwords do not match.";
           }

           if (!empty($password_error)) {
               echo "<div class='message_f'>
                        <p>$password_error</p>
                    </div> <br>";
           } else {
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $current_date = date('Y-m-d H:i:s');
               mysqli_query($conn, "INSERT INTO users(Username, Email, Password, CreationDate) VALUES('$username','$email','$hashed_password', '$current_date')") or die("Error Occurred");

               echo "<div class='message_g'>
                        <p>Registration successfully!</p>
                    </div> <br>";
           }
        }
    ?>

    <h2>Register</h2>
    <form action="" method="post" id="registration-form">
        <div>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="<?php echo $username; ?>" autocomplete="off" required>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="text" name="email" id="email" value="<?php echo $email; ?>" autocomplete="off" required>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" name="password" id="password" autocomplete="off" required>
          <div id="password-info" class="password-info"></div>
        </div>
        <div>
          <label for="confirm_password">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
        </div>
        <div>
          <input type="submit" class="btn" name="submit" value="Register" required>
        </div>
    <p>Already have an account? <a href="index.php">Login</a></p>
  </div>
</body>
</html>
