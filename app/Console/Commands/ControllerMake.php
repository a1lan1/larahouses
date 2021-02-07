<?php

namespace App\Console\Commands;

use \Illuminate\Routing\Console\ControllerMakeCommand;

class ControllerMake extends ControllerMakeCommand
{
    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        parent::handle();

        $this->call('make:service', [
            'name' => $this->getNameModel(),
        ]);

        $this->call('make:repo', [
            'name' => $this->getNameModel(),
        ]);
    }

    /**
     * @return string
     */
    private function getNameModel (): string
    {
        return str_replace("Controller", "", $this->getNameInput());
    }
}
