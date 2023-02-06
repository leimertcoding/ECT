// Netsuite Restlet OAuth 1.0 authentication
$url = "https://392875-sb4.app.netsuite.com/app/site/hosting/restlet.nl";
$netsuite_data = array(
    "access_token" => "ed71a40f8f57dabc0f3c1e67cebc0bd7fa3055f1cb0f37ec0ec3107e987e55d3",
    "consumer_key" => "a3dc763b6c0902c51cc0f3f371a9b4e053dd1c1db1a28ec2e95038ec1557a4d7",
    "consumer_secret" => "d43fc785e230e83e936a5e5dc4ee4f1a8a7f3508bc6949f359532c41b1532f81",
    "token_secret" => "455bbca1a2f5483253079d982b0a3039a98f863e5b99bd493e10e47626383a40",
);

// Include the User and Role information in the request
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer " . $netsuite_data["access_token"],
    "Consumer-Key: " . $netsuite_data["consumer_key"],
    "Consumer-Secret: " . $netsuite_data["consumer_secret"],
    "Token-Secret: " . $netsuite_data["token_secret"],
    "Content-Type: application/json",
    "User: Web Service 3 SB",
    "Role: EP Support Person 1",
));

$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

curl_close($ch);

if (!$response) {
    echo "Authentication failed. " . curl_error($ch);
} else {
    echo "Authentication succeeded.\n";
    echo $body;
}
