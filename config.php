<?php
 
/*

 General settings
 
*/

define("HOME","http://127.0.0.1/framework/jmind-1.0.0/examples/");
define("ROOT_IMAGES","../examples/images/");
define("JMIND_DIR","../");
 
 
/*

 Database settings
 LOGIN = ON/OFF

*/

define("HOST","localhost");
define("DB","jmind");
define("USER","root");
define("PWD","");


/*

 Login settings
 LOGIN = ON/OFF

*/
define("LOGIN","OFF");
define("ACCOUNT_TABLE","account");
define("ACCOUNT_USER_FIELD","user");
define("ACCOUNT_PWD_FIELD","pwd");
define("ACCOUNT_HASH_FUNCTION","md5");
define("LOGIN_SUCCESS_URL","http://127.0.0.1/framework/jmind-1.0.0/examples/app/index.php");
define("LOGIN_ERROR_URL","http://127.0.0.1/framework/jmind-1.0.0/examples/app/login.php");

?>






