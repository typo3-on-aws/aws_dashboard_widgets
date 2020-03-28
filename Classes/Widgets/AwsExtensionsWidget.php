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
use TYPO3\CMS\Dashboard\Widgets\AbstractListWidget;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * The AwsExtensionsWidget class lists all extensions currently installed in the
 * system (active and inactive). Extension key starts with "aws_".
 */
class AwsExtensionsWidget extends AbstractListWidget
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
     * @var int
     */
    protected $height = 6;
    protected $width = 4;

    /**
     * @var string
     */
    protected $link = 'https://github.com/typo3-on-aws/';

    /**
     * @var string
     */
    protected $label = self::LANGUAGE_FILE . ':widgets.aws_extensions.label';

    /**
     * @var string
     */
    protected $icon = 'actions-git';

    /**
     * @var string
     */
    protected $title = self::LANGUAGE_FILE . ':widgets.aws_extensions.title';

    /**
     * @var string
     */
    protected $description = self::LANGUAGE_FILE . ':widgets.aws_extensions.description';

    /**
     * @var string
     */
    protected $templateName = 'AwsExtensions';

    /**
     * @var array
     */
    public $items = [];

    /**
     * Initialize view
     *
     * @access protected
     * @return void
     */
    protected function initializeView(): void
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setTemplate('Widget/' . $this->templateName);
        $this->view->getRenderingContext()->getTemplatePaths()->fillDefaultsByPackageName($this->extensionKey);
    }

    /**
     * Render widget content
     *
     * @access public
     * @return string
     */
    public function renderWidgetContent(): string
    {
        $this->view->assign('title', $this->getTitle());
        $this->view->assign('description', $this->getDescription());
        $this->view->assign('items', $this->getLoadedAwsExtensions());
        $this->view->assign('link', $this->getLink());
        $this->view->assign('label', $this->getLabel());
        $this->view->assign('icon', $this->getIcon());
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

    /**
     * Get link
     *
     * @access public
     * @return string
     */
    public function getLink(): string
    {
        return $this->getLanguageService()->sL($this->link) ?: $this->description;
    }

    /**
     * Get label
     *
     * @access public
     * @return string
     */
    public function getLabel(): string
    {
        return $this->getLanguageService()->sL($this->label) ?: $this->label;
    }

    /**
     * Get icon
     * @link https://typo3.github.io/TYPO3.Icons/
     *
     * @access public
     * @return string
     */
    public function getIcon(): string
    {
        return $this->getLanguageService()->sL($this->icon) ?: $this->icon;
    }
}
