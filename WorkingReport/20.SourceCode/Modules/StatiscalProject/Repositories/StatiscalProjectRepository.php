<?php

namespace Modules\StatiscalProject\Repositories;

use Core\AbstractBaseRepository;
use DB;
use Modules\StatiscalProject\Entities\StatiscalProject;

class StatiscalProjectRepository extends AbstractBaseRepository implements StatiscalProjectInterface
{

    public function __construct(StatiscalProject $model) {
        parent::__construct($model);
    }

    public function getStatisticByProject($from_date,$to_date,$block_name,$relate_block,$project_name) {

        $sql = "SELECT
                    wr.work_date,
                    wr.execute_time,
                    wr.id,
                    pj.project_name,
                    bl.block_name as perform_block,
                    re_bl.block_name as relate_block
                FROM
                    `working_report` AS wr
                    INNER JOIN projects AS pj ON pj.id = wr.project_id
                    INNER JOIN users AS us ON wr.user_login = us.user_login
                    INNER JOIN blocks AS bl ON us.block_id = bl.id
                    INNER JOIN blocks AS re_bl ON wr.relate_block = re_bl.id";
        
        $sql .= ' WHERE bl.block_name =' ."'$block_name'";
        $sql .= ' AND wr.deleted_at IS NULL';
        if (!empty($from_date)&& !empty($to_date)) {
            $sql .= ' AND DATE(wr.work_date) BETWEEN ' . "'$from_date'" . ' AND ' . "'$to_date'";
        }
        if (!empty($relate_block)) {
            $sql .= ' AND re_bl.block_name = ' . "'$relate_block'";
        }
        if (!empty($project_name)) {
            $str_project_name = '(';
            foreach ($project_name as $item) {
                $str_project_name .= $item . ',';
            }
            $str_project_name = substr($str_project_name, 0, -1) . ')';
            $sql .= ' AND pj.id IN' . $str_project_name;
        }
        $sql .= ' ORDER BY pj.project_name ASC, wr.work_date ASC';
        return DB::select(DB::raw($sql));
    }

    public function getData() {
        $aryData = 'SELECT wk.id
              , wk.project_id
              , wk.relate_block
              , wk.user_login
              , wk.execute_time
              , pj.project_name
              , users.user_login
              , wk.work_date
              , Perform.block_name perform_block
              , Perform.id per_id
			  , Relate.block_name relation_block
			  , Relate.id re_id
              FROM working_report wk
              INNER JOIN `projects` pj ON wk.project_id = pj.id
              INNER JOIN users ON wk.user_login = users.user_login 
              INNER JOIN blocks Perform ON users.block_id = Perform.id  
			  INNER JOIN blocks Relate ON wk.relate_block = Relate.id ';
        return DB::select(DB::raw($aryData));
    }

    public function getByChartCondition($from_date, $to_date, $block_name, $relate_block, $project_name, $chartKey) {
        if ($chartKey == 'project_name') {
            $finalKey = 'pj.project_name';
        }
        if ($chartKey == 'relate_block') {
            $finalKey = 're_bl.block_name';
        }
        if ($chartKey == 'corporation_name') {
            $finalKey = 'pj.corporation_name';
        }
        if (!empty($project_name)) {
            $str_project_name = '(';
            foreach ($project_name as $item) {
                $str_project_name .= $item . ',';
            }
            $str_project_name = substr($str_project_name, 0,-1) . ')';
        }
        $statisticChartByKey = 'SELECT
                count(*) as count, '.$finalKey.' 
                FROM
                `working_report` AS wr
                INNER JOIN projects AS pj ON pj.id = wr.project_id
                INNER JOIN users AS us ON wr.user_login = us.user_login
                INNER JOIN blocks AS bl ON us.block_id = bl.id
                INNER JOIN blocks AS re_bl ON wr.relate_block = re_bl.id
                WHERE DATE(wr.work_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'"
                AND wr.deleted_at IS NULL
                AND bl.block_name = "'.$block_name.'" ';
        if (!empty($relate_block)) {
            $statisticChartByKey .= 'AND  re_bl.block_name = "'.$relate_block.'" ';
        }
        if (!empty($str_project_name)) {
            $statisticChartByKey .= 'AND pj.id IN '.$str_project_name;
        }
        $statisticChartByKey .= ' GROUP BY '.$finalKey;
        return DB::select(DB::raw($statisticChartByKey));
    }
}