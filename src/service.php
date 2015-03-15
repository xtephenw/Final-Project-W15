<?php 
// Database connection values
if(isset($_POST['username'], $_POST['password'])) {
  extract($_POST);
  $actiontoDo = $_POST['action'];
  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "wrighste-db", "ydEX8evfxykcq1xZ", "wrighste-db");
  if ($mysqli->connect_errno) {
		echo ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	} else {
	}
    if($actiontoDo == 'register' 
      && isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
    // Verify that the username is unique
		$stmt = $mysqli->stmt_init();
		$query1 = "select count(id) from cs340_user_auth WHERE username=?";
		if (!($stmt = $mysqli->prepare($query1)))
		{
			print "Failed to prepare statement\n";
		} else
		{
			$stmt->bind_param("s",$username);
			$stmt->execute();	//fails here?			
			$result = $stmt->get_result();
		   if ($result > 0 ) {
				//die("<error id='0' />"); fixit
			}
		}

    // Validate email
    if( !preg_match("^[a-z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+(\.[a-z0-9,!#\$%&
      '\*\+/=\?\^_`\{\|}~-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,})$^", 
      $_POST['email']) ) {
			die("<error id='1' />");
		}
		$stmt = $mysqli->stmt_init();
		$query2 = "INSERT into cs340_user_auth (username, password, firstname, lastname, email) VALUES (?,?,?,?,?)";
		if (!($stmt = $mysqli->prepare($query2)))
		{
			print "Failed to prepare statement\n";
		}  else
		{
			$stmt->bind_param("sssss",$username, $password, $firstname, $lastname, $email);
			$stmt->execute();
		}	
    die("<success />");
  }
  else if($actiontoDo == 'login') {
    $stmt = $mysqli->stmt_init();
	$query3 = "select count(id) from cs340_user_auth where 
       username=? and password=?";
		if (!($stmt = $mysqli->prepare($query3)))
		{
			print "Failed to prepare statement\n";
		}  else
		{
			$stmt->bind_param("ss",$username, $password);
			$stmt->execute();
		}	
		$result = $stmt->get_result();
		if($result == 1) {
			session_start();
			$_SESSION['username'] = $username;
			if (!isset($_SESSION['count'])) {
				$_SESSION['count'] = 0;
			} else {
				$_SESSION['count'] = 0;
			}
			$stmt2 = $mysqli->stmt_init();
			$stmt3 = $mysqli->stmt_init();
			$query4 = "select notetext FROM TaxPrepNotes where firmID = ?";		
			$query5 = "select id from cs340_user_auth where username=? and password=?";			
			
			if (!($stmt2 = $mysqli->prepare($query4)))
			{
				echo("Failed to prepare statement\n");
			} else
			{
				//echo("Got Here2\n");
				if (!($stmt3 = $mysqli->prepare($query5)))
				{
					echo("Failed to prepare statement\n");
				} else
				{
					$stmt3->bind_param("ss",$username, $password);
					$stmt3->execute();
					$res = $stmt3->get_result();
					$row = $res->fetch_assoc();
					$notesid = $row['id'];
				}
				$myvar = $notesid;			
//				echo($myvar);
				$stmt2->bind_param("i",$myvar);
				$stmt2->execute();
				$res = $stmt2->get_result();
				$row = $res->fetch_assoc();
			}	
			
				$testtext = $row['notetext'];
//				echo($testtext);
				if (isset($testtext)) {
					$thistext = $row['notetext'];
				} else
				{
					$thistext = "Enter note and click save";	
				}
			
//			printf("notetext = %s (%s)\n", $thistext, gettype($thistext));
			echo($thistext);
//			echo("Got Here3\n");
		while ($stmt->fetch()) {

			}			
	//		echo("<success />");
		}
		else die("<error id='2' />");
  }
}

?>