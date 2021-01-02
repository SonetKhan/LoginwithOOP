<?php include 'inc/header.php' ?>
<?php include 'lib/User.php' ?>

<?php 
//Session::checkLogin();


?>
<?php 
	if(isset($_GET['id']))
	{
		$userid = (int)$_GET['id'];

	}
	$user = new User();

?>
		<?php

		

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']))
		{
			$usrupdate = $user->userupdation($_POST,$userid);

		}
		if(isset($usrupdate))
		{
			echo $usrupdate;

		}


		?>
			<div class="panel panel-default">

				<div class="panel-heading">
					<h2>User Profile<span class="pull-right"><a href="index.php">Back</a></span></h2>
					
				</div>
				<div class="panel-body">
					<div style="max-width:600px; margin:0 auto">
						<?php
						$userdata = $user->getdataById($userid); 

						if($userdata)
						{

						

						?>

					<form action="" method="post">
						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" class="form-control" value="<?php echo $userdata->name;?>"/>
						</div>
						<div class="form-group">
							<label for="username">User Name</label>
							<input type="text" id="username" name="username" class="form-control" value="<?php echo $userdata->username;?>"/>
						</div>
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="text" id="email" name="email" class="form-control" value="<?php echo $userdata->email;?>"/>
						</div>
						<?php
						$sesId = Session::get('id');

						if($sesId == $userid)
						{

						

						?>
						

						<button type="submit" name="update" class="btn btn-success">Update</button>
							<?php } ?>
					</form>
				<?php } ?>
				</div>
				</div>
			</div>
			<?php include 'inc/footer.php' ?>