<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://mwplug.com
 * @since      1.0.0
 *
 * @package    Mobius
 * @subpackage Mobius/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<?php
$success=0;
if(isset($_REQUEST['submit'])){
    global $wpdb;
    $api_key = $_REQUEST['api_key'];
    $app_uid = $_REQUEST['app_uid'];
//    $App_credit_charge_per_each_use = $_REQUEST['App_credit_charge_per_each_use'];
    $wpdb->query("DELETE FROM mobius");
    $wpdb->query("INSERT INTO mobius (api_key, app_uid) VALUES ('$api_key', '$app_uid')"  );
    $success=1;
}

global $wpdb;

$appTable =  "mobius";
     global $wpdb;
        $result = $wpdb->get_results ( "SELECT * FROM mobius" );
        $api_key = $result[0]->api_key;
        $app_uid = $result[0]->app_uid;
        $app_credit_charge_per_each_use = $result[0]->app_credit_charge_per_each_use;


?>

<h1>Mobius</h1>
<?php
if($success==1){?>
<div class="alert alert-success col-md-6">
  <strong>Success!</strong> Data inserted successfully.
</div>
<?php }?>
<form method="post">
    <div class="row col-md-7">
  <div class="form-group">
    <label for="email">Api key:</label>
    <input type="text" class="form-control" name="api_key" value="<?php echo $api_key; ?>" id="api_key">
  </div>
  <div class="form-group">
    <label for="pwd">Api user ID:</label>
    <input type="text" class="form-control" name="app_uid" value="<?php echo $app_uid; ?>" id="app_uid">
  </div>
<!--    <div class="form-group">
    <label for="pwd">App credit charge per each use:</label>
    <input type="text" class="form-control" name="App_credit_charge_per_each_use" value="<?php //echo $app_credit_charge_per_each_use ?>" id="App_credit_charge_per_each_use">
  </div>-->
  
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  
    </div>
    <div class="row col-md-6">
        <br/>
<b>Note : You can use [mobius_front] short-code to use it in any page. </b>
</div>
</form>
<br/><br/>
