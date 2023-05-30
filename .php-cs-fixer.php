<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['./src', './tests'])
;

$config = new PhpCsFixer\Config();

$config
    ->setRiskyAllowed(true)
;

return $config
    ->setFinder($finder)
    ->setRules([
        '@PER' => true,

        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,

        'array_syntax' => true,

        'phpdoc_order' => true,
        'phpdoc_separation' => true,
    ]);
