<?php

include_once("include/config.php");

// Database Connection

class user {

	public $connectdb;

	public function __construct() {

		$this->connectdb = new mysqli(Host, User_Name, User_Password, Database);

		}

// Login System

	public function login($email_address, $password){

		$password = md5($password);

		$sql = "SELECT email_address FROM user_profile WHERE email_address='$email_address' AND password='$password'";

		$result = mysqli_query($this->connectdb,$sql);

		$user_data = mysqli_fetch_array($result);

		$count_row =$result->num_rows;

		if($count_row ==1){

			$_SESSION['login'] = true;

			$_SESSION['email_address'] = $user_data['email_address'];

			return true;

		}else{

			return false;

		}


	}

// Registration System

public function registration($full_name,$email_address,$password,$free_fire_id,$free_fire_username,$facebook_id,$phone_number,$profile_picture) {

	$full_name = htmlentities($full_name);

	$email_address = htmlentities($email_address);

	$free_fire_id = htmlentities($free_fire_id);

	$free_fire_username = htmlentities($free_fire_username);

	$facebook_id = htmlentities($facebook_id);

	$phone_number = htmlentities($phone_number);

	$profile_picture = htmlentities($profile_picture);

	$amount = "0";

	$tournament_info = "0";

	$password = md5($password);

	$sql1 = "SELECT * FROM user_profile WHERE email_address='$email_address' OR free_fire_id='$free_fire_id'";

	$check =  $this->connectdb->query($sql1);

    $row = $check->num_rows;


	if($row == 0){

		$sql2 = "INSERT INTO user_profile SET full_name='$full_name', email_address='$email_address', password='$password', free_fire_id='$free_fire_id', free_fire_username='$free_fire_username', facebook_id='$facebook_id', phone_number='$phone_number', profile_picture='$profile_picture', amount='$amount', tournament_info='$tournament_info'";

		$result = mysqli_query($this->connectdb,$sql2) or

		die(mysqli_connect_errno()."Data Can't Inserted");

		return $result;

	}else{

		return false;
	}

	}

//Profile System

   public function profile($table,$email_address){

   	$sql3 = "SELECT * FROM $table WHERE email_address='$email_address'";

   	$result1 = $this->connectdb->query($sql3);

     $row = $result1->fetch_array();

     return $row;
   	
   }

//Profile Edit System


//Profile Picture Change System

//Recharge System

   public function recharge($email_address,$amount,$transection_id,$phone_number,$recharge_method,$status) {

	$email_address = htmlentities($email_address);

	$amount = htmlentities($amount);

	$transection_id = htmlentities($transection_id);

	$phone_number = htmlentities($phone_number);

	$recharge_method = htmlentities($recharge_method);

		$sql6 = "INSERT INTO recharge_history SET email_address='$email_address',transection_id='$transection_id', amount='$amount',  phone_number='$phone_number', recharge_method='$recharge_method', status='$status'";

		$result3 = mysqli_query($this->connectdb,$sql6);

		return $result3;

	}

//Recharge Show system

   public function recharge_history($table,$email_address){

   	$sql3 = "SELECT * FROM $table WHERE email_address='$email_address' ORDER BY time DESC";

   	$result1 = $this->connectdb->query($sql3);

      while($row = mysqli_fetch_array($result1)){

      	$recharge_method = $row['recharge_method'];

      	$amount = $row['amount'];

      	$phone_number = $row['phone_number'];

      	$transection_id = $row['transection_id'];

      	$status = $row['status'];


     echo <<<_END

   <tr>
      <th scope="row">$recharge_method</th>
      <td>$amount</td>
      <td>$phone_number</td>
      <td>$transection_id</td>
      <td>$status</td>

      </tr>
 

_END;

 }

}

//Withdraw System

public function withdraw($email_address,$amount,$phone_number,$withdraw_method,$status) {

	$email_address = htmlentities($email_address);

	$amount = htmlentities($amount);

	$phone_number = htmlentities($phone_number);

	$withdraw_method = htmlentities($withdraw_method);

		$sql7 = "INSERT INTO withdraw_history SET email_address='$email_address', amount='$amount',  phone_number='$phone_number', withdraw_method='$withdraw_method', status='$status'";

		$result4 = mysqli_query($this->connectdb,$sql7) or

		die(mysqli_connect_errno()."Data Can't Inserted");

		return $result4;

	}


//Withdraw History System

	public function withdraw_history($table,$email_address){

   	$sql3 = "SELECT * FROM $table WHERE email_address='$email_address' ORDER BY time DESC";

   	$result1 = $this->connectdb->query($sql3);

      while($row = mysqli_fetch_array($result1)){

      	$withdraw_method = $row['withdraw_method'];

      	$amount = $row['amount'];

      	$phone_number = $row['phone_number'];

      	$status = $row['status'];


     echo <<<_END

   <tr>
      <th scope="row">$withdraw_method</th>
      <td>$amount</td>
      <td>$phone_number</td>
      <td>$status</td>

      </tr>
 

_END;

 }

}


//Log Out System

	public function logout() {

	    $_SESSION['email_address'] = FALSE;


		unset($_SESSION);

	    session_destroy();

	    }

}

?>