<html>
<body>
    <p>Hello New User,</p>
    <p>Thanks for signing up with CymbitCMS!</p>
    <p>Your User ID: <a href="mailto:<?php echo $identity;?>"><?php echo $identity;?></a></p>
    <p>Follow this link to login: <a href="<?php echo base_url() . 'site'; ?>"><?php echo base_url() . 'site'; ?></a></p>
    <?php include('include/footer.php'); ?>
</body>
</html>