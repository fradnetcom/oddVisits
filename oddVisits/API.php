<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\oddVisits;

use Exception;
use Piwik\API\ResponseBuilder;
use Piwik\Archive;
use Piwik\Common;
use Piwik\DataTable\Row;
use Piwik\DataTable;
use Piwik\Date;
use Piwik\Metrics;
use Piwik\Piwik;


class API extends \Piwik\Plugin\API
{
    public function getLastVisitsByBrowser($idSite, $period, $date, $segment = false)
    {
        $data = \Piwik\Plugins\Live\API::getInstance()->getLastVisitsDetails(
            $idSite,
            $period,
            $date,
            $segment,
            ''    
        );        
        $result = $data->getEmptyClone($keepFilters = false); 
        
        $even = 0;
        $uneven = 0;

        foreach ($data->getRows() as $visitRow) {
            $visit_first_action_time = $visitRow->getColumn('visit_first_action_time');
            $hour = date('H', strtotime($visit_first_action_time));  
            
            if( $hour % 2 ){
                $even++;
            }else{
                $uneven++;
            }
        }
        
        $result->addRowFromSimpleArray(array(
                    'label' => 'even',
                    'VISITS' => $even
                ));
        $result->addRowFromSimpleArray(array(
            'label' => 'uneven',
            'VISITS' => $uneven
        ));

        return $result;
    }
}
