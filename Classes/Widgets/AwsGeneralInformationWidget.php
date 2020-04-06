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

use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class AwsGeneralInformationWidget implements WidgetInterface
{
    /**
     * @var WidgetConfigurationInterface
     */
    private $configuration;

    /**
     * @var StandaloneView
     */
    private $view;

    /**
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $extensionKey = 'aws_dashboard_widgets';

    /**
     * @var string
     */
    private $templateName = 'AwsGeneralInformationWidget';

    /**
     * Constructor
     */
    public function __construct(
        WidgetConfigurationInterface $configuration,
        StandaloneView $view,
        array $options = []
    ) {
        $this->configuration = $configuration;
        $this->view = $view;
        $this->options = $options;
    }

    /**
     * Render widget content by using custom templates
     */
    public function renderWidgetContent(): string
    {
        $this->view->setTemplate('Widget/' . $this->templateName);
        $this->view->getRenderingContext()->getTemplatePaths()->fillDefaultsByPackageName($this->extensionKey);
        $this->view->assign('configuration', $this->configuration);
        return $this->view->render();
    }
}
