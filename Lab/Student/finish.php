<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 11/22/2016
 * Time: 10:26 PM
 */
?>
<HTML>
<body>
    <H1>You Finished!</h1>
    <h2>Your Score of <?php echo $_SESSION['grade']; ?> has been recorded.</h2>
</body>
</HTML>
