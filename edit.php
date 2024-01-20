<?php 
   session_start();

   include("php/config.php");
   include("header.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $password_error = '';
                if (!empty($password)) {
                    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
                        $password_error = "Password must be at least 8 characters long and include one uppercase letter, one lowercase letter, one digit, and one special character.";
                    }

                    if ($password != $confirm_password) {
                        $password_error = "Password and confirmation do not match.";
                    }
                }

                if (!empty($password_error)) {
                    echo "<div class='message_f'>
                        <p>$password_error</p>
                    </div> <br>";
                } else {
                    $id = $_SESSION['id'];


                    $password_update = '';
                    if (!empty($password)) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $password_update = ", Password='$hashed_password'";
                    }

                    $edit_query = mysqli_query($conn,"UPDATE users SET Username='$username', Email='$email' $password_update WHERE Id=$id ") or die("error occurred");

                    if($edit_query){
                        echo "<div class='message_g'>
                        <p>Profile Updated!</p>
                    </div> <br>";
                    }
                }
               } else {
                    $id = $_SESSION['id'];
                    $query = mysqli_query($conn,"SELECT*FROM users WHERE Id=$id ");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_Uname = $result['Username'];
                        $res_Email = $result['Email'];
                    }
                }
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="Leave blank to keep current password">
                </div>

                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" placeholder="Confirm New Password">
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
      </div>
</body>
</html>
