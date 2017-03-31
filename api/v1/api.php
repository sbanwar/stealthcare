<?php

date_default_timezone_set("Asia/Kolkata");
require_once("Rest.inc.php");

class API extends REST {

    public $data = "";

    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB = "SCP";
    const img = 'http://localhost/SCPProject/uploads/';
    const base_url = 'http://localhost/SCPProject/';
    const URL = 'http://localhost/SCPProject/';

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
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['request'])));
        if ((int) method_exists($this, $func) > 0)
            $this->$func();
        else
            $this->response('', 404);    // If the method not exist with in this class, response would be "Page not found".
    }

    // ******************************* LOGIN API *******************************
    private function Login() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        
        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
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
            $error = array('status_code' => "0", 'message' => "Please enter username", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
        // LOGIN VALIDATION CHECK ENDS
        if ($success) {
            // LOGIN
            $sql = mysql_query("SELECT * FROM `SCP_UserLogin` WHERE UserName='$username' AND Password='" . md5($password) . "'", $this->db);
            //$arr = array();
            if (mysql_num_rows($sql) > 0) {
                while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                    $row['UserID'] = $rlt['UserID'];
                    $row['UserName'] = $rlt['UserName'];
                    $row['EmailID'] = $rlt['EmailID'];
                    $row['StatusID'] = $rlt['StatusID'];
                    $arr = $row;
                }
                if($arr['StatusID'] != '1') {
                    $successdata = array('status_code' => "1", 'message' => "Currentlu your account is disabled", 'response_code' => "200", 'response_data' => $arr);
                    $this->response($this->json($successdata), 200);
                } else {
                    $UserID = $arr['UserID'];
                    $sql1 = mysql_query("SELECT * FROM `SCP_UserAccess` WHERE UserID='$UserID'", $this->db);

                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['UserID'] = $arr['UserID'];
                    $_SESSION['EmailID'] = $arr['EmailID'];
                    $_SESSION['UserName'] = $arr['UserName'];                    
                    $rlt1 = mysql_fetch_array($sql1, MYSQL_ASSOC);
                    $UserTypeID = $rlt1['UserTypeID'];
                    if($UserTypeID == 2) {
                        $careOrgSql = mysql_query("SELECT * FROM `SCP_CareOrg` WHERE UserID='$UserID'", $this->db);
                        $careOrgSql = mysql_fetch_array($careOrgSql, MYSQL_ASSOC);
                        $_SESSION['OrgID'] = $careOrgSql['OrgID'];
                    } else {
                        $_SESSION['OrgID'] = '';
                    }

                    $UserTypeSql = mysql_query("SELECT * FROM `SCP_UserType` WHERE UserTypeID='$UserTypeID'", $this->db);
                    $UserType = mysql_fetch_array($UserTypeSql, MYSQL_ASSOC);
                    $_SESSION['UserAccess'] = $UserType['UserTypeName'];

                    $successdata = array('status_code' => $UserTypeID, 'status' => "success", 'message' => "Login Successful", 'response_code' => "200", 'response_data' => $arr);
                    $this->response($this->json($successdata), 200);
                }
            } else {
                //if no user found
                $error = array('status_code' => "0", 'status' => "error", 'message' => "Wrong username and password!!!", 'response_code' => "200", 'response_data' => $arr);
                $this->response($this->json($error), 200);
            }
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    
    // ******************************* CREATE ORGANIZER API *******************************
    private function createOrgsignUp() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        
        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $email = $post['email'];
            $username = $post['username'];
            $password = md5($post['password']);
            $Name = $post['name'];
            $Address = $post['address'];
            $ContactNo = $post['phone'];
            $ContactNo2 = $post['mobile'];
            $FaxNo = $post['FaxNo'];
            $WebSite = $post['WebSite'];
            $OtherDetails = $post['OtherDetails'];
        } else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $Name = $_POST['name'];
            $Address = $_POST['address'];
            $ContactNo = $_POST['phone'];
            $ContactNo2 = $_POST['mobile'];
            $FaxNo = $_POST['FaxNo'];
            $WebSite = $_POST['WebSite'];
            $OtherDetails = $_POST['OtherDetails'];
        }
        $CreatedDateTime = date('Y-m-d H:i:s');
        $ModifyDateTime = date('Y-m-d H:i:s');

        $success = true;
        //print_r($_POST);
        // VALIDATION CHECK
        if (empty($username)) {
            $success = false;
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Please enter username", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
        // LOGIN VALIDATION CHECK ENDS
        if ($success) {
            // LOGIN
            $sql_insert = mysql_query("INSERT INTO `SCP_UserLogin` (`EmailID`, `UserName`, `Password`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES ('$email', '$username', '$password', '1', '$CreatedDateTime', '$ModifyDateTime')", $this->db);

            $last_insert_id = mysql_insert_id();

            $sql_insert = mysql_query("INSERT INTO `SCP_CareOrg` (`Name`, `Address`, `ContactNo`, `ContactNo2`, `FaxNo`, `WebSite`, `UserID`, `OtherDetails`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES ('$Name', '$Address', '$ContactNo', '$ContactNo2', '$FaxNo', '$WebSite', '$last_insert_id', '$OtherDetails', '$CreatedDateTime', '$ModifyDateTime', '1')", $this->db);

            $sql_insert = mysql_query("INSERT INTO `SCP_UserAccess` (`RightsID`, `AccessLevelID`, `UserID`, `UserTypeID`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES ('2', '2', '$last_insert_id', '2', '1', '$CreatedDateTime', '$ModifyDateTime')", $this->db);
            
            $arr[] = $last_insert_id;
            //if no user found
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Care Organizer Created Successfully", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);

        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* Care Organizer API *******************************
    private function CareOrga() {
        if ($this->get_request_method() != "GET") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        
        $success = true;

        if ($success) {
            // LOGIN
            $sql = mysql_query("SELECT * FROM SCP_UserLogin LEFT JOIN SCP_UserAccess ON SCP_UserAccess.UserID=SCP_UserLogin.UserID WHERE SCP_UserAccess.UserTypeID='2'", $this->db);            

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['UserID'] = $rlt['UserID'];
                $row['UserName'] = $rlt['UserName'];
                $row['EmailID'] = $rlt['EmailID'];
                $row['StatusID'] = $rlt['StatusID'];
                $UserID = $rlt['UserID'];
                $CareOrg = mysql_query("SELECT * FROM `SCP_CareOrg` WHERE UserID='$UserID'", $this->db);
                $CareOrg = mysql_fetch_array($CareOrg, MYSQL_ASSOC);
                $row['OrgID'] = $CareOrg['OrgID'];
                $arr[] = $row;
            }
            //print_r($arr);
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => "Care Organizers Get Successfully", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* SESSION API *******************************
    private function checkCareOrgEmailOrUsername() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        if(@$_POST['username']) {
            $UserName = $_POST['username'];
            $CareOrg = mysql_query("SELECT * FROM `SCP_UserLogin` WHERE UserName='$UserName'", $this->db);
            $CareOrg = mysql_fetch_array($CareOrg, MYSQL_ASSOC);
        } else {
            $EmailID = $_POST['email'];
            $CareOrg = mysql_query("SELECT * FROM `SCP_UserLogin` WHERE EmailID='$EmailID'", $this->db);
            $CareOrg = mysql_fetch_array($CareOrg, MYSQL_ASSOC);
        }
        
        if($CareOrg) {
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => "Care Organizers Get Successfully", 'response_code' => "200");
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* Plans API *******************************
    private function LicensePlans() {
        if ($this->get_request_method() != "GET") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        
        $success = true;

        if ($success) {
            // LOGIN
            $sql = mysql_query("SELECT * FROM `SCP_LicensesPlan`", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['PlanID'] = $rlt['PlanID'];
                $row['PlanName'] = $rlt['PlanName'];
                $row['MaxQty'] = $rlt['MaxQty'];
                $row['Price'] = $rlt['Price'];
                $row['StatusID'] = $rlt['StatusID'];
                $arr[] = $row;
            }
            
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => "Plans Get Successfully", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* GET PLAN API *******************************
    private function getUpdatePlanByID() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        $success = false;

        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $PlanName = $post['PlanName'];
            $MinQty = $post['MinQty'];
            $MaxQty = $post['MaxQty'];
            $Price = $post['Price'];
            $StatusID = $_POST['StatusID'];
            $PlanID = $_POST['PlanID'];
            mysql_query("UPDATE `SCP_LicensesPlan` SET `PlanName`='$PlanName', `MinQty`='$MinQty', `MaxQty`='$MaxQty', `Price`='$Price', `StatusID`='$StatusID' WHERE `PlanID` = '$PlanID'", $this->db);

            $sql = mysql_query("SELECT * FROM `SCP_LicensesPlan` WHERE PlanID='$PlanID'", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['PlanID'] = $rlt['PlanID'];
                $row['PlanName'] = $rlt['PlanName'];
                $row['MinQty'] = $rlt['MinQty'];
                $row['MaxQty'] = $rlt['MaxQty'];
                $row['Price'] = $rlt['Price'];
                $row['StatusID'] = $rlt['StatusID'];
                $arr = $row;
            }
            $success = true;
            $msg = "Update Plan Successfully";
        } else {
            $PlanID = $_POST['PlanID'];
            $sql = mysql_query("SELECT * FROM `SCP_LicensesPlan` WHERE PlanID='$PlanID'", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['PlanID'] = $rlt['PlanID'];
                $row['PlanName'] = $rlt['PlanName'];
                $row['MinQty'] = $rlt['MinQty'];
                $row['MaxQty'] = $rlt['MaxQty'];
                $row['Price'] = $rlt['Price'];
                $row['StatusID'] = $rlt['StatusID'];
                $arr = $row;
            }
            $success = true;
            $msg = "Plan Get Successfully";
        }

        if ($success) {

            $sql = mysql_query("SELECT * FROM `SCP_Status`", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['StatusID'] = $rlt['StatusID'];
                $row['StatusName'] = $rlt['StatusName'];
                $status[] = $row;
            }
            
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => $msg, 'response_code' => "200", 'response_data' => $arr, 'status_data' => $status);
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* CREATE PLAN API *******************************
    private function createPlan() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        //print_r($_POST); die();
        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $PlanName = $post['PlanName'];
            $MinQty = $post['MinQty'];
            $MaxQty = $post['MaxQty'];
            $Price = $post['Price'];
        } else {
            $PlanName = $_POST['PlanName'];
            $MinQty = $_POST['MinQty'];
            $MaxQty = $post['MaxQty'];
            $Price = $post['Price'];
        }

        $CreatedDateTime = date('Y-m-d H:i:s');
        $ModifyDateTime = date('Y-m-d H:i:s');

        $success = true;
        //print_r($_POST);
        
        // LOGIN VALIDATION CHECK ENDS
        if ($success) {
            // LOGIN
            $sql_insert = mysql_query("INSERT INTO `SCP_LicensesPlan` (`PlanName`, `MinQty`, `MaxQty`, `Price`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES ('$PlanName', '$MinQty', '$MaxQty', '$Price', '1', '$CreatedDateTime', '$ModifyDateTime')", $this->db);

            $last_insert_id = mysql_insert_id();
            
            $arr[] = $last_insert_id;
            //if no user found
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Create Plan Successful", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);

        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* DELETE PLAN API *******************************
    private function deletePlan() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }

        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $PlanID = $post['PlanID'];
        } else {
            $PlanID = $_POST['PlanID'];
        }

        $sql = mysql_query("DELETE FROM `SCP_LicensesPlan` WHERE PlanID='$PlanID'", $this->db);

        if($sql) {
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Delete Plan Successful", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* DELETE PLAN API *******************************
    private function changeStatusPlan() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }

        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $PlanID = $post['PlanID'];
            $StatusID = $post['StatusID'];
        } else {
            $PlanID = $_POST['PlanID'];
            $StatusID = $_POST['StatusID'];
        }

        $sql = mysql_query("UPDATE `SCP_LicensesPlan` SET `StatusID`='$StatusID' WHERE `PlanID` = '$PlanID'", $this->db);

        if($sql) {
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Change Plan Status Successful", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* CREATE PLAN API *******************************
    private function createLicense() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        //print_r($_POST); die();
        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $noOfLicense = $post['noOfLicense'];
        } else {
            $noOfLicense = $_POST['noOfLicense'];
        }
        $CreatedDateTime = date('Y-m-d H:i:s');
        $ModifyDateTime = date('Y-m-d H:i:s');
        if($noOfLicense != '0') {
            for ($i=1; $i <= $noOfLicense; $i++) {  
                $currentTimeStamp = strtotime(date('Y-m-d H:i:s'));    
                $LicenseKey = strtoupper(md5(microtime().$currentTimeStamp.$i.rand()));
                $sql_insert = mysql_query("INSERT INTO `SCP_Licenses` (`LicenseKey`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES ('$LicenseKey', '1', '$CreatedDateTime', '$ModifyDateTime')", $this->db);
                $arr[] = '';
            }   
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Licenses Created Successful", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* GET License API *******************************
    private function getUpdateLicenseByID() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        $success = false;

        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $StatusID = $_POST['StatusID'];
            $LicenseID = $_POST['LicenseID'];
            mysql_query("UPDATE `SCP_Licenses` SET `StatusID`='$StatusID' WHERE `LicenseID` = '$LicenseID'", $this->db);

            $sql = mysql_query("SELECT * FROM `SCP_Licenses` WHERE LicenseID='$LicenseID'", $this->db);

            $arr = mysql_fetch_array($sql, MYSQL_ASSOC);       
            $success = true;
            $msg = "Update License Successfully";
        } else {
            $LicenseID = $_POST['LicenseID'];
            $sql = mysql_query("SELECT * FROM `SCP_Licenses` WHERE LicenseID='$LicenseID'", $this->db);

            $arr = mysql_fetch_array($sql, MYSQL_ASSOC);                
            $success = true;
            $msg = "License Get Successfully";
        }

        if ($success) {

            $sql = mysql_query("SELECT * FROM `SCP_Status`", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $row['StatusID'] = $rlt['StatusID'];
                $row['StatusName'] = $rlt['StatusName'];
                $status[] = $row;
            }
            
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => $msg, 'response_code' => "200", 'response_data' => $arr, 'status_data' => $status);
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* DELETE PLAN API *******************************
    private function deleteLicense() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }

        $arr = array();
        if(@$_POST['reqparams']) {
            $post = $_POST['reqparams'];
            $LicenseID = $post['LicenseID'];
        } else {
            $LicenseID = $_POST['LicenseID'];
        }

        $sql = mysql_query("DELETE FROM `SCP_Licenses` WHERE LicenseID='$LicenseID'", $this->db);

        if($sql) {
            $error = array('status_code' => "1", 'status' => "success", 'message' => "Delete License Successful", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "validation error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* Plans API *******************************
    private function Licenses() {
        if ($this->get_request_method() != "GET") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        
        $success = true;

        if ($success) {
            // LOGIN
            $sql = mysql_query("SELECT * FROM `SCP_Licenses`", $this->db);

            while ($rlt = mysql_fetch_array($sql, MYSQL_ASSOC)) {
                $arr[] = $rlt;
            }
            
            $successdata = array('status_code' => "1", 'status' => "success", 'message' => "Licenses Get Successfully", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($successdata), 200);            
        } else {
            $error = array('status_code' => "0", 'status' => "error", 'message' => "Server Error", 'response_code' => "200", 'response_data' => $arr);
            $this->response($this->json($error), 200);
        }
    }

    // ******************************* SESSION API *******************************
    private function updateSessionByOrgID() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $OrgID = $_POST['OrgID'];
        $_SESSION["OrgID"] = $OrgID;
        $this->response($this->json($_SESSION), 200);
    }

    // ******************************* SESSION API *******************************
    private function Session() {
        if ($this->get_request_method() != "GET") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $session = $_SESSION;
        $response["UserID"] = $session['UserID'];
        $response["EmailID"] = $session['EmailID'];
        $response["UserName"] = $session['UserName'];
        $response["UserAccess"] = $session['UserAccess'];
        $response["OrgID"] = $session['OrgID'];
        $this->response($this->json($response), 200);
    }

    // ******************************* LOGOUT API *******************************
    private function Logout() {
        if ($this->get_request_method() != "GET") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        $this->destroySession();
        $successdata = array('status_code' => "1", 'status' => "success", 'message' => "Logged out successfully", 'response_code' => "200");
        $this->response($this->json($successdata), 200);
    }

    public function destroySession(){
        if (!isset($_SESSION)) {
        session_start();
        }
        if(isSet($_SESSION['UserID']))
        {
            unset($_SESSION['UserID']);
            unset($_SESSION['UserName']);
            unset($_SESSION['EmailID']);
            unset($_SESSION['UserAccess']);
            unset($_SESSION['OrgID']);
            $info='info';
            if(isSet($_COOKIE[$info]))
            {
                setcookie ($info, '', time() - $cookie_time);
            }
            $msg="Logged Out Successfully...";
        }
        else
        {
            $msg = "Not logged in...";
        }
        return $msg;
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

    // ******************************* CREATE PLAN API *******************************
    private function insertData() {
        if ($this->get_request_method() != "POST") {
            $error = array('status_code' => "0", 'message' => "wrong method", 'response_code' => "406");
            $this->response($this->json($error), 406);
        }
        //print_r($_POST); die();
        $arr = array();
        $Data = $_POST['Data']; 
        $sql_insert = mysql_query("INSERT INTO `SCP_Test` (`Data`) VALUES ('$Data')", $this->db);
        $last_insert_id = mysql_insert_id();
        $sql = mysql_query("SELECT * FROM `SCP_Test` WHERE ID='$last_insert_id'", $this->db);
        $arr = mysql_fetch_array($sql, MYSQL_ASSOC);
        $error = array('status_code' => "1", 'status' => "success", 'message' => "Data Inserted Successfully", 'response_code' => "200", 'response_data' => $arr);
        $this->response($this->json($error), 200);
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

