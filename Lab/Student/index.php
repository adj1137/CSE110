<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 11/14/2016
 * Time: 10:48 AM
 */
?>
<HTML>
<header>
    <title>Student Lab Portal</title>
</header>
<body>
<h1><?php echo $_SESSION['resource_link_title']; ?></h1>
<h1>Welcome <?php echo $_SESSION['lis_person_name_given'] ?>!</h1>
<h2></h2>
    <form method="get" action="timer.php">
        <input type="submit"  value="Begin Lab">Begin Lab</input>
    </form>
</body>
</HTML>
