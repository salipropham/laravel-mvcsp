<?php
/**
 * Created for mvcs project.
 * Author: salipro <sangph@suga.vn>
 * Date: 1/10/19
 */

namespace SaliproPham\LaravelMVCSP\Commands;



use Illuminate\Console\GeneratorCommand;

class CreateService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Services';
    }

    protected function getNameInput()
    {
        $name = trim($this->argument('name'));

        if (strpos($name, 'Service'))
            return ucfirst($name);
        else if (strpos($name, 'service'))
            return ucfirst(str_replace('service', 'Service', $name));
        else
            return ucfirst($name) . 'Service';
    }


}