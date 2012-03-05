   Thank you for signing up!
      
      You will begin receiving leads from <?php echo $company['Company']['name']; ?> immediately.
      
      Leads will be sent to you by email, and are also viewable along with bills and profile settings at the following URL:
      <?php echo 'http://'.$company['Company']['subdomain'].'.leadcarrier.com/v/'.$vendor['Vendor']['token']; ?>
      
      You may bookmark this URL for future access.
      
      Your password: <?php echo $password; ?>
      You can change your password once you login.
      
      Thank You!
      <?php echo $company['Company']['name']; ?>
