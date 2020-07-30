<?php

namespace Modules\ProjectBlocks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\ProjectBlocks\Services\ProjectBlocksService;

/**
 * @author HieuV
 * @AnnotatedDescription(allow=true,desc="Quản lý dự án theo khối")
 */
class ProjectBlocksController extends Controller
{
    protected $projectBlockService;
    public function __construct(ProjectBlocksService $projectBlocksService) {
        $this->projectBlockService = $projectBlocksService;
    }

    /**
     * @author HieuV
     * @return array
     * @AnnotatedDescription(allow=true,desc="Quản lý dự án theo khối")
     */
    public function index() {
        $data = $this->projectBlockService->getAll();
        $block_name = $this->projectBlockService->getBlockName();
        $block = $this->projectBlockService->findAllBlock();
        $project = $this->projectBlockService->findAllProject();
        return view('projectblocks::index',compact('data', 'block','project','block_name'));
    }

    /**
     * @author HieuV
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @AnnotatedDescription(allow=true,desc="Thêm mới dự án theo khối")
     */
    public function store(Request $request) {
        $input = $request->all();
        $this->projectBlockService->createAndUpdateProjectBlock($input);
        return redirect()->route('projectblock.index');
    }

    /**
     * @author HieuV
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa dự án theo khối")
     */
    public function update(Request $request) {
        $input = $request->all();
        $this->projectBlockService->createAndUpdateProjectBlock($input);
        return redirect()->route('projectblock.index');
    }

    /**
     * @author HieuV
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @AnnotatedDescription(allow=true,desc="Xóa dự án theo khối")
     */
    public function destroy($id) {
        $this->projectBlockService->deleteOneById($id);
        return redirect()->route('projectblock.index');
    }

    /**
     * @author HieuV
     * @return array
     * trả dữ liệu sau khi search
     */
    public function ajaxGetProjectBlock() {
        $blockName = Input::get('block_name_search');
        $projectName = Input::get('project_name_search');
        $data = $this->projectBlockService->ajaxGetAll($blockName, $projectName);
        return view('projectblocks::ajax-table-projectblocks', compact('data'));
    }

    public function ajaxCheckDuplicatePjB() {
        $projectIdAdd = Input::get('project_name_add');
        $projectNameEdit = Input::get('project_name_edit');
        $id = Input::get('id_check');
        list($status, $message) = $this->projectBlockService->checkDuplicatePjB($projectIdAdd, $projectNameEdit, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
