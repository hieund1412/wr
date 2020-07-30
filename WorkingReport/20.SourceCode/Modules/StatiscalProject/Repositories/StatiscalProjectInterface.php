<?php

namespace Modules\StatiscalProject\Repositories;

use Core\RepositoryInterface;

interface StatiscalProjectInterface extends RepositoryInterface
{
    public function getStatisticByProject($from_date,$to_date,$block_name,$relate_block,$project_name);

    public function getData();

    public function getByChartCondition($from_date, $to_date, $block_name, $relate_block, $project_name, $chartKey);
}