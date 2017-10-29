<?php
    
  require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
  
   function callCurl($url,$params,$method)
  {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      $body = $params;
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); 
      curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       $result = curl_exec($ch);
       curl_close($ch);
       return $result;
  } 


 $action = $_REQUEST['action'];
 
 if(empty($action))
 {
  exit;
 }

 switch ($action) {
  case 'get-balance':
   $url = "https://mobius.network/api/v1/app_store/balance?";
   $params = array(
        "api_key" => $_REQUEST['api_key'],
        "app_uid" => $_REQUEST['app_uid'],
        "email" => $_REQUEST['email'],
         );
   $query_string = http_build_query($params);
   
   $response = callCurl($url,$params,"GET");
   echo $response;
   break;
  case 'use-credits':
   $url = "https://mobius.network/api/v1/app_store/use?";
   $params = array(
        "api_key" => $_REQUEST['api_key'],
        "app_uid" => $_REQUEST['app_uid'],
        "email" => $_REQUEST['email'],
        "num_credits" => $_REQUEST['num_credits'],
         );
   $response = callCurl($url,$params,"POST");
   echo $response;
   break;
  case 'delete-last-mobius-order':
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'shop_order' ORDER BY id DESC LIMIT 1";
    $result = $wpdb->get_results($sql);
    $order_id = $result[0]->ID;
    echo $sql = "DELETE FROM ".$wpdb->prefix."posts WHERE ID=".$order_id;
    $wpdb->query($sql);
    break;
  default:
   break;
 }
