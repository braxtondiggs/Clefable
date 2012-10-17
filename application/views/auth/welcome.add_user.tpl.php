<html>
<body>
    <p>Hello <?php echo $first_name . " " . $last_name;?>,</p>
    <p><?php echo $active_first_name . " " . $active_last_name;?> has invited you to a CymbitCMS shared account:</p>
    <p>Your User ID: <a href="mailto:<?php echo $identity;?>"><?php echo $identity;?></a><br />
    Your Password: <?php echo $password;?></p>
    <p>Follow this link to login: <a href="<?php echo base_url() . 'site'; ?>"><?php echo base_url("app"); ?></a></p>
    <?php include('include/footer.php'); ?>
</body>
</html>