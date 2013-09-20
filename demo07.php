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
 * Get members through PHPUG object
 */
$phpug = R::load('usergroup', 1);

$members = $phpug->ownMember;

if (count($members)) {
    foreach ($members as $currentMember) {
        echo "<br/>User " . $currentMember->foreName . " is in the group " . $phpug->ugTitle;
    }
} else {
    echo "<br/>No members found.";
}

/**
 * close db handle
 */
R::close();