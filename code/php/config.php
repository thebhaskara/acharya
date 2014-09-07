<?php
ini_set('display_errors',true);
define('SITE_HOME_URL', 'http://localhost:885/code/');


/*
    define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT'].'/test');
    define('APP_PATH','http://127.0.0.1/test');
    define('SSL_PATH','https://127.0.0.1/test');
    define('FOLDER','/test');


# Enable/Disable Google Analytics
    define('SET_GOOGLE_ANALYTICS',0); //Live server should be 1 and dev/local server should be 0
*/
# Database settings
define('DB_HOST','localhost');
define('DB_USER_NAME','root');
define('DB_PASSWORD','');
define('DB','test');

# Table Prefix
define('TABLE_PREFIX','sample_acharya_00_');

# Encryption key
define("ENCRYPTION_KEY", "!@#bhaskara$%^&*");

# Variables
# Session
define("SESSION_ID", "session_id");
#define("SESSION_USER", "session_user");

# Folders

/*
# Image Upload Limit
    define('IMG_MAX_FILE_SIZE',2197152); //2 MB

# Image Sizes
    define('THUMBNAIL_WIDTH',96);
    define('THUMBNAIL_HEIGHT',96);

#Pagination Settings
    define('NUM_PER_PAGE',15);
*/

# Includes
require_once("utilities.php");
require_all_php("php/lib");
require_all_php("php/modules");


# Start Session
# Extend Session life
ini_set('session.gc_maxlifetime', '5400'); #session life for 90 minutes
# If Internet Explorer for exporting purposes need to change the Session Cache
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) session_cache_limiter("must-revalidate");

# Start Session and the Session ID
#manager::start_session();

# DB start
#manager::connect();
?>
