<?php

namespace Modules\StatiscalProject\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Blocks\Services\BlocksServices;
use Modules\Projects\Services\ProjectServices;
use Modules\StatiscalProject\Repositories\StatiscalProjectInterface;
use Modules\StatiscalProject\Services\StatiscalProjectService;

/**
 * @AnnotatedDescription(allow=true,desc="Thống kê theo dự án")
 */
class StatiscalProjectController extends Controller
{
    private $PROJECT_KEY = 'project_name';
    private $RELATE_BLOCK_KEY = 'relate_block';
    private $CORPORATION_NAME = 'corporation_name';
    protected $statisticalProject;
    protected $statisticalProjectService;
    protected $blockService;
    protected $projectService;
    public function __construct(StatiscalProjectInterface $statisticalProject,
                                StatiscalProjectService $statisticalProjectService,
                                BlocksServices $blocksServices,
                                ProjectServices $projectServices) {
        $this->statisticalProject = $statisticalProject;
        $this->statisticalProjectService = $statisticalProjectService;
        $this->blockService = $blocksServices;
        $this->projectService = $projectServices;
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Thống kê theo dự án")
     */
    public function responseDataIndex() {
        $block = $this->blockService->getBlock();
        $project = $this->projectService->getProject();
        return view('statiscalproject::statistic_project', compact('block','project'));
    }

    /**
     * search data by condition search
     */
    public function searchDataRequest() {
        $from_date = Carbon::createFromFormat('d/m/Y', Input::get('from_date'))->format('Y-m-d');
        $to_date = Carbon::createFromFormat('d/m/Y', Input::get('to_date'))->format('Y-m-d');
        $block_name = Input::get('block_name');
        $relate_block = Input::get('relate_block');
        $project_name = Input::get('project_name');
        $headerDate = $this->statisticalProjectService->createHeaderDate($from_date, $to_date, 'Y-m-d', 'd-m');
        $data = $this->statisticalProjectService->searchByProject($from_date, $to_date, $block_name, $relate_block, $project_name);
        $blockFollowPjChart = $this->statisticalProjectService->chartByProject($from_date, $to_date, $block_name, $relate_block, $project_name, $this->PROJECT_KEY);
        $blockFollowRelateChart = $this->statisticalProjectService->chartByProject($from_date, $to_date, $block_name, $relate_block, $project_name, $this->RELATE_BLOCK_KEY);
        $blockFollowCprChart = $this->statisticalProjectService->chartByProject($from_date, $to_date, $block_name, $relate_block, $project_name, $this->CORPORATION_NAME);

        return view('statiscalproject::statistic_project_data', compact('data','from_date', 'to_date', 'headerDate',
            'block_name', 'relate_block', 'project_name', 'blockFollowCprChart', 'blockFollowPjChart', 'blockFollowRelateChart'));

    }
}
