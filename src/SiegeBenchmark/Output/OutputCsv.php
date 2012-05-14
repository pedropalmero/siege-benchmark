<?php

namespace SiegeBenchmark\Output;

class OutputCsv
{
  protected $path;
  protected $logs;

  public function __construct($path, $logs)
  {
    $this->path = $path;
    $this->logs = $logs;
  }

  public function render()
  {
    $handle = fopen($this->path, 'w');
    $data = $this->loadLogsData();

    fputcsv($handle, array('url') + $data[0]['csv'][0]);

    foreach ($data as $log)
    {
      fputcsv($handle, array($log['url']) + $log['csv'][1]);
    }

    fclose($handle);
  }

  private function loadLogsData()
  {
    $data = array();

    foreach ($this->logs as $log)
    {
      $handleLog = fopen($log['path'], 'r');

      $dataLog = array();
      $dataLog['url'] = $log['url'];
      $dataLog['csv'] = array();

      while($auxData = fgetcsv($handleLog))
      {
        $dataLog['csv'][] = $auxData;
      }

      $data[] = $dataLog;
      fclose($handleLog);
    }

    return $data;
  }
}