<?php
declare(strict_types = 1);

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

$languageFile = 'LLL:EXT:aws_dashboard_widgets/Resources/Private/Language/locallang.xlf';
return [
    'typo3_on_aws' => [
        'title' => $languageFile . ':presets.custom',
        'description' => $languageFile . ':presets.custom.description',
        'iconIdentifier' => 'tx-aws_dashboard_widgets-dashboard-icon',
        'defaultWidgets' => [
            'generalInformation',
            'awsExtensionsWidget',
            'linkToCommercialSupportWidget',
            'linkToCommunitySupportWidget'
        ],
        'showInWizard' => true
    ]
];
