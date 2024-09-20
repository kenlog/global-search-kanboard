<?php

namespace Kanboard\Plugin\GlobalSearch;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

/**
 * This file is part of the Kanboard GlobalSearch Plugin project.
 *
 *
 * @package     Kanboard GlobalSearch Plugin
 * @author      Valentino Pesce
 * @copyright   2024 (c) Valentino Pesce
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Plugin extends Base
{
    public function initialize()
    {
        // alternative hook "template:dashboard:show:after-filter-box"
        $this->template->hook->attach('template:layout:top', 'globalsearch:global_search/search_form');

        $this->route->addRoute('/global_search', 'GlobalSearchController', 'search', 'Globalsearch');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getClasses()
    {
        return [
            'Plugin\GlobalSearch\Controller' => [
                'GlobalSearchController',
            ],
        ];
    }

    public function getPluginName()
    {
        return t('Global search');
    }

    public function getPluginDescription()
    {
        return t('Adds a global search bar that searches through tasks, projects, and comments.');
    }

    public function getPluginAuthor()
    {
        return 'Valentino Pesce';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kenlog/global-search-kanboard';
    }
}
