<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\oddVisits;

use Piwik\ArchiveProcessor;
use Piwik\Common;
use Piwik\Menu\MenuMain;
use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\CoreVisualizations\Visualizations\HtmlTable\AllColumns;
use Piwik\Plugins\CoreVisualizations\Visualizations\HtmlTable;
use Piwik\Plugins\CoreVisualizations\Visualizations\JqplotGraph\Pie;
use Piwik\SettingsPiwik;
use Piwik\WidgetsList;

/**
 */
class oddVisits extends \Piwik\Plugin
{
    /**
     * @see Piwik\Plugin::getListHooksRegistered
     */
    public function getListHooksRegistered()
    {
        return array(
            'AssetManager.getJavaScriptFiles' => 'getJsFiles',
            'WidgetsList.addWidgets'          => 'addWidgets',
            'Menu.Reporting.addItems'         => 'addMenus'
        );
    }

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = 'plugins/oddVisits/javascripts/plugin.js';
    }
    
    public function addMenus()
    {
        MenuMain::getInstance()->add(
                $category = 'General_Visitors',  
                $title = 'Even/Uneven times',
                $urlParams = array('module' => $this->getPluginName(), 'action' => 'index')
        );
    }
    
    function addWidgets()
    {
        WidgetsList::add('General_Visitors', 'Even/Uneven times', 'oddVisits', 'getLastVisitsByBrowser');
    }
}
