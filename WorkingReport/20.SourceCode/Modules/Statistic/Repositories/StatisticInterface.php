<?php

namespace Modules\Statistic\Repositories;

use Core\RepositoryInterface;
use DB;

interface StatisticInterface extends RepositoryInterface
{
    public function getStatisticByUser($start_date, $end_date, $block, $department, $fullName);
    public function getStatisticChartByCondition($start_date, $end_date, $block, $department, $fullName, $statisticChartKey = '');


}