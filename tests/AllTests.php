<?php
require_once 'PHPUnit/Framework.php';
require_once './EpiOAuthTest.php';
require_once './EpiFoursquareTest.php';
 
class AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('foursquare-async');
 
        $suite->addTest(Package_AllTests::suite());
        return $suite;
    }
}

class Package_AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('foursquare-async');
        $suite->addTestSuite('EpiOAuthTest');
        $suite->addTestSuite('EpiFoursquareTest');
        return $suite;
    }
}
