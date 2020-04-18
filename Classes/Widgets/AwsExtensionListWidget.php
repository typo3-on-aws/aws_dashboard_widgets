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

use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class AwsExtensionListWidget implements WidgetInterface
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
    private $templateName = 'AwsExtensionListWidget';

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

        $this->view->assign('items', $this->getLoadedAwsExtensions());
        //$this->view->assign('link', $this->getLink());
        //$this->view->assign('label', $this->getLabel());
        //$this->view->assign('icon', $this->getIcon());

        return $this->view->render();
    }

    /**
     * Fetches a list of all active (loaded) extensions in the current system
     *
     * @access protected
     * @return array
     */
    protected function getLoadedAwsExtensions(): array
    {
        $extensions = [];
        $packageManager = GeneralUtility::makeInstance(PackageManager::class);
        foreach ($packageManager->getAvailablePackages() as $package) {
            // Skip system extensions (= type: typo3-cms-framework)
            if ($package->getValueFromComposerManifest('type') !== 'typo3-cms-extension') {
                continue;
            }
            if (substr($package->getPackageKey(), 0, 4) == 'aws_') {
                $extensions[] = [
                    'extensionKey' => $package->getPackageKey(),
                    'title' => $this->convertExtensionKeyToTitle($package->getPackageKey()),
                    'description' => $package->getPackageMetaData()->getDescription(),
                    'version' => $package->getPackageMetaData()->getVersion(),
                    //'meta' => $package->getPackageMetaData(),
                    //'package' => $package,
                    'icon' => $this->getExtensionIcon($package->getPackageKey()),
                    'authors' => $package->getValueFromComposerManifest('authors'),
                    'homepage' => $package->getValueFromComposerManifest('homepage'),
                    'active' => ($this->isActive($package->getPackageKey()) ? true : false)
                ];
            }
        }
        return $extensions;
    }

    /**
     * Shortcut method to check if an extension is loaded
     *
     * @access protected
     * @param string $extensionKey
     * @return bool
     */
    protected function isActive(string $extensionKey): bool
    {
        return ExtensionManagementUtility::isLoaded($extensionKey);
    }

    /**
     * Converts an extension key to a human-readable title
     *
     * @access protected
     * @param string $extensionKey
     * @return string
     */
    protected function convertExtensionKeyToTitle(string $extensionKey): string
    {
        return preg_replace('/^Aws/', 'AWS', ucwords(str_replace('_', ' ', $extensionKey)));
    }

    /**
     * Returns the absolutely file system path to the Extension icon, if extension is loaded and an icon exists
     *
     * @access protected
     * @param string $extensionKey
     * @return string|null
     */
    protected function getExtensionIcon(string $extensionKey): ?string
    {
        if ($this->isActive($extensionKey) === false) {
            return null;
        }

        $path = ExtensionManagementUtility::extPath($extensionKey);
        foreach (['svg', 'png', 'gif'] as $fileExtension) {
            $iconFile = $path . 'Resources/Public/Icons/Extension.' . $fileExtension;
            if (is_readable($iconFile)) {
                return 'EXT:' . $extensionKey . '/Resources/Public/Icons/Extension.' . $fileExtension;
            }
        }
        return null;
    }
}
