<?php

class loginDB
{
private $logindb;

public function __construct()
{
	$this->logindb = new mysqli("127.0.0.1","testUser","12345","testdb");

	if ($this->logindb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

public function validateLogin($username,$password)
{
	$un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
	$statement = "select * from login where email = '$un'";
	$response = $this->logindb->query($statement);

	while ($row = $response->fetch_assoc())
	{
		echo "checking password for $username".PHP_EOL;
		if ($row["password"] == $pw)
		{
			echo "passwords match for $username".PHP_EOL;
			return 1;// password match
		}
		echo "passwords did not match for $username".PHP_EOL;
	}
	return 0;//no users matched username
}

public function register($username, $password, $firstName, $lastName){
    $un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
	$fn = $this->logindb->real_escape_string($firstName);
	$ln = $this->logindb->real_escape_string($lastName);
    $statement = "INSERT INTO login VALUES ('$un', '$pw', '$fn', '$ln')";
	$response = $this->logindb->query($statement);
    $statement = "INSERT INTO userld VALUES ('$un')";
	$response = $this->logindb->query($statement);
}

public function changePassword($username, $password){
    $un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
    $statement = "UPDATE login SET password='$password' WHERE email='$username'";
	$response = $this->logindb->query($statement);
}

}
?>
