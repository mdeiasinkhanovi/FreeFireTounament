<?php

include_once('header.php');

?>

<?php

include_once 'include/class.user.php';

  $profile = new user();

  $table = "user_profile";

  $email_addresss = $_SESSION['email_address'];

  $profile = $profile->profile($table,$email_addresss);

  $amounts = $profile['amount'];

 if(isset($_POST['amount'])){

  if(20<=$_POST['amount']){

  if($amounts>=$_POST['amount']){

 extract($_REQUEST);

  $user = new user();

  $withdraw = $user->withdraw($email_address,$amount,$phone_number,$withdraw_method,$status);

 if ($withdraw) {

  include_once('include/configx.php');

    $recent_amount = $amounts - $_POST['amount'];

$sql = "UPDATE user_profile SET amount='$recent_amount' WHERE email_address='$email_address'";

mysqli_query($connect, $sql);

echo <<<_END

<div class="alert alert-success m-0" role="alert">

$amount Taka Withdraw Successfull.It Will Get Money Within 24 Hours

</div>

_END;
 

 } else {

echo <<<_END

<div class="alert alert-danger" role="alert">

Withdraw Failed.Try Again.

</div>

_END;


 }

}else{
  echo <<<_END

<div class="alert alert-danger m-0" role="alert">

You Don't Have Enough Money.

</div>

_END;
 }

}else{

  echo <<<_END

<div class="alert alert-danger m-0" role="alert">

You Can Withdraw Minimum 20 Taka.

</div>

_END;

}

}

?>

<?php

$email_address = $_SESSION['email_address'];

echo <<<_END

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

   Withdraw

  </div>

<div class="border">

  <form name="withdraw" action="withdraw.php" method="POST">

        <input name="email_address" type="email" class="form-control text" placeholder="Email Address" value="$email_address" required hidden>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-money"></i></div>

        </div>

        <input name="amount" type="text" class="form-control text" placeholder="Amount" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-paper-plane"></i></div>

        </div>

         <select name="withdraw_method" class="form-control">
        <option selected>Withdraw Method</option>
        <option value="Bkash">Bkash</option>
        <option value="Nagad">Nagad</option>
        <option value="Sure Cash">Sure Cash</option>
        <option value="Mobile Recharge">Mobile Recharge</option>
      </select>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-phone"></i></div>

        </div>

        <input name="phone_number" type="text" class="form-control text" placeholder="Phone Number">

      </div>

    </div>

        <input name="status" type="text" class="form-control text" placeholder="Status" value="Pending" hidden>

<br/>

  <center>

    <button name="withdraw" type="submit" class="btn button">Withdraw</button>

  </center>

</form>

<br/>

</div>

</div>

_END;

?>

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

 Withdraw History

  </div>

<div class="border">

 <?php

 echo <<<_END

  <table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Method</th>
      <th scope="col">Amount</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
_END;

if(isset($_SESSION['email_address'])){

  include_once('include/class.user.php');

  $email_address = $_SESSION['email_address'];

  $withdraw_history = new user();

  $table = "withdraw_history";

  $withdraw_history = $withdraw_history->withdraw_history($table,$email_address);

}

echo <<<_END

  </tbody>

</table>

</div>

_END;


include_once('include/configx.php');

$messagesperpage = 10;

if(isset($_GET['page']) && !empty($_GET['page'])){
  
$currentpage = $_GET['page'];

}else{
  
$currentpage = 1;

}

$start = ($currentpage * $messagesperpage) - $messagesperpage;

$sql = "SELECT * FROM withdraw_history";

$almessages = mysqli_query($connect, $sql);

$total_data = mysqli_num_rows($almessages);

$lastpage = ceil($total_data/$messagesperpage);

$firstPage = 1;

$nextpage = $currentpage + 1;

$previouspage = $currentpage - 1;

$sql1 = "SELECT * FROM withdraw_history ORDER BY time DESC  LIMIT $start, $messagesperpage";

$result = mysqli_query($connect, $sql1);


?>

<?php

include_once('footer.php');

?>