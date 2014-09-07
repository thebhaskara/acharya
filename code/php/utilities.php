<?php
/**
 * Prints the object with Pre tags
 */
function alert($obj) {
    ob_start();
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
    $out1 = ob_get_contents();
    ob_end_clean();
    return $out1;
}

/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string) {
    $encryption_key = ENCRYPTION_KEY;
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string) {
    $encryption_key = ENCRYPTION_KEY;
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}

/**
 * includes all files in folder
 */
function require_all_php($folder){
    foreach (glob("{$folder}/*.*") as $filename) require_once $filename;
}

/**
 * renders a view by passing model object to it
 */
function render_view($name, $model = ''){
    if(isset($name)){
        ob_start();
        include(F_VIEW.$name);
        $out1 = ob_get_contents();
        ob_end_clean();
        return $out1;
    }
    return '';
}


?>
