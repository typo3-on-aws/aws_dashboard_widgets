<?php
declare(strict_types = 1);
namespace Typo3OnAws\AwsDashboardWidgets\Widgets;

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

use TYPO3\CMS\Dashboard\Widgets\AbstractCtaButtonWidget;

/**
 * Link to documentation
 */
class LinkToDocumentationWidget extends AbstractCtaButtonWidget
{
    /**
     * Language file
     */
    const LANGUAGE_FILE = 'LLL:EXT:aws_dashboard_widgets/Resources/Private/Language/locallang.xlf';

    /**
     * @var string
     */
    protected $title = self::LANGUAGE_FILE . ':widgets.link_to_documentation.title';

    /**
     * @var string
     */
    protected $text = self::LANGUAGE_FILE . ':widgets.link_to_documentation.text';

    /**
     * @var string
     */
    protected $description = self::LANGUAGE_FILE . ':widgets.link_to_documentation.description';

    /**
     * @var string
     */
    protected $label = self::LANGUAGE_FILE . ':widgets.link_to_documentation.label';

    /**
     * @var string
     */
    protected $link = 'https://t3rrific.com/typo3-on-aws/docs/';

    /**
     * @var string
     */
    protected $icon = 'actions-window-open';
}