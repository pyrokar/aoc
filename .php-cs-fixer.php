<?php

$finder = PhpCsFixer\Finder::create()
	->in(['./src', './tests'])
;

$config = new PhpCsFixer\Config();

$config
	->setRiskyAllowed(true)
	->setIndent("\t")
;

return $config->setRules([
	'@PSR12' => true,
	'blank_line_after_opening_tag' => false,
	'declare_strict_types' => true,
	'strict_param' => true,
	'array_syntax' => ['syntax' => 'short'],

])
	->setFinder($finder)
	;
