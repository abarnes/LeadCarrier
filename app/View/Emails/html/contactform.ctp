<html>
    <head>
    </head>
    <body style="padding:8px;text-align:left;background-color:#ffffff;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;font-style:normal;line-height:14px;font-weight:normal;font-variant:normal;color:#333333;">

        <p>
            Message Submitted By: <?php echo $d['name']; ?><br/>
            Company: <?php echo $d['company']; ?><br/>
            Email: <?php echo $d['email']; ?><br/><br/>
            
            <?php echo $d['message']; ?>
        </p>

    </body>
</html>