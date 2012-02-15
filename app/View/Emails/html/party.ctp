<html>
    <head>
    </head>
    <body style="padding:0px;text-align:center;background-color:#ffffff;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;font-style:normal;line-height:14px;font-weight:normal;font-variant:normal;color:#333333;">
        <h3>New Vendor</h3>
        <br/>
        <h5>Information</h5>
        <p>
            Name: <?php echo $d['Vendor']['first_name'].' '.$d['Vendor']['last_name']; ?><br/>
            Email: <a href="<?php echo $d['Vendor']['email']; ?>"><?php echo $d['Vendor']['email']; ?></a><br/>
            Phone: <?php echo $d['Vendor']['phone']; ?><br/>
            Business Name: <?php echo $d['Vendor']['businessname'];?><br/>
            Business Name: <?php echo $d['Vendor']['businessurl'];?><br/>
            Number of Guests: <?php echo $d['Vendor']['guests'];?><br/>
        </p>
        
        <hr/>
        
    </body>
</html>