<?php    

#Fetching the city from ipstack

$url = "http://api.ipstack.com/check?access_key=7184746f9d7ae7a116f11f634fbdb157&format=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response);

$city  = "$response->city";

?>

<?php
$apiKey = "fbf652243dd227d900588132132aafbc";
   if (isset($_GET["cityname"]))
            {
       
                $cityName = $_GET["cityname"]; 
                $city = $cityName;
            }else
            {
                $cityName = $city;
            }
            
            
#fetching the weather from openweathermap using the city
            
$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityName . "&lang=en&units=metric&APPID=" . $apiKey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response);


// Indentification of parameters
$today = new DateTime();
//echo 'Today is: ' . $today->format('m-d-Y') . '<br />';
//echo ("The time is". date("g"));

// get the season dates
$spring = new DateTime('March 20');
$summer = new DateTime('June 20');
$fall = new DateTime('September 22');
$winter = new DateTime('December 21');

switch(true) {
    case $today >= $spring && $today < $summer:
        $season = 'Spring';
        break;

    case $today >= $summer && $today < $fall:
        $season = 'Summer';
        break;

    case $today >= $fall && $today < $winter:
        $season = 'Fall';
        break;

    default:
        $season = 'Winter';
}

if(isset($data->name)){ $Location = $data->name;}else{ $Location = $city;}

$temperature = ($data->main->temp_max + $data->main->temp_min) / 2;

$weather = $data->weather[0]->main;



?>