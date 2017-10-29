<?php 

global $wpdb;

$appTable =  "mobius";
global $wpdb;
$result = $wpdb->get_results ( "SELECT * FROM ".$appTable );
$api_key = $result[0]->api_key;
$app_uid = $result[0]->app_uid;
$app_credit_charge_per_each_use = $charge_val;


?>
<div class="container">
  <div class="row">
   <div class="col-md-12 played-games">
    <h3 class="section-title">Pay with Mobius</h3>
    <form class="form-group">
      <input class="form-control" type="text" name="mobius_email" id="mobius_email" placeholder="Enter mobius email" style="width: 100%;" />
      <input class="form-control" type="hidden" name="api_key" id="api_key" value="<?php echo $api_key ?>" />
      <input class="form-control" type="hidden" name="app_uid" id="app_uid" value="<?php echo $app_uid ?>" />
      <input class="form-control" type="hidden" name="app_credit_charge_per_each_use" id="app_credit_charge_per_each_use" value="<?php echo $app_credit_charge_per_each_use ?>" />
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  
    jQuery.ajaxQ = (function(){
    var id = 0, Q = {};

    jQuery(document).ajaxSend(function(e, jqx){
      jqx._id = ++id;
      Q[jqx._id] = jqx;
    });
    jQuery(document).ajaxComplete(function(e, jqx){
      delete Q[jqx._id];
    });

    return {
      abortAll: function(){
        var r = [];
        jQuery.each(Q, function(i, jqx){
          r.push(jqx._id);
          jqx.abort();
        });
        return r;
      }
    };

  })();

  jQuery(document).ready(function()
  {

    var checkout_btn = "input[name='woocommerce_checkout_place_order']";
    jQuery(checkout_btn).on('click',function()
    {
     var selected_payment_method = jQuery('input[name=payment_method]:checked').val();
     // alert(selected_payment_method);
     if(selected_payment_method == "mobius_gateway") {
         var previous_text = jQuery(this).val();
         jQuery(checkout_btn).val("Please wait ...");
         var mobius_email = jQuery("#mobius_email").val();
         var api_key = jQuery("#api_key").val();
         var app_uid = jQuery("#app_uid").val();
         var app_credit_charge_per_each_use = jQuery("#app_credit_charge_per_each_use").val();

         if(mobius_email=='') {
          alert("Please enter mobius email.");
          jQuery(checkout_btn).val(previous_text);
          return false;
        }

        var api_url = "<?php echo  plugins_url( 'admin/mobius_api.php', dirname(__FILE__) )   ?>"; 
        var app_credit_charge_per_game =  app_credit_charge_per_each_use;
        jQuery.ajax({
          url : api_url,
          data : {action:"get-balance",email:mobius_email,api_key:api_key,app_uid:app_uid},
          success : function(response){
           response = JSON.parse(response);
           var num_credits = response.num_credits;
           if(num_credits < app_credit_charge_per_game)
           {
              alert("You have not enough credits to mobius account. Please add credits to our mobius app to play game.Please visit https://mobius.network/store/.Note : Credits require to play one game is "+app_credit_charge_per_game);
                jQuery.ajaxQ.abortAll();
                jQuery.ajax({
                url : api_url,
                data : {action:"delete-last-mobius-order"},
                success : function(response){
                  // alert("OID is "+response);
                }
                });
          }
          else
          {
            jQuery.ajax({
             url : api_url,
             data : {action:"use-credits",email:mobius_email,api_key:api_key,app_uid:app_uid,num_credits:app_credit_charge_per_game},
             success : function(response){
              console.log(response);
              response = JSON.parse(response);
              var remaining_num_credits = response.num_credits;
              if(response.success == true)
              {
               alert('Mobius credits have been successfully charged.');
             }
           },
           error : function(error) {
            console.log(error);
          }
        });
          }
          jQuery(checkout_btn).val(previous_text);
        },
        error : function(error) {
         console.log(error);
         jQuery(checkout_btn).val(previous_text);
       }
     });

        return true;
  }
  });
  }); 

</script>
