<?php
namespace Modules\Blocks\Repositories;
use Core\AbstractBaseRepository;
use Modules\Blocks\Entities\Block;
use DB;

/**
 * Class BlocksRepository
 * @author HieuND
 * @access public
 * @package Modules\Blocks\Repositories
 * @see __construct()
 * @see
 */
class BlocksRepository extends AbstractBaseRepository implements BlockInterface {
    /**
     * BlocksRepository constructor.
     * @author HieuND
     * @access public
     * @param Block $model
     */
    public function __construct(Block $model) {
        parent::__construct($model);
    }

    /**
     * Lấy tất cả dữ liệu trong table blocks với điều kiện delete_at = null và sắp xếp giảm dần theo id
     * @author HieuND
     * @access public
     * @return mixed
     * @throws \Core\RepositoryException
     */
    public function getAllBlockData() {
        return $this->orderBy('id', 'desc')->findAllByCredentials(['deleted_at' => null]);
    }

    /**
     *Lấy tất cả dữ liệu trong table blocks
     * @author HieuND
     * @access public
     * @return \Illuminate\Support\Collection
     */
    public function getBlock() {
        return $this->findAll();
    }

    /**
     * Lấy dữ liệu theo id
     * @author HieuND
     * @access public
     * @param $id
     * @return mixed
     */
    public function getDataByBlockId($id) {
        return $this->findOneById($id);
    }

    /**
     * Insert dữ liệu vào trong DB, create() trả về trạng thái true-false
     * @author HieuND
     * @access public
     * @param $input
     * @return mixed
     */
    public function insertBlockData($input) {
        return Block::create($input);
    }

    /**
     * Update dữ liệu
     * @author HieuND
     * @access public
     * @param $data
     * @throws \Core\RepositoryException
     * @return data update
     */
    public function updateBlockData($data) {
        return $this->updateOneById($data['id'],
            [
                'block_name' => $data['block_name'],
                'block_note' => $data['block_note'],
                'block_email' => $data['block_email']
            ]
        );
    }

    public function countExistBlock($blockName, $id) {
        $countExistBlock = DB::table('blocks')->select(DB::raw('count(*) count'))
            ->where('block_name', '=', $blockName)
            ->whereNull('deleted_at');
        if (!empty($id)) {
            $countExistBlock->where('id', '<>', $id);
        }
        return $countExistBlock->get();
    }

    public function countExistEmail($email, $id) {
        $countExistEmail = DB::table('blocks')->select(DB::raw('count(*) count'))
            ->where('block_email', '=', $email)
            ->whereNull('deleted_at');
        if (!empty($id)) {
            $countExistEmail->where('id', '<>', $id);
        }
        return $countExistEmail->get();
    }
}