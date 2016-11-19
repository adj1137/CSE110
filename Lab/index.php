<?php
session_start();

include_once '../Lab/Include/functions.php';
include_once "../Lab/Include/library/OAuthStore.php";
include_once "../Lab/Include/library/OAuthRequester.php";

//Collect All Connection Info into Session
//$_SESSION['user_data'] = $_POST;

$_SESSION['user_id'] = $_POST['user_id'];
$_SESSION['roles'] = $_POST['roles'];
$_SESSION['resource_link_id'] = $_POST['resource_link_id'];
$_SESSION['resource_link_title'] = $_POST['resource_link_title'];
$_SESSION['resource_link_description'] = $_POST['resource_link_description'];
$_SESSION['context_title'] = $_POST['context_title'];
$_SESSION['context_label'] = $_POST['context_label'];
$_SESSION['lis_person_name_given'] = $_POST['lis_person_name_given'];
$_SESSION['user_id'] = $_POST['user_id'];


//TODO: Add OAuth Authentication to verify connection
$key = 'key'; // fill with your public key
$secret = 'secret'; // fill with your secret key
$url = "http://term.ie/oauth/example/request_token.php?oauth_version=1.0&oauth_nonce=6e3114dbe907e10ef4143a19eb8c5a7b&oauth_timestamp=1479370739&oauth_consumer_key=key&oauth_signature_method=HMAC-SHA1&oauth_signature=5lES6BLzeWxRDxVtuU1riqKbHgg%3D"; // fill with the url for the oauth service

$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
OAuthStore::instance("2Leg", $options);

$method = "GET";
$params = null;

try
{
    // Obtain a request object for the request we want to make
    $request = new OAuthRequester($url, $method, $params);

    // Sign the request, perform a curl request and return the results,
    // throws OAuthException2 exception on an error
    // $result is an array of the form: array ('code'=>int, 'headers'=>array(), 'body'=>string)
    $result = $request->doRequest();

    $response = $result['body'];

    if ($response != 'oauth_token=requestkey&oauth_token_secret=requestsecret')
    {
        echo 'Error! $response ' . $response;
    }
    else
    {
    }


    var_dump($response);
}
catch(OAuthException2 $e)
{
    echo "Exception" . $e->getMessage();
}


if(strcmp($_SESSION['roles'], 'Learner') == 0)
{
    Redirect('../Lab/Student/index.php');
}
elseif(strcmp($_SESSION['roles'], 'Instructor') == 0)
{
    Redirect('../Lab/Instructor/index.php');
}
else
{

}



echo '<pre>';
echo var_dump($_SESSION['user_data']);
echo '</pre>';
?>