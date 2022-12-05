<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . \DIRECTORY_SEPARATOR)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP81Migration' => true,
        '@PHP80Migration:risky' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters', 'match']],
        'no_alternative_syntax' => ['fix_non_monolithic_code' => false],
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_align' => ['align' => 'left'],
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
