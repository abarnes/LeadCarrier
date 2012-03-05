<html>
    <head>
    </head>
    <body style="padding:8px;text-align:left;background-color:#ffffff;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;font-style:normal;line-height:14px;font-weight:normal;font-variant:normal;color:#333333;">
      <h3>Thank you for signing up!</h3>
      
      <p>You will begin receiving leads from <?php echo $company['Company']['name']; ?> immediately.</p><br/>
      
      <p>Leads will be sent to you by email, and are also viewable along with bills and profile settings at the following URL:<br/>
      <a href="<?php echo 'http://'.$company['Company']['subdomain'].'.leadcarrier.com/v/'.$vendor['Vendor']['token']; ?>">http://'.$company['Company']['subdomain'].'.leadcarrier.com/v/'.$vendor['Vendor']['token']; ?></a><br/><br/>
      You may bookmark this URL for future access.<br/><br/>
      Your password: <?php echo $password; ?><br/>
      You can change your password once you login.<br/><br/>
      Thank You!<br/>
      <?php echo $company['Company']['name']; ?>
      </p>

    </body>
</html>