<?php

namespace App\Console;

use Illuminate\Support\Str;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Module;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service provider class for the specified module.';

    public function getDefaultNamespace(): string
    {
        return $this->laravel['modules']->config('paths.generator.provider.path', 'Repositories');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The repositories name.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['master', null, InputOption::VALUE_NONE, 'Indicates the master repositories', null],
        ];
    }

    protected function getTemplateContents()
    {
        \File::copy(base_path('core/stubs/repository_interface.stub'), "vendor\\nwidart\laravel-modules\src\Commands\stubs\\repository_interface.stub");
        $success = \File::copy(base_path('core/stubs/repository.stub'), "vendor\\nwidart\laravel-modules\src\Commands\stubs\\repository.stub");
        if (!$success) throw new \Exception("Không thể tạo file stub");

        $stub = 'repository';
        $stub_interface = 'repository_interface';

        /** @var Module $module */
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        if (strpos($this->getClass(), "Interface") > -1) {
            return (new Stub('/' . $stub_interface . '.stub', [
                'NAMESPACE' => $this->getClassNamespace($module),
                'CLASS' => $this->getClass(),
                'LOWER_NAME' => $module->getLowerName(),
                'MODULE' => $this->getModuleName(),
                'NAME' => $this->getFileName(),
                'STUDLY_NAME' => $module->getStudlyName(),
                'MODULE_NAMESPACE' => $this->laravel['modules']->config('namespace'),
                'PATH_VIEWS' => GenerateConfigReader::read('views')->getPath(),
                'PATH_LANG' => GenerateConfigReader::read('lang')->getPath(),
                'PATH_CONFIG' => GenerateConfigReader::read('config')->getPath(),
                'MIGRATIONS_PATH' => GenerateConfigReader::read('migration')->getPath(),
                'FACTORIES_PATH' => GenerateConfigReader::read('factory')->getPath(),
            ]))->render();
        } else {
            return (new Stub('/' . $stub . '.stub', [
                'NAMESPACE' => $this->getClassNamespace($module),
                'CLASS' => $this->getClass(),
                'LOWER_NAME' => $module->getLowerName(),
                'MODULE' => $this->getModuleName(),
                'NAME' => $this->getFileName(),
                'INTERFACE' => $this->getModuleName() . "Interface",
                'STUDLY_NAME' => $module->getStudlyName(),
                'MODULE_NAMESPACE' => $this->laravel['modules']->config('namespace'),
                'PATH_VIEWS' => GenerateConfigReader::read('views')->getPath(),
                'PATH_LANG' => GenerateConfigReader::read('lang')->getPath(),
                'PATH_CONFIG' => GenerateConfigReader::read('config')->getPath(),
                'MIGRATIONS_PATH' => GenerateConfigReader::read('migration')->getPath(),
                'FACTORIES_PATH' => GenerateConfigReader::read('factory')->getPath(),
            ]))->render();
        }

    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('repository');
        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
