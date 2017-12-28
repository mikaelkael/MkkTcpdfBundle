<?php

namespace Mkk\TcpdfBundle\Tests\Service;

use Mkk\TcpdfBundle\Service\TcpdfService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TcpdfServiceTest extends WebTestCase
{

    public function testService()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_tcpdf.tcpdf');
        $this->assertTrue($service instanceof TcpdfService);
        $this->assertEquals('/tmp/mkk_tcpdf', constant('K_PATH_URL_CACHE'));
    }

    public function testServiceCreation()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('mkk_tcpdf.tcpdf');
        $pdf = $service->create('L', 'mm', 'A5');
        $this->assertTrue($pdf instanceof \TCPDF);
    }
}