<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\OmnifundApplications;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class OmnifundApplicationsTest extends ApiTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testGetApplication()
    {
        $application = $this->buildMerchant();

        $request = [
            'headers' => [
                'x-api-key' => getenv('API_KEY')
            ]
        ];

        $client = static::createClient();
        $client->request('GET', '/api/applications/' . $application->getApplicationId(), $request);
        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals($application->getApplicationHash(), $response['applicationHash']);
    }

    public function testInvalidCredentials()
    {
        $client = static::createClient();
        $client->request('GET', '/api/applications/');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    protected function buildMerchant(): OmnifundApplications
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->purge();

        $application = new OmnifundApplications();
        $application->setBusinessName('dba');
        $application->setApplicationHash('995F1869A9650849BEE1AA9A246D02AA');

        $this->entityManager->persist($application);
        $this->entityManager->flush();

        return $application;
    }
}
