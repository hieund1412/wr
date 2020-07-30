<?php

namespace Modules\Statistic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Modules\Auth\Entities\User;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Departments\Entities\Department;
use Modules\Statistic\Repositories\StatisticInterface;
use Modules\Statistic\Services\StatisticService;

/**
 * @AnnotatedDescription(allow=true,desc="Thống kê theo nhân viên")
 */
class StatisticController extends Controller
{
    private $WORK_CONTENT_KEY = 'job.job_type';
    private $PROJECT_KEY = 'prj.project_name';
    private $RELATE_BLOCK_KEY = 're_bl.block_name';
    protected $statistic_service;
    public function __construct(StatisticService $statistic_service)
    {
        $this->statistic_service = $statistic_service;
    }
    /**
     * @AnnotatedDescription(allow=true,desc="Thống kê theo nhân viên")
     */
    public function statisticByEmployees() {
        $block = $this->statistic_service->getBlock();
        return view('statistic::statistic_employees',compact('block'));
    }

    public function getAjaxData() {
        $block_id = Input::get('block_id');
        $department_id = Input::get('department_id');
        $data = $this->statistic_service->dataFromSearch($block_id, $department_id);
        return $data->toArray();

    }

    public function searchData() {
        $start_date = Carbon::createFromFormat('d/m/Y', Input::get('start_date'))->format('Y-m-d');
        $end_date = Carbon::createFromFormat('d/m/Y', Input::get('end_date'))->format('Y-m-d');
        $block = Input::get('block');
        $department = Input::get('department');
        $fullname = Input::get('fullname');
        $headerDate = $this->statistic_service->createHeaderDate($start_date, $end_date, 'Y-m-d','d-m');
        $data = $this->statistic_service->searchEmployeeData($start_date, $end_date, $block, $department, $fullname);
        $workContentChart = $this->statistic_service->countByWork_content($start_date, $end_date, $block, $department, $fullname, $this->WORK_CONTENT_KEY);
        $projectChart = $this->statistic_service->countByWork_content($start_date, $end_date, $block, $department, $fullname, $this->PROJECT_KEY);
        $relateBlockChart = $this->statistic_service->countByWork_content($start_date, $end_date, $block, $department, $fullname, $this->RELATE_BLOCK_KEY);
        return view('statistic::statistic_data',compact('data', 'headerDate', 'start_date', 'end_date', 'block', 'department', 'fullname',
        'workContentChart', 'projectChart', 'relateBlockChart'));
    }
}
