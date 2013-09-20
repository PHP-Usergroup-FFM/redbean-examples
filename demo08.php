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
 * Create another user group object
 */
$phpug2 = R::dispense('usergroup');
$phpug2->ugTitle = "PHPUGRHH";
$phpug2->ugLocation = "Wiesbaden";
$phpug2->ugWeb = "http://www.phpug-rheinhessen.de/";
$phpug2->ugMail = "info@phpug-rheinhessen.de";
$phpug2_id = R::store($phpug2);

echo "<br/>Created new PHP user group: " . $phpug2->ugTitle;
/**
 * Create and assign new member for the UG
 */
$newMember = R::dispense('member');
$newMember->foreName = "New";
$newMember->lastName = "Member";
$newMember->mailAddress = "newmember@example.org";
$newMemberID = R::store($newMember);

$phpug2->ownMember = array($newMember);
R::store($phpug2);
echo "<br/>Added member " . $newMember->foreName . " " . $newMember->lastName . " to " . $phpug2->ugTitle;

/**
 * Assigning other members to this UG
 */
$otherMembers = R::find('member', 'mail_address LIKE "%phpugffm.de"');
foreach ($otherMembers as $member) {
    $phpug2->sharedMember[] = $member;
}
R::store($phpug2);

echo "<br/>Added shared members to " . $phpug2->ugTitle  . ": <br/><br/>";
foreach ($phpug2->sharedMember as $member) {
    echo "<br/>" . $member->foreName . " " . $member->lastName . " is a member of " . $phpug2->ugTitle;
}


/**
 * close db handle
 */
R::close();