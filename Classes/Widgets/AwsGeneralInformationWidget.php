<?php
declare(strict_types=1);
namespace Typo3OnAws\AwsDashboardWidgets\Widgets;

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

use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Dashboard\Widgets\RequestAwareWidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;

class AwsGeneralInformationWidget implements WidgetInterface, RequestAwareWidgetInterface, AdditionalCssInterface
{
    protected ServerRequestInterface $request;

	public function __construct(
        protected readonly WidgetConfigurationInterface $configuration,
        protected readonly BackendViewFactory $backendViewFactory,
        protected readonly array $options = []
    ) {
    }

    public function renderWidgetContent(): string
    {
        $view = $this->backendViewFactory->create($this->request, ['typo3-on-aws/aws-dashboard-widgets']);
		$view->assignMultiple([
            'options' => $this->options
        ]);
		return $view->render('Widget/AwsGeneralInformationWidget');
    }

	public function setRequest(ServerRequestInterface $request): void
    {
        $this->request = $request;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

	public function getCssFiles(): array
	{
	   return [
		   'EXT:aws_dashboard_widgets/Resources/Public/Css/AwsGeneralInformationWidget.css'
	   ];
	}
}
