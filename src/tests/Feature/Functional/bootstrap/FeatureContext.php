<?php

use Behat\Behat\Context\Context;

use PHPUnit_Framework_Assert as PHPUnit;
use Symfony\Component\DomCrawler\Crawler;
use Laravel\Dusk\Browser;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on the customer management page
     */
    public function iAmOnTheCustomerManagementPage()
    {
        $this->visit('/customers'); // Use the visit() method to navigate to the URL
    }


}
