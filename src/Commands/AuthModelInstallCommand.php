<?php

namespace AlAminFirdows\LaravelMultiAuth\Commands;

use Symfony\Component\Console\Input\InputOption;
use AlAminFirdows\LaravelMultiAuth\Commands\InstallFilesCommand;
use AlAminFirdows\LaravelMultiAuth\Commands\Traits\OverridesCanReplaceKeywords;
use AlAminFirdows\LaravelMultiAuth\Commands\Traits\OverridesGetArguments;
use AlAminFirdows\LaravelMultiAuth\Commands\Traits\ParsesServiceInput;

class AuthModelInstallCommand extends InstallFilesCommand
{
    use OverridesCanReplaceKeywords, OverridesGetArguments, ParsesServiceInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laravel-multi-auth:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Authenticatable Model';

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        $parentOptions = parent::getOptions();
        return array_merge($parentOptions, [
            ['lucid', false, InputOption::VALUE_NONE, 'Lucid architecture'],
        ]);
    }

    /**
     * Get the destination path.
     *
     * @return string
     */
    public function getFiles()
    {
        $name = $this->getParsedNameInput();
        $lucid = $this->option('lucid');

        return [
            'model' => [
                'path' => !$lucid
                    ? '/app/Models/' . ucfirst($name) . '.php'
                    : '/src/Data/' . ucfirst($name) . '.php',
                'stub' => !$lucid
                    ? __DIR__ . '/../stubs/Model/Model.stub'
                    : __DIR__ . '/../stubs/Lucid/Model/Model.stub',
            ],
        ];
    }
}
