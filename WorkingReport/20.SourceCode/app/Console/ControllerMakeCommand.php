<?php
/**
 * Created by PhpStorm.
 * User: anhpt
 * Date: 6/5/2019
 * Time: 9:21 AM
 */

namespace App\Console;

use Core\AgrimediaModuleGenerator;
use Nwidart\Modules\Commands\ModuleMakeCommand as ModuleMakeCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends ModuleMakeCommand
{
    protected $name = "module:make";

    /*Tạo stub của controller có sẵn annotation*/

    function getStubPath()
    {
        return base_path('vendor\nwidart\laravel-modules\src\Commands\stubs\\');
    }
    function handle()
    {

        $success = \File::copy(base_path('core/stubs/controller.stub'), $this->getStubPath() . "controller.stub");
        if (!$success) throw new \Exception("Không thể tạo file stub");
        $names = $this->argument('name');
       // dd($this->laravel['files']);
        foreach ($names as $name) {
            with(new AgrimediaModuleGenerator($name))
                ->setFilesystem($this->laravel['files'])
                ->setModule($this->laravel['modules'])
                ->setConfig($this->laravel['config'])
                ->setConsole($this)
                ->setForce($this->option('force'))
                ->setPlain($this->option('plain'))
                ->generate();
        }
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'The names of modules will be created.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Generate a plain module (without some resources).'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the module already exists.'],
        ];
    }
}

