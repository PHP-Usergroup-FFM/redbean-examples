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
    echo "Database connection successful.<br/><br/>";
} catch (Exception $e) {
    echo "Error while connection to the database: " . $e->getMessage() . "<br/><br/>";
}

/**
 * Load member
 */
$member = R::load('member', 1);
echo "Loaded member: " . $member->foreName . ' ' . $member->lastName . ' - ' . $member->mailAddress;

/**
 * Update mail credentials
 */
$member->mailAddress = "cn@phpugffm.de";
try {
    R::store($member);
    echo "<br/>Updated member mail address to: " . $member->mailAddress;
} catch (Exception $e) {
    echo "<br/>Error on changing the mail address: " . $e->getMessage();
}

/**
 * delete member
 */
$anotherMember = R::load('member', 2);
try {
    R::trash($anotherMember);
    echo "<br/>Member deleted.";
} catch (Exception $e) {
    echo "<br/>Error on deleting member: " . $e->getMessage();
}

/**
 * close db handle
 */
R::close();