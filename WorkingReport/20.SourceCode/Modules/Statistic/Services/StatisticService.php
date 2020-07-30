<?php

namespace Modules\Statistic\Services;

use Carbon\Carbon;
use Modules\Auth\Entities\User;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Departments\Entities\Department;
use Modules\Statistic\Repositories\StatisticInterface;

class StatisticService
{
    protected $block;
    protected $statistic;
    public function __construct(BlockInterface $block_repository, StatisticInterface $statistic_repository) {
        $this->block = $block_repository;
        $this->statistic = $statistic_repository;
    }

    public function getBlock(){
        $block = $this->block->getBlock();
        return $block;
    }

    public function dataFromSearch($block_id, $department_id) {
        if ($department_id == null) {
            $data = Department::where('block_id', $block_id)->whereNull('deleted_at')->get();
        } else {
            $data = User::where('block_id', $block_id)->where('department_id', $department_id)->whereNull('deleted_at')->get();
        }
        return $data;
    }

    /**
     * create header date for display
     */
    public function createHeaderDate($start_date, $end_date, $sourceFormat, $targetformat) {
        $arrDateByProject = [];
        $from_date_carbon = Carbon::createFromFormat($sourceFormat, $start_date);
        $to_date_carbon = Carbon::createFromFormat($sourceFormat, $end_date);
        for ($i = $from_date_carbon; $i <= $to_date_carbon; $i->addDay()) {
            array_push($arrDateByProject, $i->format($targetformat));
        }
        return $arrDateByProject;
    }

    public function searchEmployeeData($start_date, $end_date, $block, $department, $fullname){
        $employeeData = [];
        $statisticByListUser = $this->statistic->getStatisticByUser($start_date, $end_date, $block, $department, $fullname);
        $indexDataDisplay = 0;
        $arrDateByUser = $this->createHeaderDate($start_date, $end_date, 'Y-m-d','Ymd');
        foreach ($statisticByListUser as $data_row) {
            $indexDataDisplay++;
            $rowKey = $data_row->fullname.$data_row->department_name.$data_row->job_type;
            $data_show = $data_row;
            $totalTimeByUser = $data_row->execute_time;
            $arr_time = array_fill(0, count($arrDateByUser), 0);
            if (count($employeeData) > 0 && isset($employeeData[$rowKey])) {
                $data_show = $employeeData[$rowKey];
                if (isset($data_show) && $data_row->fullname == $data_show->fullname
                    && $data_row->department_name == $data_show->department_name
                    && $data_row->job_type == $data_show->job_type) {
                    $indexDataDisplay--;
                    $arr_time = $data_show->execute_time;
                    $sum_value = array_sum($arr_time);
                    $totalTimeByUser += $sum_value;
                }
            }
            $data_show->row = $indexDataDisplay;
            $index = $this->_getIndexInArray($arrDateByUser, date('Ymd', strtotime($data_row->work_date)));
            $arr_time[$index] += $data_row->execute_time;
            $data_show->execute_time = $arr_time;
            $data_show->total = $totalTimeByUser;
            $employeeData[$rowKey] = $data_show;
        }
        $arr_result = $this->getTotalCol($arrDateByUser, $employeeData);
        $totalRecord = $this->createTotalRow($arr_result);
        array_push($employeeData, $totalRecord);
        return $employeeData;
    }

    public function countByWork_content($start_date, $end_date, $block, $department, $fullName, $statisticChartKey) {
        $dataFromDB = $this->statistic->getStatisticChartByCondition($start_date, $end_date, $block, $department, $fullName, $statisticChartKey);
        return $dataFromDB;
    }

    private function _getIndexInArray($array, $date) {
        foreach ($array As $key => $value) {
            if ($value == $date) {
                return $key;
            }
        }
        return -1;
    }

    private function getTotalCol($arr_date, $data) {
        $arr_result = array_fill(0, count($arr_date), 0);
        foreach ($arr_date as $date => $value) {
            $total = 0;
            foreach ($data as $data_row) {
                $total += $data_row->execute_time[$date];
            }
            $arr_result[$date] = $total;
        }
        return $arr_result;
    }

    private function createTotalRow($arr_result){
        $totalRecord = (object)[
            'row'=>'',
            'fullname'=>'Tổng',
            'total' => array_sum($arr_result),
            'department_name'=>'',
            'job_type'=>'',
            'execute_time'=>$arr_result
        ];
        return $totalRecord;
    }
}