<?php include 'inc/header.php' ?>
<?php include 'lib/User.php';
	Session::checkLogin();

?>

	<?php  
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
		{
			$usrRegi = $user->userLogin($_POST);

		}

	?>
			<div class="panel panel-default">

				<div class="panel-heading">
					<h2>User Login</h2>
					
				</div>
				<div class="panel-body">
					<div style="max-width:600px; margin:0 auto">
					<form action="" method="post">
						
						
						
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="text" id="email" name="email" class="form-control" required="1"/>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" id="password" name="password" class="form-control" required="1"/>
							
						</div>

						<button type="submit" name="login" class="btn btn-success">Login</button>

					</form>
				</div>
				</div>
			</div>
			<?php include 'inc/footer.php' ?>