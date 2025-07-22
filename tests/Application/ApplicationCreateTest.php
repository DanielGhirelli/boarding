<?php

namespace App\Tests\Application;

use App\Application\ApplicationCreate;
use App\Exception\ApplicationException;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class ApplicationCreateTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testRegister()
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->purge();

        $error = $this->register();
        $this->assertTrue($error, 'Error creating a new record!');
    }

    /**
     * @depends testRegister
     */
    public function testAlreadyRegistered()
    {
        $this->expectException(ApplicationException::class);
        $this->register();
    }

    public function register()
    {
        $csrfToken = self::$container->get('security.csrf.token_manager')->getToken('application_register_form')->getValue();

        $request = new Request([], [
            'application_register_form' => [
                'businessEmail' => 'daniel@omnifund.com',
                'isoId' => 'omnifund_pipeline_test',
                '_token' => $csrfToken
            ]
        ]);

        $request->setMethod('POST');

        $create = self::$container->get(ApplicationCreate::class);
        return $create->create($request);
    }
}
