<?php
/*
 * 張文相 Zhang Wenxiang - 個人 Blog
 * https://blog.reh.tw/
 */
if(!function_exists('hash_equals')) {
    function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--) {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}

require_once dirname(__FILE__).'/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '3878036438881053',
    'app_secret' => 'd86358c44f8e789d7bb8a0360878169b',
    'default_graph_version' => 'v6.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email'];

try {
    if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
}
?>
