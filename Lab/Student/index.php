<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */

?>
<h1><?php echo $_SESSION['user_data']['context_label'] . ": " . $_SESSION['user_data']['context_title'] . " Lab System" ?></h1>
<hr />
<h2>Welcome <?php echo $_SESSION['user_data']['lis_person_name_given'];  ?>!</h2>
<h3>Section <?php echo $_SESSION['user_data']['context_id'];  ?></h3>
<h2><?php echo $_SESSION['user_data']['resource_link_title'];  ?></h2>
<?php
session_destroy();
?>
