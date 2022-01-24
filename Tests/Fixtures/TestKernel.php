<?php

namespace Mkk\TcpdfBundle\Tests\Fixtures;

use Mkk\TcpdfBundle\MkkTcpdfBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Used for functional tests.
 */
final class TestKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [new FrameworkBundle(), new MkkTcpdfBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config/config.yml');
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/Tests/Fixtures/cache/'.$this->environment;
    }
}

\class_alias('Mkk\TcpdfBundle\Tests\Fixtures\TestKernel', 'TestKernel');
