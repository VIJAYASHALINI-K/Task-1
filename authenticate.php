<?php
include "session.php";
$emailAddress=$_POST['emailAddress'];
$password=$_POST['password'];
$sessionId=password_hash($emailAddress,PASSWORD_DEFAULT);

/*
file_get_contents($filename)
*@param string $file_name
*@return string|false; - if file present file contents returned else false returned
*/
/*
json_decode($json,$associative)
*@param string $json - json string
*@param bool $associative - as true denotes associative array, false denotes not an associative array
*@return object|null; - json encoded values are returned as object and not encoded as null
*/
$user=json_decode(file_get_contents("user.json"),true);
 /*
*array_column($array, $string_value)
*@param array $array - $user as associative array
*@param int|string|null $column_key - accessing the column value
*@return array;
*/     
$emailAddressInUser=array_column($user,"emailAddress");
/*
*array_search($data,$arraymixed)
*@param mixed $value - as value want to search in array 
*@param array $array
*@param bool $strict - Optional. if true search for identical value with datatype else search data without identical value
*@return int|string|false;
*/
$emailAddressPresentInUser=array_search($emailAddress,$emailAddressInUser);

if($emailAddressPresentInUser!=false){
    $passwordInUser=$user[$emailAddressPresentInUser]['password'];
    $emailAddressPresentInUser=1;
}
else{
    $emailAddressPresentInUser=0;
    $passwordInUser=0;
}
/*
*password_verify($password,$hash)
*@param string $password
*@param string $hash
*@return bool; -true password match and false password not match
*/
$passwordPresentInUser=password_verify($password,$passwordInUser);
//$_SESSION['id']=$sessionId;
if(($emailAddressPresentInUser && $passwordPresentInUser)&&($emailAddressPresentInUser!=0 && $passwordPresentInUser!=0)){
    if(isset($_SESSION['id'])){
        //echo "res1";
      header("Location:http://localhost/dashboard.php?Message=".urlencode("Login Successfull"));
    } else {
        //echo "res2";
        $_SESSION['id']=$sessionId;
       header("Location:http://localhost/dashboard.php?Message=".urlencode("Login Successfull"));    
    }
}
else if(!($emailAddressPresentInUser) && !($passwordPresentInUser)){
    //echo "inc1";
    header("Location:http://localhost/login.php");//?Message=".urlencode("You are new User. Register Now"));
}
else if($emailAddressPresentInUser && !($passwordPresentInUser)){
    //echo "inc2";
    header("Location:http://localhost/login.php");//?Message=".urlencode("Incorrect login details"));
}
else{
    //echo "inc3";
    header("Location:http://localhost/login.php");//?Message=".urlencode("Incorrect login details"));
}
?>