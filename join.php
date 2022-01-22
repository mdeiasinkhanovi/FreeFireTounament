<?php

include_once('header.php');

?>

<?php

if(isset($_SESSION['email_address'])){

include_once 'include/class.user.php';

  $profile = new user();

  $table = "user_profile";

  $email_address = $_SESSION['email_address'];

  $profile = $profile->profile($table,$email_address);

  $amount = $profile['amount'];

  $tournament_info = $profile['tournament_info'];

 if(isset($_POST['join'])){

  if(20<=$amount){

  include_once('include/configx.php');

    $recent_amount = $amount - 20;

$sql = "UPDATE user_profile SET amount='$recent_amount',tournament_info=1 WHERE email_address='$email_address'";

mysqli_query($connect, $sql);

echo <<<_END

<div class="alert alert-success m-0" role="alert">

You Have Joined The Tounament Successfully.

</div>

_END;

}else{
	echo <<<_END

<div class="alert alert-danger m-0" role="alert">

You Don't Have Enough Money.Please Recharge First.

</div>

_END;
}

}


}else{

	header('location:index.php');

}

?>

<div class="list">

Join Tourament

</div>

<div class="border">

<div class="card">
  <h5 class="card-header">Solo Vs Solo</h5>
  <div class="card-body">
    <h5 class="card-title">Entry Fee 20 Taka</h5>
    <p class="card-text">1. Get 400 Taka By Taking Boyaah.<br/>  2. Get 5 Taka Per Each Kills.</p>
    <form action="join.php" method="POST">
    <center>

    	<input name="join" class="btn btn-info m-0" type="submit" value="Join Now">

    </center>
    </form>
  </div>
</div>

</div>

<?php

include_once('footer.php');

?>