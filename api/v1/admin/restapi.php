<?php

include 'libXML.php';
include 'lib.php';
include '../../config.php';

/* Store the id number sent by the application */
if(@$_REQUEST['request']) {
    // request in json string '[{"username":"abanwar","password":"123456","id":"1"}]';
    $post = json_decode($_REQUEST['request']);
    $post = $post['0'];
    $postArray = array();
    foreach($post as $key => $field){
        $postArray[$key] = $field;
    }
    $post = $postArray;
    $ID = $post['id'];
} 

$_content_type = "application/json;charset=utf-8";
header("Content-Type:".$_content_type);

$dbDBname = DB;
$dbUsername= DB_USER;
$dbPassword= DB_PASSWORD;
$hostName = DB_SERVER;
$URLName = URL;
$baseUrl = base_url;

//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// FUNCTIONS /////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
/******************************************************************************************************************/
/* 
*   ID=1
*   A function used as a response to ID=1
*   It is used to loginWithUsername
*   PARAMETERS: -
*   Return Value: User Details se morfi json
*/
function loginWithUsername($post)
{
    $username = $post['username'];
    $password = $post['password'];
    $con=connectToDB(); //connect to the DB
    mysql_query('SET NAMES UTF8');   
    $password = md5($password); 
    $result = mysql_query("call loginWithUsername('".$username."','".$password."');");
    //CHECK FOR ERROR
    if (!$result) die('Invalid query: ' . mysql_error());
    $rows = array();
    while($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if($rows) {
        $data['responseData'] = $rows;
        $data['responseMessage'] = "Login successfully";
        $data['responseCode'] = "200";
        $data['status'] = "1";
    } else {
        $data['responseData'] = '';
        $data['responseMessage'] = "Please check your Username and Password";
        $data['responseCode'] = "200";
        $data['status'] = "0";
    }
    print json_encode($data);
    mysql_close($con);   //close the connection
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// MAIN //////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

switch($ID) {
    case 1: loginWithUsername($post);
         break;             
    default: myError(); 
}

?>
