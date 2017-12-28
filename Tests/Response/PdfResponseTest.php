<?php

namespace Mkk\TcpdfBundle\Tests\Response;

use PHPUnit\Framework\TestCase;
use Mkk\TcpdfBundle\Response\PdfResponse;

class PdfResponseTest extends TestCase
{
    public function testResponseWithData()
    {
        $pdfResponse = new PdfResponse('test');
        $this->assertEquals(200, $pdfResponse->getStatusCode());
        $this->assertFalse($pdfResponse->headers->has('test'));
        $this->assertEquals('test', substr($pdfResponse->getContent(), 0, 5));
        $this->assertEquals('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithTcpdfObject()
    {
        $pdfResponse = new PdfResponse(new \TCPDF());
        $this->assertEquals(200, $pdfResponse->getStatusCode());
        $this->assertFalse($pdfResponse->headers->has('test'));
        $this->assertEquals('%PDF-', substr($pdfResponse->getContent(), 0, 5));
        $this->assertEquals('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithHeaders()
    {
        $pdfResponse = new PdfResponse('test', 123, array('test' => 'test'));
        $this->assertEquals(123, $pdfResponse->getStatusCode());
        $this->assertTrue($pdfResponse->headers->has('test'));
    }
}