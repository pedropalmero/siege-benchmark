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
    $logPath = sprintf('/tmp/%s.log', md5($this->url));

    if (is_file($logPath))
    {
      unlink($logPath);
    }

    $command = strtr('siege --rc={config} --log={log} {url}', array(
      '{config}'    => $this->configPath,
      '{url}'       => $this->url,
      '{log}'       => $logPath
    ));

    return $command;
  }
}