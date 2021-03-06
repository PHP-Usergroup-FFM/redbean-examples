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
require("lib/rb.php");

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
 * Simple Crud - option 1
 */
$ugMember = R::dispense('member');

/**
 * Set unique key for fore name, last name and mail address
 */
$ugMember->setMeta("buildcommand.unique", array(array('fore_name', 'last_name', 'mail_address')));

$ugMember->foreName = "Christian";
$ugMember->lastName = "Nielebock";
$ugMember->mailAddress = "christian@phpugffm.de";
try {
    $ugMemberID = R::store($ugMember);
    echo "<br/><br/>";
    echo "ugMemberID of " . $ugMember->foreName . " = " . $ugMemberID . "<br/>";
} catch (Exception $e) {
    echo "<br/><br/>Error on storing: " . $e->getMessage();
}

/**
 * Simple Crud - option 2
 */
$anotherMember = R::dispense('member');
$anotherMember->setAttr('foreName', 'Andreas')
              ->setAttr('lastName', 'Heigl')
              ->setAttr('mailAddress', 'andreas@phpugffm.de');
try {
    $anotherMemberID = R::store($anotherMember);
    echo "ugMemberID of " . $anotherMember->foreName . " = " . $anotherMemberID . "<br/>";
} catch (Exception $e) {
    echo "<br/><br/>Error on storing: " . $e->getMessage();
}

/**
 * close db handle
 */
R::close();