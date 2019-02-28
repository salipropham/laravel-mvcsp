<?php
/**
 * Created for mvcs project.
 * Author: salipro <sangph@suga.vn>
 * Date: 1/10/19
 */

namespace SaliproPham\LaravelMVCSP\Commands;



use Illuminate\Console\GeneratorCommand;

class CreatePresenter extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:presenter {name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Presenter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Presenter';


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
        return __DIR__ . '/stubs/presenter.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Presenters';
    }

    protected function getNameInput()
    {
        $name = trim($this->argument('name'));

        if (strpos($name, 'Presenter'))
            return ucfirst($name);
        else if (strpos($name, 'presenter'))
            return ucfirst(str_replace('presenter', 'Presenter', $name));
        else
            return ucfirst($name) . 'Presenter';
    }


}