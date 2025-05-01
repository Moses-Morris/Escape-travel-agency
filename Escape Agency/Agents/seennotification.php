<?php
    include 'base.php';
?>
<?php


?>
<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin blockquote blockquote-primary">
            
            
            <?php
            //Approve message as seen notification
            $tomake= mysqli_real_escape_string($conn,$_GET["i"]);
            $action = "read";
            $result=mysqli_query($conn,"UPDATE notifications SET status='$action' WHERE NotificationID='$tomake'");
            if ($result)
            {
            print "<center><bold>Message Flagged as Seen<br/>Redirecting in 2 seconds...</center></bold>";
            }
            else
            {
            print "<center><bold>Action could not be performed, Something went wrong. Check back again<br/>Redirecting in 2 seconds...</center><bold>";
            }

    
            ?>
            <?php
                 echo "<script>
                 setTimeout(function() {
                     window.location.href = 'notifications.php';
                 }, 3000);
             </script>";
             echo "<center><bold>Message Seen.<bold></center>";
            ?>
<?php
    include 'footer.php';
?>