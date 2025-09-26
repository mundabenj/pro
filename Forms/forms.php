<?php
class forms {
    public function signup($conf, $ObjFncs) {
      $err = $ObjFncs->getMsg('errors'); print $ObjFncs->getMsg('msg');
    ?>
<h1>Sign Up</h1>
<form action="" method="post" autocomplete="off">
  <div class="mb-3">
    <label for="fullname" class="form-label">Fullname</label>
    <input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="nameHelp" maxlength="50" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>" placeholder="Enter your fullname" required>
    <?php print (isset($err['nameFormat_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['nameFormat_error'].'</div>' : ''); ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" maxlength="100" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="Enter your email" required>
    <?php print (isset($err['mailFormat_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['mailFormat_error'].'</div>' : ''); ?>
    <?php print (isset($err['emailDomain_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['emailDomain_error'].'</div>' : ''); ?>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" placeholder="Enter your password" required>
    <?php print (isset($err['passwordLength_error']) ? '<div id="emailHelp" class="alert alert-danger">'.$err['passwordLength_error'].'</div>' : ''); ?>
    <?php print (isset($err['passwordComplexity_error']) ? '<div id="nameHelp" class="alert alert-danger">'.$err['passwordComplexity_error'].'</div>' : ''); ?>
  </div>
          <?php $this->submit_button("Sign Up", "signup"); ?> <a href="signin.php">Already have an account? Log in</a>
</form>

<?php
    }

    private function submit_button($value, $name) {
        ?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></button>
        <?php
    }

    public function signin() {
        ?>
    <h1>Sign In</h1>
    <form>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"></div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
        <?php $this->submit_button("Sign In", "signin"); ?> <a href="signup.php">Don't have an account? Sign up</a>
    </form>
        <?php
    }
}