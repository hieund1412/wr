<?php

namespace Modules\Projects\Repositories;

use Core\AbstractBaseRepository;
use DB;
use Modules\Projects\Entities\Project;

class ProjectsRepository extends AbstractBaseRepository implements ProjectInterface
{

    public function __construct(Project $model)
    {
        parent::__construct($model);
    }
    public function getAll()
    {
        $data = Project::query()->whereNull('deleted_at')->orderBy('id','desc');
        return $data->get();
    }
    public function getToAjax($corporationName, $projectName)
    {
        $data = Project::query();
        if (!empty($corporationName)) {
            $data->where('projects.corporation_name', 'like','%' . $corporationName.'%')->get();
        }
        if (!empty($projectName)) {
            $data->where('projects.project_name', 'like', '%' . $projectName . '%');
        }
        $data->orderBy('id','desc');
        return $data->get();
    }

    public function getById($id)
    {
        $data = Project::query()->where('id',$id)->get();
        return $data;
    }
    public function deleteOneById($id)
    {
        $data = Project::query()->where('id', $id)->update(['deleted_at' => date("Y-m-d H:i:s")]);
        return $data;

    }
    public function insert($input)
    {
        $rs = Project::create($input);
        return $rs;

    }
    public function update($data)
    {
        Project::query()->where('id', $data['id'])
            ->update(['corporation_name' => $data['corporation_name'], 'project_name' => $data['project_name'], 'project_note' => $data['project_note']]);
    }

    public function getProject(){
        $aryData =  Project::all();
        return $aryData;
    }

    public function getCprName() {
        $corporationName = DB::table('corporation')->select('corporation_name')->distinct()->get();
        return $corporationName;
    }

    public function countExistProject($projectName, $id) {
        $countExistProject = DB::table('projects')->select(DB::raw('count(*) count'))->where('project_name', '=', $projectName);
        if (!empty($id)) {
            $countExistProject->where('id', '<>', $id);
        }
        return $countExistProject->get();
    }
}