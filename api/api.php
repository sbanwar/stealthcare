<?php


require_once("Rest.inc.php");

class API extends REST {

    public $data = "";

    const DB_SERVER = "stealthcaredb.db.11923901.hostedresource.com";
    const DB_USER = "stealthcaredb";
    const DB_PASSWORD = "Iziss@2112";
    const DB = "stealthcaredb";
    const img = 'http://stealthcare.izisstechnology.in/uploads/';
    const base_url = 'http://stealthcare.izisstechnology.in/';
    const URL = 'http://stealthcare.izisstechnology.in/';

    private $db = NULL;

    public function __construct() {
        parent::__construct();    // Init parent contructor
        $this->dbConnect();     // Initiate Database connection   
    }

    /*
     *  Database connection 
     */

    private function dbConnect() {
        $this->db = mysql_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD);
        if ($this->db)
            mysql_select_db(self::DB, $this->db);

        if (!$this->db) {
            $dbError = array();
            $dbError['status_code'] = "0";
            $dbError['errorCode'] = "8";
            $this->response($this->json($dbError), 400);
        }
    }

    /*
     * Public method for access api.
     * This method dynmically call the method based on the query string
     *
     */

    public function processApi() {
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
        if ((int) method_exists($this, $func) > 0)
            $this->$func();
        else
            $this->response('', 404);    // If the method not exist with in this class, response would be "Page not found".
    }

    
    // ******************************* LOGIN API *******************************
    private function Login() {
        if ($this->get_request_method() != "POST") {
            $this->response('wrong method', 406);
        }
        
        $arr = array();
        if(@$_POST['customer']) {
            $post = $_POST['customer'];
            $username = $post['username'];
            $password = $post['password'];
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
        }
	
        $success = true;

        // VALIDATION CHECK
        if (empty($username)) {
            $success = false;
            $error = array('status_code' => "0", 'response_message' => "Please enter username", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
        // LOGIN VALIDATION CHECK ENDS
        if ($success) {
            // LOGIN
            $sql = mysql_query("SELECT * FROM `SCP_UserLogin` WHERE UserName='$username' AND Password='" . md5($password) . "' AND StatusID='1'", $this->db);
            //$arr = array();
            if (mysql_num_rows($sql) > 0) {
                while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                    $row['UserID'] = $rlt['UserID'];
                    $row['UserName'] = $rlt['UserName'];
                    $row['EmailID'] = $rlt['EmailID'];

                    $arr[] = $row;
                }
                $successdata = array('status_code' => "1", 'response_message' => "Login Successful", 'response_code' => "200", 'response_data' => $arr);
                $this->response($this->json($successdata), 200);
            } else {
                //if no user found
                $error = array('status_code' => "0", 'response_message' => "Wrong username and password!!!", 'response_code' => "200", 'response_data' => $arr);
                $this->response($this->json($error), 200);
            }
        } else {
            $error = array('status_code' => "0", 'response_message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }
    
    // ******************************* SEND MAIL FUNCTION *******************************
    function sendEmail($subject,$to,$html){
        $from = "anil.banwar@izisstechnology.com";
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From:" .  $from;
        
        //$NewMessage = '<p>'.$name.' '.$surname.' reported '.$videoname.' for '.$report.' content<p>';
        $url = "http://bigbobsmeats.ca/mail_service/mail.php";
        $data = array(
            'html' => $html,
            'toemail' => $to,
            'fromemail' => $from,
            'subject' => $subject
        );
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $sendmail = curl_exec($curl);	
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);	
        curl_close($curl);           
    }
    
    // ******************************* ENCODE ARRAY INTO JSON *******************************
    private function json($data) {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}

// Initiiate Library

$api = new API;
$api->processApi();
?>

