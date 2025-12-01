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
        '@PER-CS3x0' => true,

        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,

        'array_syntax' => true,

        'phpdoc_order' => true,
        'phpdoc_separation' => true,

        'no_unused_imports' => true,
        'fully_qualified_strict_types' => [
            'import_symbols' => true,
        ],
        'global_namespace_import' => [
            'import_constants' => true,
            'import_functions' => true,
            'import_classes' => true,
        ],
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
            'sort_algorithm' => 'alpha',
        ],

        'no_extra_blank_lines' => ['tokens' => ['extra', 'use']],

        'ordered_class_elements' => true,
    ]);
