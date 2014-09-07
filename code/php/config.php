<?php
ini_set('display_errors',true);
define('SITE_HOME_URL', 'http://localhost:88/bb3/');


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
define('T_PREFIX','sample_bb3_00_');

# Table Names
define('T_USER',T_PREFIX.'user');

# Encryption key
define("ENCRYPTION_KEY", "!@#bhaskara$%^&*");

# Variables
# Session
define("SESSION_ID", "session_id");
#define("SESSION_USER", "session_user");

# Folders
define("F_VIEW", "View/");
define("F_JS", "View/js/");
define("F_JS_EXT", "View/js/external/");
define("F_CSS", "View/css/");
define("F_CSS_EXT", "View/css/external/");
define("F_FONTS", "View/fonts/");
define("F_IMG", "View/img/");
define("F_LIBRARY", "Controller/Library/");
define("F_MODEL", "Controller/Model/");


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
require_all_php(F_LIBRARY);
require_all_php(F_MODEL);


# Start Session
# Extend Session life
ini_set('session.gc_maxlifetime', '5400'); #session life for 90 minutes
# If Internet Explorer for exporting purposes need to change the Session Cache
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) session_cache_limiter("must-revalidate");

# Start Session and the Session ID
manager::start_session();

# DB start
manager::connect();
?>
