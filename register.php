<?php include('./header.php'); 
session_start();
if(!isset($_SESSION["name"])) {

?>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="https://cdn.dribbble.com/users/2095589/screenshots/4166422/media/4f5df9f81aa355998185eefc94fc4456.png?compress=1&resize=400x300" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        
        <form method="POST" enctype="multipart/form-data">
            <input type="text" id="name" class="fadeIn third" name="name" placeholder="Name" required>
            
            <input type="text" id="mobile" class="fadeIn third" name="mobile" placeholder="Mobile" required>
            <input type="email" id="email" class="fadeIn third" name="email" placeholder="Email" required>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
            <input type="date" id="dateofbirth" class="fadeIn third" name="dateofbirth" placeholder="Email" required>
            <label for="html" class="fadeIn fourth"><b>Profile Picture:</b><br />
                <div id="preview"></div>
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <!-- <input type="button" id="upload" name="upload"> -->
            </label>
            <input type="text" id="address" class="fadeIn second" name="Address" placeholder="Address" required>
              <label for="html" class="fadeIn fourth"><b>Gender:</b>
                  <input type="radio" id="gender" name="gender" class="radio-inline" value="Male" required>
                  <label for="css">Male</label>
                  <input type="radio" id="gender" name="gender" class="radio-inline" value="Female" required>
                <label for="css">Female</label>
            </label>

            <br />
            <input type="button" id="register" class="fadeIn fourth" value="Register"/>

        </form>
        <div class="alert alert-success alert-dismissible" id="success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="alert alert-danger alert-dismissible" id="error">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <span> <a class="underlineHover" href="./index.php">Already Registered User?</a></span>
        </div>
    </div>
</div>

<?php }else{
header("Location:http://localhost/SystemTask/dashboard.php");
}
 include('./footer.php'); ?>