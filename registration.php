<?php

include_once('header.php');

?>

<?php

include_once 'include/class.user.php';

$user = new user(); 

 $profile_picture = "image/profile.jpg";

 if (isset($_REQUEST['registration'])){

 extract($_REQUEST);

 $registration = $user->registration($full_name,$email_address,$password,$free_fire_id,$free_fire_username,$facebook_id,$phone_number,$profile_picture);

 if ($registration) {


 header('location:login.php?ref=registration');

 } else {

echo <<<_END

<div class="alert alert-danger m-0" role="alert">

Email Or Free Fire ID Already Exits

</div>

_END;


 }
}

?>

<?php

if(isset($_SESSION['email_address'])){
	
	header('location:index.php');
	
}else{

  echo <<<_END

  <div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

   Registration

  </div>

<div class="border">

  <br/>

  <form name="registration" action="registration.php" method="POST">

  <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-user-o"></i></i></div>

        </div>

        <input name="full_name" type="text" class="form-control text" placeholder="Full Name" required>

      </div>

    </div>

  <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-envelope"></i></div>

        </div>

        <input name="email_address" type="email" class="form-control text" placeholder="Email Address" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-key"></i></div>

        </div>

        <input name="password" type="password" class="form-control text" placeholder="Password" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-hashtag"></i></div>

        </div>

        <input name="free_fire_id" type="text" class="form-control text" placeholder="Free Fire ID" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-empire"></i></div>

        </div>

        <input name="free_fire_username" type="text" class="form-control text" placeholder="Free Fire Username" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-facebook-official"></i></div>

        </div>

        <input name="facebook_id" type="text" class="form-control text" placeholder="Facebook" value="https://www.facebook.com/">

      </div>

    </div>

     <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-phone"></i></div>

        </div>

        <input name="phone_number" type="text" class="form-control text" placeholder="Phone Number" value="+880" required>

      </div>

    </div>

<br/>

  <center>

    <button name="registration" type="submit" class="btn button">Registration</button>

  </center>

</form>

<br/>

</div>

</div>

_END;

}
?>


<?php

include_once('footer.php');

?>
