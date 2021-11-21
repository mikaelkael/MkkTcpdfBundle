<?php

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@PHP74Migration' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PSR12' => true
    ])
    ->setRiskyAllowed(true)
    ->setFinder((new PhpCsFixer\Finder())->in(__DIR__))
    ->setCacheFile('.php-cs-fixer.cache')
;
