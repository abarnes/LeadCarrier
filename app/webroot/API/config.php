<?php
//config.php - LeadCarrier

$company_name='Barnespos';                  //your company name (capitalization matters!)
$apitoken = 'apitoken';                     //your company's API token
$site_url = 'localhost:8888';               //your own website URL (not your lead carrier URL)        
$leadcarrier_url = 'localhost:8888';        //your company's Lead Carrier access url (e.g. company.leadcarrier.com)
$submit_type = 'together';                  //If you are submitting client information AND industry selections at once, set this to 'together'
                                                    //For separate information and industry selection submissions, set this to 'separate'
                                                    
/*------------------------Function-specific variables-------------------------------*/

//******
//  parse_all
//******

//******
//  parse_info
//******

//******
//  parse_selections
//******

//******
//  get_form
//******



/*------------------------Do not edit below this line-------------------------------*/

$post = array(
    'api_token' => $apitoken,
    'company_name'=>$company_name
);
if ($submit_type=='separate') {
    $parse_url = 'parse_info';
} else {
    $parse_url = 'parse_all';
}
?>