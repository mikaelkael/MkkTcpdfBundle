<?php

namespace Mkk\TcpdfBundle\Service;

use ReflectionClass;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use TCPDF;

final class TcpdfService
{
    /**
     * @var string
     */
    private $className;

    /**
     * Class constructor.
     *
     * @param string $className The class name to use. Default is TCPDF. Must be based on TCPDF
     */
    public function __construct(ParameterBagInterface $params, string $className)
    {
        $config = $params->get('mkk_tcpdf.tcpdf');
        if ($config['k_tcpdf_external_config']) {
            foreach ($config as $k => $v) {
                $constKey = \strtoupper($k);
                // All K_ constants are required
                if (\preg_match('/^(K_|PDF_)/', $constKey)) {
                    if (!\defined($constKey)) {
                        $value = $params->resolveValue($v);
                        if (('k_path_cache' === $k || 'k_path_url_cache' === $k) && !\is_dir($value)) {
                            $this->createDir($value);
                        }
                        \define($constKey, $value);
                    }
                }
            }
        }
        $this->setClassName($className);
    }

    /**
     * Create a directory.
     *
     * @throws \RuntimeException
     */
    private function createDir(string $filePath): void
    {
        $filesystem = new Filesystem();
        if (false === $filesystem->mkdir($filePath)) {
            throw new \RuntimeException(\sprintf('Could not create directory %s', $filePath));
        }
    }

    /**
     * Creates a new instance of TCPDF/the class name to use as supplied
     * Any arguments passed here will be passed directly
     * to the TCPDF class as constructor arguments.
     */
    public function create(): TCPDF
    {
        $rc = new ReflectionClass($this->className);

        return $rc->newInstanceArgs(\func_get_args());
    }

    /**
     * Sets the class name to use for instantiation.
     *
     * @throws \LogicException if the class is not, or does not inherit from, TCPDF
     */
    public function setClassName(string $className): void
    {
        $rc = new ReflectionClass($className);
        if (!$rc->isSubclassOf('TCPDF') && 'TCPDF' !== $rc->getName()) {
            throw new \LogicException("Class '{$className}' must inherit from TCPDF");
        }
        $this->className = $className;
    }
}
