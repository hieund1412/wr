<?php

namespace Modules\Jobs\Repositories;

use Core\AbstractBaseRepository;
use DB;
use Modules\Jobs\Entities\Jobs;

class JobsRepository extends AbstractBaseRepository implements JobsInterface
{

    public function __construct(Jobs $model) {
        parent::__construct($model);
    }

    public function getAll() {
        $data = Jobs::query()->join('blocks', 'jobs.block_id', '=', 'blocks.id')
                ->select('jobs.id', 'jobs.block_id', 'blocks.block_name', 'jobs.job_type','jobs.job_note')
                ->whereNull('jobs.deleted_at')
                ->orderBy('id','desc')
                ->get();
        return $data;
    }

    public function getToAjax($blockId, $jobType) {
        $data = Jobs::query()->join('blocks', 'jobs.block_id', '=', 'blocks.id')
                ->select('jobs.id', 'jobs.block_id', 'blocks.block_name', 'jobs.job_type','jobs.job_note');
        if (!empty($blockId)) {
            $data->where('blocks.id', $blockId);
        }
        if (!empty($jobType)) {
            $data->where('jobs.job_type', 'like', '%' . $jobType . '%');
        }
        $data->orderBy('id','desc');
        return $data->get();
    }

    public function getJob() {
        $aryJob = Jobs::all();
        return $aryJob;
    }

    public function getById($id) {
        $data = Jobs::query()->where('id', [$id])->get();
        return $data;
    }
    public function countExistJob($blockId, $jobType, $id) {
        $countExistJob = DB::table('jobs')->select(DB::raw('count(*) count'))
                ->where('block_id', '=', $blockId)
                ->where('job_type', '=', $jobType)
                ->whereNull('deleted_at');
        if (!empty($id)) {
            $countExistJob->where('id', '<>', $id);
        }
        return $countExistJob->get();
    }

    public function update($inputRequest) {
        return Jobs::query()->where('id', $inputRequest['id'])
            ->update(['block_id' => $inputRequest['block_id'], 'job_type' => $inputRequest['job_type'], 'job_note' => $inputRequest['job_note']]);
    }
}