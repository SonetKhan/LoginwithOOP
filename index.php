<?php include 'lib/User.php' ?>


<?php include 'inc/header.php' ?>
<?php  
	Session::checkSession();

?>

		<?php 

		$loginmsg = Session::get("loginmsg");

		if(isset($loginmsg))
		{
			echo $loginmsg;

		}


		?>

			<div class="panel panel-default">

				<div class="panel-heading">
					<h2>User list <span class="pull-right"><strong>Welcome</strong>
						<?php

					$Name = Session::get("name");

					if(isset($Name))
					{
						echo $Name;

					}



					?>
				</span></h2>
					
				</div>
				<div class="panel-body">
					<table class="table table-striped">
					<tr>
						<th width="20px">Serail</th>
						<th width="20px">Name</th>
						<th width="20px">User Name</th>
						<th width="20px">Email Address</th>
						<th width="20px">Action</th>
					</tr>
					<?php 
					 $user = new User();

					 $userdata = $user->getuserdata();

					 if($userdata)

					 {
					 	$i=0;
					 	foreach ($userdata as $data )
					 	 {
					 		
					 	
					 			$i++;
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $data['name'];?></td>
						<td><?php echo $data['username'];?></td>
						<td><?php echo $data['email'];?></td>
						<td>
							<a href="profile.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">View</a> 
						</td>
					</tr>
				<?php }} else{ ?>
					<tr>
						<td><th>NO user data found..</th></td>
						


					</tr>
				<?php } ?>
					
					</table>
				</div>
			</div>
			<?php include 'inc/footer.php' ?>