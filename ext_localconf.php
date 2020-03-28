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

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(static function () {
    // Register extension icons
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'tx-aws_dashboard_widgets-widget-icon',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:aws_dashboard_widgets/Resources/Public/Icons/Widget.svg']
    );
    $iconRegistry->registerIcon(
        'tx-aws_dashboard_widgets-dashboard-icon',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:aws_dashboard_widgets/Resources/Public/Icons/Dashboard.svg']
    );
});
