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
 * Searching for members with phpugffm.de mail address
 */
$members = R::find('member', 'mail_address LIKE "%phpugffm.de"');

echo "<br/>";

if (count($members)) {
    foreach ($members as $singleMember) {
        echo "<br/>Found " . $singleMember->foreName . " with mail address: " . $singleMember->mailAddress;
    }
} else {
    echo "<br/>No members with the given search criterias found.";
}

/**
 * close db handle
 */
R::close();