<?php

namespace Modules\ProjectBlocks\Repositories;

use Core\AbstractBaseRepository;
use DB;
use Modules\ProjectBlocks\Entities\ProjectBlock;

class ProjectBlocksRepository extends AbstractBaseRepository implements ProjectBlocksInterface
{

    public function __construct(ProjectBlock $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        $data = ProjectBlock::query()->join('projects', 'project_block.project_id', '=','projects.id')
            ->join('blocks','project_block.block_id','=','blocks.id')
            ->select('project_block.*', 'projects.project_name','projects.corporation_name', 'projects.project_note', 'blocks.block_name')
            ->whereNull('project_block.deleted_at')
            ->orderBy('id','desc');
        return $data->get();
    }

    public function getToAjax($blockName, $projectName)
    {
        $data = ProjectBlock::query()->join('projects','project_block.project_id','=','projects.id')
            ->join('blocks','project_block.block_id','=','blocks.id')
            ->select('project_block.*','projects.project_name','projects.corporation_name','projects.project_note','blocks.block_name');
        if (!empty($blockName)) {
            $data->where('blocks.block_name', 'like', '%' . $blockName . '%');
        }
        if (!empty($projectName)) {
            $data->where('projects.project_name', 'like', '%' . $projectName . '%');
        }
        $data->orderBy('id','desc');
        return $data->get();
    }

    public function getById($id) {
        $data = ProjectBlock::query()->where('id', [$id])->get();
        return $data;
    }

    public function update($input) {
        return ProjectBlock::query()->where('id', $input['id'])
            ->update(['block_id' => $input['block_id'], 'project_id' => $input['project_id'], 'project_content' => $input['project_content']]);
    }

    public function insert($input) {
        $rs = ProjectBlock::insert($input);
        return $rs;

    }

    public function getBlockName() {
        $aryBlockName = DB::table('blocks')->select('block_name')->distinct()->whereNull('deleted_at')->get();
        return $aryBlockName;
    }

    public function countExistPjB($projectId, $id) {
        $countExistPjB = DB::table('project_block')
            ->select(DB::raw('count(*) count'))
            ->where('project_id', '=', $projectId)->whereNull('deleted_at');
        if (!empty($id)) {
            $countExistPjB->where('id', '<>', $id);
        }
        return $countExistPjB->get();
    }
}