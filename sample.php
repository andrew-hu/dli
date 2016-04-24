
<?php
/**
 * Andrew Hu used code from this location: https://github.com/Yelp/yelp-api/blob/master/v2/php/sample.php
 *
 * Yelp API v2.0 code sample.
 *
 * This program demonstrates the capability of the Yelp API version 2.0
 * by using the Search API to query for businesses by a search term and location,
 * and the Business API to query additional information about the top result
 * from the search query.
 *
 * Please refer to http://www.yelp.com/developers/documentation for the API documentation.
 *
 * This program requires a PHP OAuth2 library, which is included in this branch and can be
 * found here:
 *      http://oauth.googlecode.com/svn/code/php/
 *
 * Sample usage of the program:
 * `php sample.php --term="bars" --location="San Francisco, CA"`
 */
// Enter the path that the oauth library is in relation to the php file
require_once('lib/OAuth.php');
// Set your OAuth credentials here
// These credentials can be obtained from the 'Manage API Access' page in the
// developers documentation (http://www.yelp.com/developers)
$CONSUMER_KEY = "iBJxmfq3iIQFtz7gTidR8Q";
$CONSUMER_SECRET = "7O732L9aUuEsOl_PeBRhkxUczQ8";
$TOKEN = "FzXBIgA1wvRsXw3DnfsCdkKt9_oCl4LM";
$TOKEN_SECRET = "CGW_MHWBsCczNFM5lSqw-C2Fee4";
$API_HOST = 'api.yelp.com';
$DEFAULT_TERM = 'mediterranean';
$DEFAULT_LOCATION = '94539';
$SEARCH_LIMIT = 10;
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';
/**
 * Makes a request to the Yelp API and returns the response
 *
 * @param    $host    The domain host of the API
 * @param    $path    The path of the APi after the domain
 * @return   The JSON response from the request
 */
function request($host, $path) {
    $unsigned_url = "https://" . $host . $path;
    // Token object built using the OAuth library
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);
    // Consumer object built using the OAuth library
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);
    // Yelp uses HMAC SHA1 encoding
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer,
        $token,
        'GET',
        $unsigned_url
    );

    // Sign the request
    $oauthrequest->sign_request($signature_method, $consumer, $token);

    // Get the signed URL
    $signed_url = $oauthrequest->to_url();

    // Send Yelp API Call
    try {
        $ch = curl_init($signed_url);
        if (FALSE === $ch)
            throw new Exception('Failed to initialize');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        if (FALSE === $data)
            throw new Exception(curl_error($ch), curl_errno($ch));
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new Exception($data, $http_status);
        curl_close($ch);
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);
    }

    return $data;
}
/**
 * Query the Search API by a search term and location
 *
 * @param    $term        The search term passed to the API
 * @param    $location    The search location passed to the API
 * @return   The JSON response from the request
 */
function search($term, $location) {
    $url_params = array();

    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);

    return request($GLOBALS['API_HOST'], $search_path);
}
/**
 * Query the Business API by business_id
 *
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request
 */
function get_business($business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id);

    return request($GLOBALS['API_HOST'], $business_path);
}
/**
 * Queries the API by the input values from the user
 *
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 */
function query_api($term, $location) {
    $response = json_decode(search($term, $location));
    $business_id = $response->businesses[0]->id;
    
    for($i=0; $i<10; $i++) {
        echo "<a id='taste_name' href=" . $response->businesses[$i]->url . ">" . $response->businesses[$i]->name . "</a><br>";
        echo "<img src=" . $response->businesses[$i]->rating_img_url . "></img></a><br>";
        for ($j=0; $j<count($response->businesses[$i]->categories); $j++){
            echo $response->businesses[$i]->categories[$j][0];
            if ($j<count($response->businesses[$i]->categories)-1) { echo ", "; }
        } echo "<br>";
        echo "<a href=" . $response->businesses[$i]->url . "><img src=" . $response->businesses[$i]->image_url . "></img></a><br>";
        echo $response->businesses[$i]->location->display_address[0] . "<br>" . $response->businesses[$i]->location->display_address[1] ."<br>";
        echo "(".substr($response->businesses[$i]->phone, 0, 3).") ".substr($response->businesses[$i]->phone, 3, 3)."-".substr($response->businesses[$i]->phone,6) . "<br>";
        echo "<br><hr>";
    }

    echo "<br>";
    
    //Business info dump 
    /*
    print sprintf(
        "%d businesses found, querying business info for the top result \"%s\"\n\n",
        count($response->businesses),
        $business_id
    );

    $response = get_business($business_id);

    print sprintf("Result for business \"%s\" found:\n", $business_id);
    
    print "<br>$response\n";
    */
    
}
/**
 * User input is handled here
 */

$longopts  = array(
    "term::",
    "location::",
);

$options = getopt("", $longopts);
$term = $options['term'] ?: '';
$location = $options['location'] ?: '';
query_api($term, $location);
?>
