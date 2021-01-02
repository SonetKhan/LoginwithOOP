<?php include 'inc/header.php' ?>
<?php include 'lib/User.php'?>

	<?php  
		$user = new User();

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration']))
		{
			$usrRegi = $user->userRegistration($_POST);

		}

	?>
	<?php 

	if(isset($usrRegi))
	{
		echo $usrRegi;

	}


	?>
			<div class="panel panel-default">

				<div class="panel-heading">
					<h2>User Registration</h2>
					
				</div>
				<div class="panel-body">
					<div style="max-width:600px; margin:0 auto">

					<form action="" method="post">

						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="username">User Name</label>
							<input type="text" id="username" name="username" class="form-control" />
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="text" id="email" name="email" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" id="password" name="password" class="form-control"/>
							
						</div>

						<button type="submit" name="registration" class="btn btn-success">Registration</button>

					</form>
				</div>
				</div>
			</div>
			<?php include 'inc/footer.php' ?>