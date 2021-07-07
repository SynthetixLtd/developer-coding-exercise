<?php

    // remove for production
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	$executionStartTime = microtime(true);
    
    $url = 'https://www.googleapis.com/books/v1/volumes?q=subject:' . urlencode($_REQUEST['category']) . '&maxResults=40';
    
    //curl obj initialised and stored in var
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	 
	//executed the curl obj and store it in a var
	$bookInfo =curl_exec($ch);
	curl_close($ch);
    
    //decode json and convert to php assoc arr
    $bookInfoDecode  = json_decode($bookInfo ,true);	

    $output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "success";
	$output['status']['returnedIn'] = intval((microtime(true) - $executionStartTime) * 1000) . " ms";
	$output['status'] = $url;
	$output['data'] = $bookInfoDecode['items'];

    header('Content-Type: application/json; charset=UTF-8');
    
	// echo prints the output via the json_encode func
	// which returns a string containing the JSON representation of the supplied value
	echo json_encode($output);


?> 
