<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 11/22/2016
 * Time: 10:26 PM
 */

//TODO: Send Info Back to BlackBoard
?>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="style.css">
</header>
<body>
    <H1>You Finished!</h1>
    <h2>Your Score of <?php echo sprintf("%.2f%%", $_SESSION['grade'] * 100) ; ?> has been recorded.</h2>
</body>
</HTML>
