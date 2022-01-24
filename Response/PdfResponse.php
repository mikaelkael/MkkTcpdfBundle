<?php

namespace Mkk\TcpdfBundle\Response;

use Symfony\Component\HttpFoundation\Response;
use TCPDF;

final class PdfResponse extends Response
{
    /**
     * @param mixed $data    The response data
     * @param int   $status  The response status code
     * @param array $headers An array of response headers
     */
    public function __construct($data = null, $status = 200, $headers = [])
    {
        if ($data instanceof TCPDF) {
            $data = $data->Output('', 'S');
        }
        $headers['Content-Type'] = 'application/pdf';
        parent::__construct($data, $status, $headers);
    }
}
