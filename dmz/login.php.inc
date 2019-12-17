<?php

class loginDB
{
private $logindb;

public function __construct()
{
	$this->logindb = new mysqli("192.168.0.144","testUser","12345","testdb");

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
    $code = $this->random_code(4);
    $statement = "INSERT INTO login VALUES ('$un', '$pw', '$fn', '$ln','$code')";
	$response = $this->logindb->query($statement);
    $statement = "INSERT INTO friends VALUES ('$un', NULL)";
	$response = $this->logindb->query($statement);
}

public function changePassword($username, $password){
    $un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
    $statement = "UPDATE login SET password='$pw' WHERE email='$un'";
	$response = $this->logindb->query($statement);
}

public function likeMovie($username, $title){
    $un = $this->logindb->real_escape_string($username);
	$title = $this->logindb->real_escape_string($title);
    $statement = "INSERT INTO userld VALUES('$un', '$title', 'liked')";
	$response = $this->logindb->query($statement);
}

public function dislikeMovie($username, $title){
    $un = $this->logindb->real_escape_string($username);
	$title = $this->logindb->real_escape_string($title);
    $statement = "INSERT INTO userld VALUES('$un', '$title', 'disliked')";
	$response = $this->logindb->query($statement);
}

public function getLikes($username){
    $un = $this->logindb->real_escape_string($username);
    $statement = "SELECT * FROM userld WHERE email='$un' and type='liked'";
	$response = $this->logindb->query($statement);
    $result = "";
    while($row = $response->fetch_assoc()) {
        $result .= $row['title']. ",";
    }
    return $result;
}

public function getDislikes($username){
    $un = $this->logindb->real_escape_string($username);
    $statement = "SELECT * FROM userld WHERE email='$un' and type='disliked'";
	$response = $this->logindb->query($statement);
    $result = "";
    while($row = $response->fetch_assoc()) {
        $result .= $row['title'] . ",";
    }
    return $result;
}

public function random_code($length){
   $string = "";
   $chars = "abcdefghijklmanopqrstuvwxyz0123456789";
   $size = strlen($chars);
   for ($i = 0; $i < $length; $i++) {
       $string .= $chars[rand(0, $size - 1)];
   }
   return $string; 
}

public function getFriends($username){
    $un = $this->logindb->real_escape_string($username);
    $statement = "SELECT * FROM friends WHERE email='$un'";
	$response = $this->logindb->query($statement);
    $result = "";
    while($row = $response->fetch_assoc()) {
        $result .= $row['friend'] . ",";
    }
    return $result;
}

public function getProfile($cd){
    $code = $this->logindb->real_escape_string($cd);
    $statement = "SELECT * FROM login WHERE code='$code'";
	$response = $this->logindb->query($statement);
    $row = $response->fetch_assoc();
    return $row['email'];
}

public function addFriend($em, $fe){
    $email = $this->logindb->real_escape_string($em);
    $friendEmail = $this->logindb->real_escape_string($fe);
    $statement = "INSERT INTO friends VALUES ('$email', '$friendEmail')";
	$response = $this->logindb->query($statement);
    
    if ($response){
        return 1;//went successfully
    }else{
        return 0;//unsuccessful
    }
}

public function getUsersWithMovie($t){
    $title = $this->logindb->real_escape_string($t);
    $statement = "SELECT * FROM userld WHERE title='$title' AND type='liked'";
	$response = $this->logindb->query($statement);
    $returnUsers = array();
    
    while ($row = $response->fetch_assoc()){
        array_push($returnUsers, $row['email']);
    }
    return $returnUsers;
}


}
?>
