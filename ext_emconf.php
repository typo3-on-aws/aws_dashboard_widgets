<?php

/*
 * This file is part of the TYPO3 CMS Extension "TYPO3-on-AWS Dashboard Widgets"
 * Extension author: Michael Schams <schams.net>
 *
 * Project: https://t3rrific.com/typo3-on-aws/
 * Sources: https://github.com/typo3-on-aws/aws_dashboard_widgets
 *
 * For copyright and license information, please read the LICENSE.txt
 * file distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3-on-AWS Dashboard Widgets',
    'description' => 'TYPO3-on-AWS widgets for the TYPO3 backend dashboard',
    'category' => 'be',
    'author' => 'Michael Schams <schams.net>',
    'author_email' => '',
    'author_company' => 'schams.net',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '13.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.4.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
