<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Modules\Projects\Entities\Project;
use Modules\Projects\Providers\ProjectsServiceProvider;
use Modules\Projects\Repositories\ProjectInterface;
use Modules\Projects\Services\ProjectServices;

/**
 * @AnnotatedDescription(allow=true,desc="Quản lý dự án")
 */
class ProjectsController extends Controller
{
    protected $projectService;
    public function __construct(ProjectServices $projectsService)
    {
        $this->projectService = $projectsService;

    }
    /**
     * @AnnotatedDescription(allow=true,desc="Quản lý dự án")
     */
    public function index() {
        $corporation_name = $this->projectService->getCprName();
        $data = $this->projectService->getAllForIndex();
        return view('projects::index',compact('data', 'corporation_name'));
    }

     /**
     * @AnnotatedDescription(allow=true,desc="Thêm mới dự án")
     */

    public function store(Request $request) {
        $input = $request->all();
        list($status, $message) = $this->projectService->insertAndUpdatePj($input);
        return back()->with($status, $message);
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa dự án")
     */

    public function update(Request $request) {
        $input = $request->all();
        list($status, $message) = $this->projectService->insertAndUpdatePj($input);
        return back()->with($status, $message);
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Xóa dự án")
     */
    public function destroy($id) {
        //
        $this->projectService->deleteOneById($id);
        return redirect()->route('projects.list');
    }

    /**
     * Dùng để hiển thị data khi bấm search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxGetProjects() {
        $corporation_name = Input::get('corporation_name_search');
        $projectName = Input::get('project_name_search');
        $data = $this->projectService->ajaxGetAll($corporation_name, $projectName);
        return view('projects::ajax-table-projects', compact('data'));
    }

    public function ajaxCheckDuplicate() {
        $projectNameAdd = Input::get('project_name_add');
        $projectNameEdit = Input::get('project_name_edit');
        $id = Input::get('id_check');
        list($status, $message) = $this->projectService->checkDuplicateProject($projectNameAdd, $projectNameEdit, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
