<?php

/*
 * TYPO3 Middleware Demo
 *
 * (c)2020 by Michael Schams <schams.net>
 * https://schams.net
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Middleware Demo',
    'description' => '',
    'category' => 'misc',
    'version' => '1.0.0',
    'state' => 'beta',
    'createDirs' => '',
    'clearcacheonload' => true,
    'author' => 'Michael Schams (schams.net)',
    'author_email' => 'schams.net',
    'author_company' => 'https://schams.net',
    'constraints' => [
        'depends' => [
            'php' => '7.2.0-7.4.99',
            'typo3' => '9.5.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
