<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpFoundation\Request;

class ApplicationImportApi extends ApiTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($this->entityManager);
        $purger->purge();
    }

    public function testImport()
    {
        $request = new Request([], [], [], [], [], [], $this->request());

        $client = static::$kernel->getContainer()->get(\App\Controller\Api\ApplicationImportApi::class);
        $response = $client->import($request);
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content['applicationId']);
    }

    private function request()
    {
        return '
            {
                "businessEmail": "daniel02@test.com",
                "businessContactFirst": "DBA",
                "businessContactLast": "API",
                "businessName": "dbas street",
                "businessAddress1": "Test Address",
                "businessCity": "Tampa",
                "businessState": "FL",
                "businessZip": "33661",
                "businessPhone": "(564) 166-1655",
                "businessTaxid": "123456678",
                "businessDba": "dba API",
                "businessDbaAddress1": "dbas street",
                "businessDbaCity": "Tampa",
                "businessDbaState": "FL",
                "businessDbaZip": "33661",
                "heardAbout": "sales rep",
                "bankNameOnAccount": "Please provide a name.",
                "bankName": "DANIEL BANK",
                "bankPhone": "(564) 166-1655",
                "bankCity": "dba",
                "bankState": "AR",
                "bankRouting": "123123123",
                "bankAccount": "532414124",
                "bankType": "C"
            }
        ';
    }
}