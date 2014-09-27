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
define('DB_NAME','kuchbhi');

# Table Prefix
define('TABLE_PREFIX','');
define('TABLE_QUESTION',TABLE_PREFIX.'question');
define('TABLE_QUESTION_TYPE',TABLE_PREFIX.'questiontype');
define('TABLE_SCENARIO',TABLE_PREFIX.'scenario');
define('TABLE_LEVEL',TABLE_PREFIX.'level');
define('TABLE_TOPIC',TABLE_PREFIX.'topic');
define('TABLE_ANSWER',TABLE_PREFIX.'answer');
define('TABLE_IMAGES',TABLE_PREFIX.'images');
define('TABLE_EXAM',TABLE_PREFIX.'exam');
define('TABLE_EXAMPARAMETERS',TABLE_PREFIX.'examparameter');
define('TABLE_SKILL',TABLE_PREFIX.'skill');
define('TABLE_QUESTIONTOPICRELATION',TABLE_PREFIX.'questiontopicrelation');
define('TABLE_EXAMSKILLRELATION',TABLE_PREFIX.'examskillrelation');
define('TABLE_QUESTION_PAPER',TABLE_PREFIX.'questionpaper');
define('TABLE_QUESTION_PAPER_DETAIL',TABLE_PREFIX.'questionpaperdetail');
define('TABLE_EXAMINER',TABLE_PREFIX.'examiner');
define('TABLE_CANDIDATE',TABLE_PREFIX.'candidate');
define('TABLE_RESULT',TABLE_PREFIX.'result');
define('TABLE_RESULTDETAIL',TABLE_PREFIX.'resultdetail');


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
require_all_php("php/models");


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
