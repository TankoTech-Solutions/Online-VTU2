<?php 

	//Check update
	if (isset($_GET['update'])) {
		$id = $_GET['update'];
		$sql = mysqli_query($conn, "SELECT * FROM transactions WHERE id ='$id'");

		if(mysqli_num_rows($sql) > 0) {
			$nresult = mysqli_fetch_assoc($sql);
		}
		$username 	= $nresult['username'];
		$price 		= $nresult['amount'];
		$plan 		= $nresult['plans'];
		$sql 		= mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

		if(mysqli_num_rows($sql) > 0) {
		  $user = mysqli_fetch_assoc($sql);
		}
		$bal = $user['bal'];
		$deduct = $bal - $price;
		$chek = mysqli_query($conn, "SELECT * FROM pay");

		$pdata = mysqli_fetch_array($chek);
		$min = $pdata['min'];

		if ($price > $bal) {
		  $msg = tt_alert_box('<span>' . $username . '</span> has insufficient account, This the user Account Balance <span>' . $bal . '</span>', 2);
		} elseif ($min > $deduct) {
		  $msg = tt_alert_box('The minimum amount that must be in user account is<span>₦' . $min . '</span>', 2);
		} elseif (empty($price)) {
		  $msg = tt_alert_box('There is no Price Admin', 2);
		} else {
		  mysqli_query($conn, "UPDATE user SET bal = '$deduct'  WHERE username = '$username'");
		  mysqli_query($conn, "UPDATE transactions SET status =1  WHERE id = '$id'");

		  $msg = tt_alert_box('Successful.', 1);
		}
	}

	//Check change
	if (isset($_GET['change'])) {
		$id = $_GET['change'];
		$sql = mysqli_query($conn, "SELECT * FROM transactions WHERE id ='$id'");
		if(mysqli_num_rows($sql) > 0) {
		  $ade = mysqli_fetch_assoc($sql);
		}
		$username = $ade['username'];
		$price = $ade['amount'];
		$plan = $ade['plans'];
		$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
		if(mysqli_num_rows($sql) > 0) {
		  $usem = mysqli_fetch_assoc($sql);
		}
		$bal = $usem['bal'];
		$add = $bal + $price;
		$msg1 = "";
		if (empty($price)) {
		  $msg = tt_alert_box('There is no Price Admin', 2);
		} else {
		  mysqli_query($conn, "UPDATE user SET bal = '$add'  WHERE username = '$username'");
		  mysqli_query($conn, "UPDATE transactions SET status =0  WHERE id = '$id'");

		  $msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Successful</strong>';
		}
	}

	//Check banned
	if (isset($_GET['ban'])) {
		$id = $_GET['ban'];
			$msg	= "";
			$sql 	= mysqli_query($conn, "SELECT * FROM bankpayment WHERE id ='$id'");

			if(mysqli_num_rows($sql) > 0){
				$ade 	= mysqli_fetch_assoc($sql);
			}
			$username 	= $ade['username'];

			if (empty($username)) {
				$msg=tt_alert_box('The username is empty!', 2);
			}else{
				mysqli_query($conn, "UPDATE bankpayment SET status=2 WHERE id = '$id'");
				$msg= tt_alert_box('Successful Banned.', 1);
			}
	}

	//Check deletion
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		$msg = "";
		$sql = mysqli_query($conn, "SELECT * FROM transactions WHERE id ='$id'");

		if(mysqli_num_rows($sql) > 0) {
			$ade = mysqli_fetch_assoc($sql);
		}

		$username = $ade['username'];

		if (empty($username)) {
			$msg1 = tt_alert_box('The username is empty!', 2);
		} else {
			mysqli_query($conn, "DELETE FROM transactions  WHERE id = '$id'");

			if (mysqli_query($conn, $query)) {
				$msg = tt_alert_box('Successful Deleted.', 1);
			}
		}
	}


?>
