<?php

include_once('header.php');

?>

<?php

if(isset($_SESSION['email_address'])){

	include_once('include/class.user.php');

	$email_address = $_SESSION['email_address'];

	$profile = new user();

	$table = "user_profile";

	$profile = $profile->profile($table,$email_address);

	$amount = $profile['amount'];

	$full_name = $profile['full_name'];

	$profile_picture = $profile['profile_picture'];

	$free_fire_username = $profile['free_fire_username'];

	$free_fire_id = $profile['free_fire_id'];

	$facebook_id = $profile['facebook_id'];

	$phone_number = $profile['phone_number'];

echo <<<_END

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

 Profile Of $full_name

  </div>

<div class="border">

<ul class="list-group list-group-flush">

<li class="list-group-item">

<center>

<img class="rounded-circle" src="$profile_picture" width="100px">

<br/>

<a class="link" href="edit.php?change=photo">Change Photo</a>

<br/>

<a class="link" href="edit.php?change=photo">Edit Profile</a>

<br/>

Balance : $amount &#2547;

<br/>

<a class="btn btn-success" href="recharge.php"><i class="fa fa-paper-plane"></i> Recharge</a>

<a class="btn btn-info" href="withdraw.php"><i class="fa fa-tasks"></i> Withdraw</a>

</center>

</li>

</ul>

</div>

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

 Free Fire Info

  </div>

  <div class="border">

<ul class="list-group list-group-flush">

<li class="list-group-item">

<i class="fa fa-gg" aria-hidden="true"></i> <b>Name : </b>$free_fire_username

</li>

<li class="list-group-item">

<i class="fa fa-gg" aria-hidden="true"></i> <b>ID : </b>$free_fire_id

</li>

</ul>

</div>

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

 Contact

  </div>

  <div class="border">

<ul class="list-group list-group-flush">

<li class="list-group-item">

<center>

<a class="btn btn-primary" href="$facebook_id"><i class="fa fa-facebook"></i> Facebook</a>

<a class="btn btn-dark" href="tel:$phone_number"><i class="fa fa-phone"></i> Call Now</a>

</center>

</li>

</ul>

</div>



_END;


}else{

header('location:index.php');

}

?>

<?php

include_once('footer.php');

?>