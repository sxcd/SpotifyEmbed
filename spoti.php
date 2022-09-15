<!DOCTYPE html>
<head>
</head>

<body style="background-image: url('ipod2.png');background-repeat: no-repeat;background-color:black">

<?php
// Account & API Account Information
$user = "CENSORED"; // <---- Your username goes here
$key = "CENSORED"; //<-- Your API key goes here

// The URL of the request to API Service
$url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=$user&api_key=$key&format=json";

// Enable Shortening
$short_titles = true;

// Setup cURL for request
$ch = curl_init( $url );
$options = array(
	CURLOPT_RETURNTRANSFER => true
	);
curl_setopt_array($ch, $options);

// Execute cURL
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json,true);

$last = $data['recenttracks']['track'][0];

if (isset($last['@attr']['nowplaying'])) {

	$output = "" . $last['name'] . ' by ' . $last['artist']['#text'] . " on Spotify";

	if ($short_titles) {
		$output = sTrim($output);
	}

	$itsout = trim($output);
	echo "<p style='color:black;position: absolute;top: 50px;left:45px;width:145px;font-family: Arial, Helvetica, sans-serif'>Now playing: </p>";
	echo "<p style='color:black;position: absolute;top: 70px;left:45px;width:145px;font-family: Arial, Helvetica, sans-serif'><marquee>" . $itsout ."</p></marquee></body></html>";
} else {
	$played = $last['date']['uts']; $now = time();
	$diff = abs($now - $played);
	$hours = intval(intval($diff) / 3600); 
	$minutes = intval(($diff / 60) % 60);

	if (!empty($hours)) {
		if ($hours > 24)
			$time = "Over a day ago";
		else
			$time = $hours . " hours and " . $minutes . " minutes ago";
	} else
		$time = $minutes . " minutes ago";

	$output = "Currently not listening :P";

	if ($short_titles) {
		$output = sTrim($output);
	}
    $itsout = trim($output);
	echo "<p style='color:black;position: absolute;top: 60px;left:45px;width:145px;font-family: Arial, Helvetica, sans-serif'><marquee>" . $itsout ."</p></marquee></body></html>";
}

exit();

function sTrim($output) {
	$output = preg_replace("/- Live/i", "", $output);
	$output = preg_replace("/- Album Version Explicit/i", "", $output);
	$output = preg_replace("/- Explicit Album Version/i", "", $output);
	$output = preg_replace("/- Explicit Version/i", "", $output);
	$output = preg_replace("/- Album Version/i", "", $output);
	$output = preg_replace("/\\[(.*?)\]/i", "", $output);
	$output = preg_replace("/\\((.*?)\)/i", "", $output);
	return $output;
}
?>