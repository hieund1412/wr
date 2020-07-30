<?php

namespace Modules\Statistic\Repositories;

use Core\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Statistic\Model\Statistic;

class StatisticRepository extends AbstractBaseRepository implements StatisticInterface
{

    public function __construct(Statistic $model)
    {
        parent::__construct($model);
    }

    public function getStatisticByUser($start_date, $end_date, $block, $department, $userLogin) {
        $statisticByListUser = DB::table('working_report')
            ->select('working_report.work_date',
                'job.job_type',
                'working_report.execute_time',
                'us.user_login',
                'us.fullname',
                'bl.block_name as block_name',
                're_bl.block_name as relate_block',
                'dpm.department_name')
            ->join('users AS us', 'working_report.user_login', '=',  'us.user_login')
            ->join('departments AS dpm', 'us.department_id', '=',  'dpm.id')
            ->join('blocks AS bl', 'us.block_id', '=',  'bl.id')
            ->join('blocks AS re_bl', 'working_report.relate_block', '=',  're_bl.id')
            ->join('jobs AS job', 'working_report.work_type', '=',  'job.id')
            ->whereBetween('working_report.work_date', [$start_date, $end_date])
            ->where('bl.id', $block)
            ->where('dpm.id', $department)
            ->where('us.user_login', $userLogin)
            ->get();
        return $statisticByListUser;
    }

    public function getStatisticChartByCondition($start_date, $end_date, $block, $department, $userLogin, $statisticChartKey = 'job_type') {
        $countChartKey = !empty($statisticChartKey) ? 'COUNT(wr.' . $statisticChartKey . ') as count' : '"" as count';
        $groupByKey = !empty($statisticChartKey) ? 'GROUP BY wr.' . $statisticChartKey : '';
        $statisticChartByKey = DB::table('working_report')
            ->select(DB::raw('count(*) as count, '.$statisticChartKey))
            ->join('users AS us', 'working_report.user_login', '=',  'us.user_login')
            ->join('departments AS dpm', 'us.department_id', '=',  'dpm.id')
            ->join('blocks AS bl', 'us.block_id', '=',  'bl.id')
            ->join('blocks AS re_bl', 'working_report.relate_block', '=',  're_bl.id')
            ->join('jobs AS job', 'working_report.work_type', '=',  'job.id')
            ->join('projects AS prj', 'working_report.project_id', '=',  'prj.id')
            ->whereBetween('working_report.work_date', [$start_date, $end_date])
            ->where('bl.id', $block)
            ->where('dpm.id', $department)
            ->where('us.user_login', $userLogin)
            ->whereNull('working_report.deleted_at')
            ->groupBy($statisticChartKey)
            ->get();
        return $statisticChartByKey;
    }
}