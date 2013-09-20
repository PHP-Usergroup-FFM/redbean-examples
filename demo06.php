<?php
/**
 * Created by JetBrains PhpStorm.
 * User: christiannielebock
 * Date: 03.09.13
 * Time: 13:45
 * To change this template use File | Settings | File Templates.
 */

/**
 * include RedBeanPHP
 */
require_once('lib/rb.php');

/**
 * setup RedBeanPHP
 */
try {
    R::setup('mysql:host=localhost;dbname=redbean_demo', 'redbean', 'redbean');
    echo "Database connection successful.";
} catch (Exception $e) {
    echo "Error while connection to the database: " . $e->getMessage();
}

/**
 * create user group (parent) object
 */
$phpug = R::dispense('usergroup');
/**
 * Set unique key for UG credentials
 */
$phpug->setMeta("buildcommand.unique", array(array('ug_title', 'ug_web', 'ug_mail')));
$phpug->ugTitle = "PHPUGFFM";
$phpug->ugLocation = "Frankfurt am Main";
$phpug->ugWeb = "http://www.phpugffm.de";
$phpug->ugMail = "ug@phpugffm.de";


try {
    R::store($phpug);
    echo "<br/>Usergroup object created.";
} catch (Exception $e) {
    echo "<br/>Error on creating user group object: " . $e->getMessage();
}

/**
 * assign members to the user group
 */
$phpugmembers = R::find('member', 'mail_address LIKE "%phpugffm.de"');

/**
 * ATTENTION:
 * The word "own" is mandatory to create the N-1 relation otherwise an error is thrown
 * Also the "bean" type must be existing, here "member"
 */
$phpug->ownMember = $phpugmembers;
try {
    R::store($phpug);
    echo "<br/>Members successfully added to the user group " . $phpug->ugTitle;
} catch (Exception $e) {
    echo "<br/>Error while adding members to the user group: " . $e->getMessage();
}

/**
 * close db handle
 */
R::close();