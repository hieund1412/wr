<?php

namespace Modules\StatiscalProject\Services;

use Carbon\Carbon;
use DB;
use Faker\Provider\DateTime;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Jobs\Repositories\JobsInterface;
use Modules\Projects\Repositories\ProjectInterface;
use Modules\Report\Repositories\ReportInterface;
use Modules\StatiscalProject\Repositories\StatiscalProjectInterface;
use Modules\Users\Repositories\UsersInterface;

class StatiscalProjectService
{
    private $project;
    private $job;
    private $block;
    private $user;
    private $report;
    private $staPjProcess;

    public function __construct(
        ProjectInterface $project,
        JobsInterface $job,
        BlockInterface $block,
        UsersInterface $user,
        ReportInterface $report,
        StatiscalProjectInterface $staPjProcess

    )
    {
        $this->project = $project;
        $this->job = $job;
        $this->block =$block;
        $this->user = $user;
        $this->report = $report;
        $this->staPjProcess = $staPjProcess;

    }

    /**
     * create header date for display
     */
    public function createHeaderDate($from_date, $to_date, $sourceFormat, $targetformat) {
        $arrDateByProject = [];
        $from_date_carbon = Carbon::createFromFormat($sourceFormat, $from_date);
        $to_date_carbon = Carbon::createFromFormat($sourceFormat, $to_date);
        for ($i = $from_date_carbon; $i <= $to_date_carbon; $i->addDay()) {
            array_push($arrDateByProject, $i->format($targetformat));
        }
        return $arrDateByProject;
    }

    public function searchByProject($from_date,$to_date,$block_name,$relate_block,$project_name) {
        $ProjectData = [];
        $ListOfProject = $this->staPjProcess->getStatisticByProject($from_date,$to_date,$block_name,$relate_block,$project_name);
        $indexDataDisplay = 0;
        $arrDateByProject = $this->createHeaderDate($from_date, $to_date, 'Y-m-d', 'Ymd');
        foreach ($ListOfProject as $data_row) {
            $indexDataDisplay++;
            $rowKey = $data_row->project_name.$data_row->perform_block.$data_row->relate_block;
            $data_show = $data_row;
            $totalTimeByProject = $data_row->execute_time;
            
            $arr_time = array_fill(0, count($arrDateByProject), 0);
            if (count($ProjectData) > 0 && isset($ProjectData[$rowKey])) {
                $data_show = $ProjectData[$rowKey];
                if (isset($data_show) && $data_row->project_name == $data_show->project_name
                    && $data_row->perform_block == $data_show->perform_block
                    && $data_row->relate_block == $data_show->relate_block) {
                    $indexDataDisplay--;
                    $arr_time = $data_show->execute_time;
                    $sum_value = array_sum($arr_time);
                    $totalTimeByProject += $sum_value;
                }
            } 
            if (!isset ($data_show->row)) {
                $data_show->row = $indexDataDisplay;
            }
            $index = $this->_getIndexInArray($arrDateByProject, date('Ymd', strtotime($data_row->work_date)));
            $arr_time[$index] += $data_row->execute_time;
            $data_show->execute_time = $arr_time;
            $data_show->total = $totalTimeByProject;
            $ProjectData[$rowKey] = $data_show;
        }
        $arr_result = $this->getTotalCol($arrDateByProject, $ProjectData);
        $totalRecord = $this->createTotalRow($arr_result);

        array_push($ProjectData, $totalRecord);
        return $ProjectData;
    }

    public function createTotalRow($arr_result) {
        $totalRecord = (object)[
            'row'=>'',
            'project_name'=>'Tổng',
            'total' => array_sum($arr_result),
            'perform_block' => '',
            'relate_block' => '',
            'execute_time'=>$arr_result
        ];
        return $totalRecord;
    }

    private function _getIndexInArray($array, $date) {
        foreach ($array As $key => $value) {
            if ($value == $date) {
                return $key;
            }
        }
        return -1;
    }

    private function getTotalCol($arrDateByProject, $ProjectData) {
        $arr_result = array_fill(0, count($arrDateByProject), 0);
        foreach ($arrDateByProject as $date => $value) {
            $total = 0;
            foreach ($ProjectData as $data_row) {
                $total += $data_row->execute_time[$date];
            }
            $arr_result[$date] = $total;
        }
        return $arr_result;
    }

    public function chartByProject($from_date, $to_date, $block_name, $relate_block, $project_name, $chartKey) {
        $dataFromDB = $this->staPjProcess->getByChartCondition($from_date, $to_date, $block_name, $relate_block, $project_name, $chartKey);
        return $dataFromDB;
    }

    public function getProject(){
        $aryData = $this->project->getProject();
        return $aryData;
    }
    public function getJob() {
        $aryData =  $this->job->getJob();
        return $aryData;
    }
    public function getBlock() {
        $aryData = $this->block->getBlock();
        return $aryData;
    }
    public function getUser() {
        $aryData = $this->user->getUser();
        return $aryData;
    }
    public function getReport() {
        $aryData = $this->report->getReport();
        return $aryData;
    }
}
