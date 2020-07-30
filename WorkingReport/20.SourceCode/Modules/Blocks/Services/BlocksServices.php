<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2019
 * Time: 2:21 PM
 */
namespace Modules\Blocks\Services;
use Modules\Blocks\Repositories\BlockInterface;

/**
 * Class BlocksServices
 * Xử lý logic của Module Blocks
 * @author HieuND
 * @access public
 * @package Modules\Blocks\Services
 * @see __construct()
 * @see getAllDataBlock()
 * @see insertBlock()
 * @see updateBlock()
 * @see deleteBlock()
 */
class BlocksServices {
    private $_blockService;

    /**
     * BlocksServices constructor.
     * @author HieuND
     * @access public
     * @param BlockInterface $blockInterface
     */
    public function __construct(BlockInterface $blockInterface) {
        $this->_blockService = $blockInterface;
    }

    /**
     * Lấy tất cả bản ghi trong table blocks
     * @author HieuND
     * @access public
     * @return mixed
     */
    public function getAllDataBlock() {
        return $this->_blockService->getAllBlockData();
    }

    /**
     * @author HieuND
     * @access public
     * @return mixed
     */
    public function getBlock() {
        return $this->_blockService->getBlock();
    }

    /**
     * Kiểm tra dữ liệu trong DB thực hiện insert
     * @author HieuND
     * @access public
     * @param $input
     * @return boolean
     */
    public function insertBlock($input) {
        $checkDuplicateBlockName = $this->_blockService->findOneBy('block_name', $input['block_name']);
        $checkDuplicateBlockEmail = $this->_blockService->findOneBy('block_email', $input['block_email']);
        if (!empty($checkDuplicateBlockName)) {
            return back()->with('error', 'Khối đã tồn tại');
        }
        if (!empty($checkDuplicateBlockEmail)) {
            return back()->with('error', 'Địa chỉ mail đã tồn tại');
        }
        $isSuccess = $this->_blockService->insertBlockData($input);
        if ($isSuccess) {
            return back()->with('success', 'Thêm mới khối thành công');
        } else {
            return back()->with('error', 'Thêm mới khối thất bại');
        }
    }

    /**
     * Kiểm tra dữ liệu trong DB thực hiện update
     * @author HieuND
     * @access public
     * @param $data
     * @return boolean
     */
    public function updateBlock($data) {
        if (!empty($input['id'])) {
            return $this->_blockService->updateBlockData($data);
        } else {
            return $this->_blockService->create($data);
        }
    }

    /**
     * Xóa dữ liệu
     * @author HieuND
     * @access public
     * @param $id
     * @return bool
     */
    public function deleteBlock($id) {
        $isSuccess = $this->_blockService->deleteOneById($id);
        if ($isSuccess) {
            return back()->with('success', 'Xóa khối thành công');
        } else {
            return back()->with('error', 'Xóa khối thất bại');
        }
    }

    public function checkDuplicateBlock($blockNameAdd, $emailAdd, $blockNameEdit, $emailEdit, $id) {
        $email = $emailAdd;
        if (!empty($emailEdit)) {
            $email = $emailEdit;
        }
        $block_name = $blockNameAdd;
        if (!empty($blockNameEdit)) {
            $block_name = $blockNameEdit;
        }
        $countExistBlock = $this->_blockService->countExistBlock($block_name, $id);
        $countExistEmail = $this->_blockService->countExistEmail($email, $id);
        $status = 'error';
        $message = 'Không được trùng tên khối hoặc email';
        if ($countExistBlock[0]->count == 0 && !$countExistEmail[0]->count == 0) {
            $message = 'Không được trùng tên email';
        }
        if (!$countExistBlock[0]->count == 0 && $countExistEmail[0]->count == 0) {
            $message = 'Không được trùng tên khối';
        }
        if ($countExistBlock[0]->count == 0 && $countExistEmail[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}