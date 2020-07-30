<?php

namespace Modules\Jobs\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Jobs\Services\JobsService;

/**
 * @author HieuV
 * @access public
 * @package Modules\Jobs\Http\Controllers
 * @see __construct
 * @see index
 * @see store
 * @see update
 * @see destroy
 * @see ajaxGetJobs
 * @AnnotatedDescription(allow=true,desc="Quản lý loại công việc")
 */
class JobsController extends Controller
{
    protected $jobService;

    public function __construct(JobsService $jobsService) {
        $this ->jobService = $jobsService;
    }
    /**
     * @author HieuV
     * @access public
     * @AnnotatedDescription(allow=true,desc="Quản lý loại công việc")
     */
    public function index()
    {
        $data = $this->jobService->getAll();
        $block = $this->jobService->findAll();
        return view('jobs::index',compact('data','block'));
    }

    /**
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Thêm mới loại công việc")
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->jobService->createAndUpdateJob($input);
        return redirect()->route('jobs.index');
    }

    /**
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Sửa đổi loại công việc")
     */

    public function update(Request $request) {
        $input = $request->all();
        $this->jobService->createAndUpdateJob($input);
        return redirect()->route('jobs.index');
    }

    /**
     * @author HieuV
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @AnnotatedDescription(allow=true,desc="Xóa loại công việc")
     */
    public function destroy($id) {
        //
        $this->jobService->deleteOneById($id);
        return redirect()->route('jobs.index');
    }

    /**
     * @author HieuV
     * @access public
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxGetJobs() {
        $block_id = Input::get('block_name_search');
        $job_type = Input::get('job_type_search');
        $data = $this->jobService->ajaxGetAll($block_id, $job_type);
        return view('jobs::ajax-table-jobs', compact('data'));
    }


    /**
     * @author HieuV
     * @access public
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckDuplicateJob() {
        $id = Input::get('id_check');
        $blockIdAdd = Input::get('block_name_add');
        $jobTypeAdd = Input::get('job_type_add');
        $blockIdEdit = Input::get('block_name_edit');
        $jobTypeEdit = Input::get('job_type_edit');
        list($status, $message) = $this->jobService->checkDuplicateJob($blockIdAdd, $jobTypeAdd, $blockIdEdit, $jobTypeEdit, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
