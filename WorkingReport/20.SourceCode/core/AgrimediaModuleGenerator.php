<?php

namespace Core;

use Nwidart\Modules\Generators\ModuleGenerator;

class AgrimediaModuleGenerator extends ModuleGenerator
{

    public function generateResources()
    {

        $this->console->call('module:make-repository', [
            'name' => $this->getName() . 'Repository',
            '--master' => true,
            'module' => $this->getName(),
        ]);

        $this->console->call('module:make-repository', [
            'module' => $this->getName(),
            'name' => $this->getName()."Interface",
        ]);
        $this->console->call('module:make-service', [
            'module' => $this->getName(),
            '--master' => true,
            'name' => $this->getName().'Service',
        ]);

        parent::generateResources();
    }


}
