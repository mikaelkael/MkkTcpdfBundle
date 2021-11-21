<?php

namespace Mkk\TcpdfBundle\Tests\Response;

use Mkk\TcpdfBundle\Response\PdfResponse;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PdfResponseTest extends TestCase
{
    public function testResponseWithData()
    {
        $pdfResponse = new PdfResponse('test');
        static::assertSame(200, $pdfResponse->getStatusCode());
        static::assertFalse($pdfResponse->headers->has('test'));
        static::assertSame('test', substr($pdfResponse->getContent(), 0, 5));
        static::assertSame('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithTcpdfObject()
    {
        $pdfResponse = new PdfResponse(new \TCPDF());
        static::assertSame(200, $pdfResponse->getStatusCode());
        static::assertFalse($pdfResponse->headers->has('test'));
        static::assertSame('%PDF-', substr($pdfResponse->getContent(), 0, 5));
        static::assertSame('application/pdf', $pdfResponse->headers->get('content-type'));
    }

    public function testResponseWithHeaders()
    {
        $pdfResponse = new PdfResponse('test', 123, ['test' => 'test']);
        static::assertSame(123, $pdfResponse->getStatusCode());
        static::assertTrue($pdfResponse->headers->has('test'));
    }
}
