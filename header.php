<div class="nav">
    <div class="logo">
        <p><a href="home.php">EduQuiz!</a></p>
    </div>

    <div class="right-links">
        <?php 
        $id = $_SESSION['id'];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE Id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $creation_date = strtotime($result['CreationDate']);
            $current_date = time();
            $age_in_seconds = $current_date - $creation_date;
            $age_in_days = floor($age_in_seconds / (60 * 60 * 24));
            $res_Age = $age_in_days;
            $res_id = $result['Id'];
        }
        
        echo "<a href='edit.php'><button class='btn'>Edit Profile</button></a>
              <a href='logout.php'><button class='btn'>Log Out</button></a>";
        ?>
    </div>
</div>
