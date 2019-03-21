<?php
	require ("includes/functions.php");
	
	if (is_logged_in())
		header("Location: books.php");
	
	if ( $_SERVER['REQUEST_METHOD'] == "POST" ){
		//pr($_POST);
		// form was submitted
		
		if ( isset($_POST['uname']) && $_POST['uname'] == ""){
			echo "string has nothing<br>";
		}else if ( isset($_POST['psw']) && $_POST['psw'] == ""){
			echo "password has nothing <br>";
		}else {
			// username and password are filled in
			
			//check in database for valid user
						
			//2. prepare our sql
			$results = DB::queryFirstRow("SELECT id, name, type, password 
															FROM users 
															WHERE username = %s 
															LIMIT 1", $_POST['uname']);
			
			// check 1 row returned
			if ( $results == null){ // number of rows returned
				echo "User does not exist";
			}else{
			
				// encrypt pw to match databases
				if ( $results['password'] != md5($_POST['psw']) ){ //check if passwords match
					echo "Passwords do not match";
				}else{
					//WOOHOOO WE ARE LOGGED IN
					// echo "Logged in :) ";
					//4. update our last_login if user found
					
					//prepare the sql query
					DB::update('users', array('last_login'=>'CURTIME()'), 'id=%i', $results['id']);
//					$query_update = $db->prepare("UPDATE users SET last_login = CURTIME() WHERE id = ? LIMIT 1");
					
	
					if ( DB::affectedRows() != 1 ){ // number of rows altered by query
						//echo "Uh Oh didn't update time";
					}
					
					//save session and TODO cookie
					$_SESSION['u_id'] = $results['id'];
					$_SESSION['u_name'] = $results['name'];
					$_SESSION['u_type'] = $results['type'];
					 
					//redirect user on successful login
					header("Location: books.php");
					
				}
			}
			
			
			
			
			
		}
		// alternate empty string validation
		//if ( isset($_POST['uname']) && strlen($_POST['uname'])==0){
		
		
	}
	
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" >
<br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" >
<br>
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
</form>
</body>
</html>	