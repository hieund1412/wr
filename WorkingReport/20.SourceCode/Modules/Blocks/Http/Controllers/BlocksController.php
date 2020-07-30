<?php
namespace Modules\Blocks\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Blocks\Services\BlocksServices;

/**
 * Class BlocksController
 * @AnnotatedDescription(allow=true,desc="Quản lý khối")
 * @author HieuND
 * @access public
 * @package Modules\Blocks\Http\Controllers
 * @see __construct()
 * @see index()
 * @see processInsertBlock()
 * @see processUpdateBlock()
 * @see processDeleteBlock()
 */
class BlocksController extends Controller {
    private $_blocksService;

    /**
     * BlocksController constructor.
     * @author HieuND
     * @access public
     * @param BlocksServices $blocksService
     */
    public function __construct(BlocksServices $blocksService) {
        $this->_blocksService = $blocksService;
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Quản lý khối")
     * @author HieuND
     * @access public
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $blockData = $this->_blocksService->getAllDataBlock();
        return view('blocks::index', compact('blockData'));
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Thêm mới khối")
     * @author HieuND
     * @access public
     * @return array
     */
    public function processInsertBlock(Request $request) {
        $aryInsertBlock = $request->all();
        $this->_blocksService->insertBlock($aryInsertBlock);
        return redirect()->route('block.index');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa khối")
     * @author HieuND
     * @access public
     * @return array
     */
    public function processUpdateBlock(Request $request) {
       $aryUpdateBlock = $request->all();
       $this->_blocksService->updateBlock($aryUpdateBlock);
       return redirect()->route('block.index');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Xóa một khối")
     * @author HieuND
     * @access public
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDeleteBlock($id) {
        $this->_blocksService->deleteBlock($id);
        return redirect()->route('block.index');
    }

    /**
     * @author HieuV
     * @access public
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckDuplicateBlock() {
        $id = Input::get('id_check');
        $blockNameAdd = Input::get('block_name_add');
        $emailAdd = Input::get('email_add');
        $blockNameEdit = Input::get('block_name_edit');
        $emailEdit = Input::get('email_edit');
        list($status, $message) = $this->_blocksService->checkDuplicateBlock($blockNameAdd, $emailAdd, $blockNameEdit, $emailEdit, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
