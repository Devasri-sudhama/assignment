<?php include('./header.php');



session_start();
if(isset($_SESSION['name'])) {
  header("Location:https://devasudhama.000webhostapp.com/dashboard.php");
}else{
?>


<div class="wrapper fadeInDown">
  <div id="formContent">
   
    <div class="fadeIn first">
      <img src="https://cdn.dribbble.com/users/2095589/screenshots/4166422/media/4f5df9f81aa355998185eefc94fc4456.png?compress=1&resize=400x300" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST">
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email ID" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
      <input type="submit" id="login" name="login" class="fadeIn fourth" value="Log In">
    </form>
    <div class="alert alert-danger alert-dismissible" id="login-error">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
   
    <div id="formFooter">
      <a class="underlineHover" href="./register.php">New User?</a>
    </div>

  </div>
</div>

<?php } include('./footer.php'); ?>