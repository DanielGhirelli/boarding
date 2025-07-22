<?php

namespace App\Tests\Entity;

use App\Entity\OmnifundApplications;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OmnifundApplicationsTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testBusinessInfo()
    {
        $application = new OmnifundApplications();

        $application->setBusinessContactFirst('Test First');
        $application->setBusinessContactLast('Test Last');
        $application->setBusinessName('Business Name');
        $application->setBusinessAddress1('123 main st');
        $application->setBusinessCity('Somewhere');
        $application->setBusinessState('FL');
        $application->setBusinessZip('33544');
        $application->setBusinessEmail('dghrielli@omnifund.com');
        $application->setBusinessPhone('(111) 111-1111');
        $application->setBusinessTaxid('111111111');
        $application->setBusinessNumLocations(10);
        $application->setHeardAbout('sales rep');

        //DBA
        $application->setBusinessDba('Dba Test');
        $application->setBusinessDbaAddress1('456 main st');
        $application->setBusinessDbaCity('Here');
        $application->setBusinessDbaState('AR');
        $application->setBusinessDbaZip('35644');

        $errors = self::$container->get('validator')->validate($application, null, 'grp_business_info');
        $this->assertCount(0, $errors, $errors);
    }

    public function testBusinessBankRouting()
    {
        $application = new OmnifundApplications();

        $application->setBankNameOnAccount('Test Daniel');
        $application->setBankName('Test bank');
        $application->setBankPhone('(777) 777-7777');
        $application->setBankCity('Tampa');
        $application->setBankState('FL');
        // Valid Router: 267084131
        $application->setBankRouting('267084131');
        $application->setBankAccount('45641');
        $application->setBankType('Checking');

        $errors = self::$container->get('validator')->validate($application, null, 'grp_business_bank');
        $this->assertCount(0, $errors, $errors);
    }
}
