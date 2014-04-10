<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\oddVisits;

use Piwik\API\Request;
use Piwik\Common;
use Piwik\DataTable\Map;
use Piwik\Metrics;
use Piwik\Period\Range;
use Piwik\Piwik;
use Piwik\Url;
use Piwik\View;
use Piwik\ViewDataTable\Factory;

/**
 *
 */
class Controller extends \Piwik\Plugin\Controller
{

    public function index()
    {
        $view = new View('@oddVisits/index.twig');
        $view->getLastVisitsByBrowserReport = $this->getLastVisitsByBrowser();
        return $view->render();
    }
    
    public function getLastVisitsByBrowser()
    {
       
        $view = Factory::build(
            $defaultVisualization = 'table',
            $apiAction = 'oddVisits.getLastVisitsByBrowser'
        );
        
        $view->config->show_table_all_columns = true;
        $view->config->show_goals = false;
        $view->config->translations['label'] = 'TIMES';

        return $view->render();
    }
}
