<?php

include_once('header.php');

?>

<?php

if(isset($_GET['ref']) AND $_GET['ref']="registation"){

echo <<<_END

<div class="alert alert-success m-0" role="alert">

Registrtion Successfully. You Can Login Now.

</div>

_END;
}

?>

<?php

include_once 'include/class.user.php';


    $user = new user();


if (isset($_REQUEST['login'])){

  extract($_REQUEST);

  $login = $user->login($email_address, $password);

  if($login){

    header('location:index.php');

  }else{

echo <<<_END

<div class="alert alert-danger" role="alert">

Wrong Email Adress Or Password

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

   Login

  </div>

<div class="border">

  <br/>

  <form>

  <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-envelope"></i></i></div>

        </div>

        <input name="email_address" type="email" class="form-control text" placeholder="Email  Address">

      </div>

    </div>

    <div class="col-auto">

      <div class="input-group mb-2">

        <div class="input-group-prepend">

          <div class="input-group-text text"><i class="fa fa-key"></i></div>

        </div>

        <input name="password" type="password" class="form-control text" placeholder="Password">

      </div>

    </div>

    <br/>

  <center>

    <button name="login" type="submit" class="btn button">Login</button>

  </center>
  
</form>

<br/>

</div>

_END;

}

?>

<?php

include_once('footer.php');

?>