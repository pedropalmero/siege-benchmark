<?php

namespace SiegeBenchmark\Runner;

class Runner
{
  protected $configPath;
  protected $url;

  public function __construct($configPath, $url)
  {
    $this->configPath = $configPath;
    $this->url = $url;
  }

  public function run()
  {
    passthru($this->getBashCommand());
  }

  protected function getBashCommand()
  {
    $command = strtr('siege --rc={config} {url}', array(
      '{config}'    => $this->configPath,
      '{url}'       => $this->url
    ));

    return $command;
  }
}