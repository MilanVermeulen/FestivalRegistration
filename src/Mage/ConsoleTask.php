<?php

namespace App\Mage;

use Mage\Task\BuiltIn\Symfony\AbstractSymfonyTask;
use Symfony\Component\Process\Process;

class ConsoleTask extends AbstractSymfonyTask
{
    public function __construct()
    {
        $this->setOptions(['command']);
    }

    /**
     * Get the Name/Code of the Task
     *
     * @return string
     */
    public function getName(): string
    {
        return 'console';
    }

    /**
     * Get a short Description of the Task
     *
     * @return string
     */
    public function getDescription(): string
    {
        $options = $this->getOptions();
        return sprintf('symfony command "%s"', $options['command']);
    }

    /**
     * Executes the Command
     *
     * @return bool
     */
    public function execute(): bool
    {
        $options = $this->getOptions();
        $command = $options['console'] . ' ' . $options['command'] . ' --env=' . $options['env'] . ' ' . $options['flags'];

        /** @var Process $process */
        $process = $this->runtime->runCommand(
            trim($command),
            array_key_exists('timeout', $options) ? $options['timeout'] : 120
        );

        return $process->isSuccessful();
    }
}
