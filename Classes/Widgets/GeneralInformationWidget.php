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

use TYPO3\CMS\Core\Information\Typo3Information;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\AbstractWidget;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * This widget will show general information regarding TYPO3
 */
class GeneralInformationWidget extends AbstractWidget
{
    /**
     * Language file
     */
    const LANGUAGE_FILE = 'LLL:EXT:aws_dashboard_widgets/Resources/Private/Language/locallang.xlf';

    /**
     * Extension key
     *
     * @var string
     */
    protected $extensionKey = 'aws_dashboard_widgets';

    /**
     * @var string
     */
    protected $title = self::LANGUAGE_FILE . ':widgets.general_information.title';

    /**
     * @var string
     */
    protected $description = self::LANGUAGE_FILE . ':widgets.general_information.description';

    /**
     * @var string
     */
    protected $templateName = 'GeneralInformation';

    /**
     * @var string
     */
    protected $iconIdentifier = 'content-widget-text';

    /**
     * @var int
     */
    protected $height = 4;

    /**
     * @var int
     */
    protected $width = 4;

    /**
     * Initialize view
     *
     * @access protected
     */
    protected function initializeView(): void
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setTemplate('Widget/' . $this->templateName);
        $this->view->getRenderingContext()->getTemplatePaths()->fillDefaultsByPackageName($this->extensionKey);
        $this->view->assign('title', $this->getTitle());
    }
}
