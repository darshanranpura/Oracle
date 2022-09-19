

<!--
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require 'core.inc.php';
    require 'connect.inc.php';

    if(count($_POST) > 0){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = md5($password);
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $validated = true;

        if(!preg_match("/^[a-zA-Z ]*$/",$username)){
            $usernameErr = " Only letters and white space allowed";
            $validated = false;
        } else if(empty($username)){
            $usernameErr = ' Enter your username';
            $validated = false;
        }

        if(strlen($username)>30){
            $error = 'Please ahear to maxlength of fields.';
        }

        if(empty($password)){
            $passErr = ' Enter your password';
            $validated = false;
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " Invalid email";
            $validated = false;
        } else if(empty($email)){
            $emailErr = ' Enter your email';
            $validated = false;
        }

        if(empty($gender)){
            $genderErr = ' Select your gender';
            $validated = false;
        }

        if(empty($age)){
            $ageErr = ' Select your age';
            $validated = false;
        }

        if($validated === true){
            $query = "SELECT `username` FROM `users` WHERE `username`='$username'";
                $query_run = mysql_query($query);

                if(mysql_num_rows($query_run)==1){
                    $error = 'The username already exists.';
                } else {
                    $query = "INSERT INTO `users` VALUES ('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password_hash)."','".mysql_real_escape_string($email)."')";
                    if ($query_run = mysql_query($query)){
                        header('Location: register_success.php');
                    } else {
                        $error = 'Sorry, we couldn\'t register you at this time. Try again later.';
                    }
                }   
        }
    }
?>
-->
<!doctype html>
<html>
<head>
<style>
form{
    margin: 0px auto;
    width: 470px;
    margin-top:150px;
}
label{
     width: 75px;
    display: inline-block;
}
.error{
    color: red;
}
</style>
</head>
<body>
    <span class="error"><?php echo $error?></span>
    <br><br>
    <form action="register.php" method="POST" autocomplete="off">
        <h2>Register</h2>
        <label for="username">Username</label>
            <input type="text" id="username" name="username" maxlength="50" value="<?php if(isset($username)){echo $username;}?>">
            <span class="error"><?php echo $usernameErr?></span>
            <br><br>
        <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <span class="error"><?php echo $passErr?></span>
            <br><br>
        <label for="email">Email</label>
            <input type="email" id="email" name="email" maxlength="30" value="<?php if(isset($email)){echo $email;}?>">
            <span class="error"><?php echo $emailErr?></span>
            <br><br>
        <label>Gender</label>
            <input type="radio" name="gender" id="male" value="male">Male
            <input type="radio" name="gender" id="female" value="female">Female
            <span class="error"><?php echo $genderErr?></span>
            <br><br>
        <label>Age</label>
            <select name="age" class="age">
                <option value> </option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
            </select>
            <span class="error"><?php echo $ageErr?></span>
            <br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>