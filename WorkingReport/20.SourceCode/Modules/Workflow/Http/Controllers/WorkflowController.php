<?php

namespace Modules\Workflow\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Workflow\Services\WorkflowService;

/**
 * @AnnotatedDescription(allow=true,desc="Quản lý báo cáo theo ngày")
 */
class WorkflowController extends Controller
{
    private $workflowService;

    public function __construct(WorkflowService $workflowService)
    {
        $this->workflowService = $workflowService;
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Quản lý báo cáo theo ngày")
     */
    public function index()
    {
       // $data = $this->workflowService->getWorkflow();
        $user = $this->workflowService->getUser();
        $block = $this->workflowService->getBlock();
        $department = $this->workflowService->getDepartment();
        $project = $this->workflowService->getProject();
        $job = $this->workflowService->getJob();
        return view('workflow::viewWorkflow',compact( 'block','user','department','project','job'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Lấy dữ liệu tìm kiếm từ input")
     * @return mixed
     */
    public function getDataSearch()
    {
        $type = Input::get('type');
        $block_id = Input::get('block_id');
        $department_id = Input::get('department_id');
        $data = $this->workflowService->searchDataByWorkflow($type, $block_id, $department_id);
        return $data->toArray();
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Tìm kiếm báo cáo theo ngày ")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $block = $this->workflowService->getBlock();
        $project = $this->workflowService->getProject();
        $job = $this->workflowService->getJob();
        $from_date = Carbon::createFromFormat('d/m/Y', Input::get('from_date'))->format('Y-m-d');
        $to_date = Carbon::createFromFormat('d/m/Y', Input::get('to_date'))->format('Y-m-d');
        $block_id = Input::get('block');
        $department = Input::get('department');
        $userSearch = Input::get('fullname');
        $progress = Input::get('progress');
        $late = Input::get('late');
        $data = $this->workflowService->searchBy($userSearch, $from_date, $to_date, $block_id, $department, $progress, $late);
        return view('workflow::tableWorkflow', compact('data', 'block', 'project', 'job'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa bản ghi")
     * @param Request $request
     * @return $this
     */
    public function editDataRow(Request $request)
    {
        $input = $request->all();
        $data = $this->workflowService->update($input);
        if($data) {
            return response()->json(['status' => true]); 
        }
        return response()->json(['status' => false]);
    }
}
