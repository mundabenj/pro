<?php
class forms{

    private function submit_button($text){
        print "<button type='submit' class='btn btn-primary'>$text</button>";
    }

    public function signup(){
        ?>
        <h2>Sign Up Form</h2>
<form>
  <div class="mb-3">
    <label for="exampleInputName1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputName1">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
    <?php $this->submit_button('Sign Up'); ?> <a>Already a member? <a href='signin.php'>Sign In here</a></a>
</form>
        <?php
    }

    public function signin(){
        ?>
        <h2>Sign In Form</h2>
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
    <?php $this->submit_button('Sign In'); ?> Don't have an account? <a href='signup.php'>Sign Up here</a>
</form>
        <?php
    }
}