<?php

namespace CleaniqueCoders\Attendance\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeAttendanceAdapterCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Attendance Adapter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Adapter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/attendance.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Adapters';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['driver', 'd', InputOption::VALUE_REQUIRED, 'Type of Attendance Driver - BLE, API, RFID, IoT.'],
        ];
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $driver = $this->option('driver');        

        return str_replace(['DummyClass', 'DummyDriver'], [$class, $driver], $stub);
    }

     /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        if(!$this->option('driver')) {
            $this->error('Driver name not specified!');
            return false;
        }

        parent::handle();
    }
}
