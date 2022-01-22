<?php

include_once('header.php');

?>

<?php

include_once 'include/class.user.php';

$user = new user(); 

 if (isset($_REQUEST['recharge'])){

 extract($_REQUEST);

 $recharge = $user->recharge($email_address,$amount,$transection_id,$phone_number,$recharge_method,$status);

 if(20<=$_POST['amount']){

 if ($recharge) {

echo <<<_END

<div class="alert alert-success m-0" role="alert">

Recharge Successfull.It Will Add With Your Account Within 24 Hours.

</div>

_END;
 

 } else {

echo <<<_END

<div class="alert alert-danger m-0" role="alert">

Recharge Failed. Your This Transection ID is Used.

</div>

_END;


 }

}else{

echo <<<_END

<div class="alert alert-danger m-0" role="alert">

You Can Recharge Minimum 20 Taka.

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

   Recharge

  </div>

<div class="border">

  <form name="recharge" action="recharge.php" method="POST">

        <input name="email_address" type="email" class="form-control text" placeholder="Email Address" value="$email_address" required hidden>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-hashtag"></i></div>

        </div>

        <input name="amount" type="text" class="form-control text" placeholder="Amount" required>

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-code"></i></div>

        </div>

        <input name="transection_id" type="text" class="form-control text" placeholder="Transection ID" required>

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

     <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-paper-plane"></i></div>

        </div>

         <select name="recharge_method" class="form-control">
        <option selected>Recharge Method</option>
        <option value="Bkash">Bkash</option>
        <option value="Nagad">Nagad</option>
        <option value="Sure Cash">Sure Cash</option>
      </select>

      </div>

    </div>

        <input name="status" type="text" class="form-control text" placeholder="Status" value="Pending" hidden>

<br/>

  <center>

    <button name="recharge" type="submit" class="btn button">Recharge</button>

  </center>

</form>

<br/>

</div>

</div>

_END;

?>

<div class="list">

  <i class="fa fa-align-left" style="color: #303030"></i>

 Recharge History

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
      <th scope="col">Transection ID</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
_END;

if(isset($_SESSION['email_address'])){

  include_once('include/class.user.php');

  $email_address = $_SESSION['email_address'];

  $recharge_history = new user();

  $table = "recharge_history";

  $recharge_history = $recharge_history->recharge_history($table,$email_address);

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

$sql = "SELECT * FROM recharge_history";

$almessages = mysqli_query($connect, $sql);

$total_data = mysqli_num_rows($almessages);

$lastpage = ceil($total_data/$messagesperpage);

$firstPage = 1;

$nextpage = $currentpage + 1;

$previouspage = $currentpage - 1;

$sql1 = "SELECT * FROM recharge_history ORDER BY time DESC  LIMIT $start, $messagesperpage";

$result = mysqli_query($connect, $sql1);


?>

<?php

include_once('footer.php');

?>