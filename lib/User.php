<?php
	include_once 'Session.php';
	include 'Database.php';
	class User
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database();

		}
		public function getEmailuserlogin($email,$password)
		{
			$sql = "SELECT * FROM `tbl_user` WHERE `email`=:email AND `password`=:password LIMIT 1";

			$query = $this->db->pdo->prepare($sql);

			$query ->bindValue(':email',$email);

			$query ->bindValue(':password',$password);

			$query ->execute();

			$result = $query->fetch(PDO::FETCH_OBJ); //....Here i fetch obj......

			return $result;

		}

		public function userRegistration($data)
		{
			$Name = $data['name'];

			$userName = $data['username'];

			$email = $data['email'];

			$password = md5($data['password']);

			$chk_email = $this->emailCheck($email);

			if($name = "" OR $username = "" OR $email == "" OR $password == "")
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Filled must not be empty. </div>";
				return $msg;



			}
			if(strlen($userName) < 3)
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Username is Too short. </div>";
				return $msg;


			}
			
			if(preg_match('/[^a-z0-9_-]+/i', $userName))
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>User name only contain alphp numerical value </div>";
				return $msg;
			}
			

			if(filter_var($email,FILTER_VALIDATE_EMAIL) == false)
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Invalid Email address.</div>";
				return $msg;

			}
			if($chk_email == true)
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>This email is already exist.</div>";
				return $msg;

			}
			$sql = "INSERT INTO tbl_user (`name`,`username`,`email`,`password`) VALUES(:name,:username,:email,:password)";

			$query = $this->db->pdo->prepare($sql);

			$query ->bindValue(':name', $Name);

			$query ->bindValue(':username', $userName);

			$query ->bindValue(':email', $email);

			$query ->bindValue(':password', $password);



			$result = $query ->execute();

			if($result)
			{
				$msg = "<div class='alert alert-success'><strong>Thank you!Your registration has been complete.</strong></div>";
				return $msg;

			}
			else
			{
				$msg = "<div class='alert alert-success'><strong>Failed</strong>Your Registration is not complete</div>";
				return $msg;

			}


		}
		public function emailCheck($email)
		{
			$sql = "SELECT `email` FROM `tbl_user` WHERE `email`=:email";

			$query = $this->db->pdo->prepare($sql);

			$query ->bindValue(':email',$email);

			$query ->execute();

			if($query->rowCount() > 0)
			{
				return true;

			}
			else
			{
				return false;

			}

		}
		public function userLogin($data)
		{
			$email = $data['email'];

			$password = md5($data['password']);

			if($email == "" OR $password == "")
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Filled must not be empty. </div>";
				return $msg;
			}
			$value = $this -> getEmailuserlogin($email,$password);

			if($value)
			{
				Session::init();

				Session::set("login",true);

				Session::set("id",$value->id);//IN above i fetch object thats why i have to write 						       this way........//

				Session::set("name",$value->name);

				Session::set("username",$value->username);

				Session::set("loginmsg","<div class='alert alert-sessiom'><strong>success!!</strong>You are logged in successfully</div>");
				header("Location:index.php");
				/*public static function set($key,$val)
		{
			$_SESSION[$key] = $val;

		}*/


			}
			else
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Data not found</div>";
				return $msg;

			}

		}
		public function getuserdata()
		{
			$sql = "SELECT * FROM `tbl_user` ORDER BY `id` DESC";

			$query = $this->db->pdo->prepare($sql);

			$query ->execute();

			$result = $query->fetchAll();

			return $result;
		}

		public function getdataById($userid)
		{
			$sql = "SELECT * FROM `tbl_user` WHERE `id`=:userid";

			$query = $this->db->pdo->prepare($sql);

			$query ->bindValue(':userid',$userid);

			 $query ->execute();

			$rs = $query->fetch(PDO::FETCH_OBJ);

			 return $rs;

		}

		public function userupdation($data,$userid)
		{
			$Name = $data['name'];

			$userName = $data['username'];

			$email = $data['email'];


			

			if($name = "" OR $username = "" OR $email == "" )
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Filled must not be empty. </div>";
				return $msg;



			}
			if(strlen($userName) < 3)
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Username is Too short. </div>";
				return $msg;


			}
			
			if(preg_match('/[^a-z0-9_-]+/i', $userName))
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>User name only contain alphp numerical value </div>";
				return $msg;
			}
			

			if(filter_var($email,FILTER_VALIDATE_EMAIL) == false)
			{
				$msg = "<div class='alert alert-danger'><strong>ERROR!!</strong>Invalid Email address.</div>";
				return $msg;

			}

			$sql = "UPDATE tbl_user SET

			name = :name,

			username = :username,

			email = :email WHERE id = :userid";

			$query = $this->db->pdo->prepare($sql);

			$query ->bindValue(':name', $Name);

			$query ->bindValue(':username', $userName);

			$query ->bindValue(':email', $email);

			$query ->bindValue(':userid', $userid);

			$result = $query ->execute();

			 if($result)
			 {
			 	echo "<div class='alert alert-success'><strong>Success!!</strong>User data update successfully.</div>";
			 }
			 else
			 {
			 	echo "<div class='alert alert-danger'><strong>ERROR!!</strong>User data update not successfull.</div>";

			 }

			

		}

	}

?>