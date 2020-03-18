<?php

/*
 * This file is part of the TYPO3 CMS Extension "TYPO3-on-AWS Dashboard Widgets"
 * Extension author: Michael Schams - https://schams.net
 *
 * For copyright and license information, please read the LICENSE.txt
 * file distributed with this source code.
 *
 * @package     TYPO3
 * @subpackage  aws_dashboard_widgets
 * @author      Michael Schams <schams.net>
 * @link        https://t3rrific.com/typo3-on-aws/
 * @link        https://github.com/typo3-on-aws/aws_dashboard_widgets
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3-on-AWS Dashboard Widgets',
    'description' => 'TYPO3-on-AWS widgets for the TYPO3 v10 backend dashboard',
    'category' => 'be',
    'author' => 'Michael Schams',
    'author_email' => 'schams.net',
    'author_company' => 'schams.net',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '10.4.0',
    'autoload' => [
        'psr-4' => [
            'Typo3OnAws\\AwsDashboardWidgets\\' => 'Classes'
        ]
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '10.3.0-10.4.99',
            'php' => '7.2.0-7.4.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
