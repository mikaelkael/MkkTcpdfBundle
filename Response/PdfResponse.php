<?php

namespace Mkk\TcpdfBundle\Response;
use Symfony\Component\HttpFoundation\Response;
use \TCPDF;

class PdfResponse extends Response
{

    /**
     * @param mixed $data    The response data
     * @param int   $status  The response status code
     * @param array $headers An array of response headers
     */
    public function __construct($data = null, $status = 200, $headers = array())
    {
        if ($data instanceof TCPDF) {
            $data = $data->Output('', 'S');
        }
        $headers['Content-Type'] = 'application/pdf';
        parent::__construct($data, $status, $headers);
    }
}