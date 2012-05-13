<?php

  namespace SiegeBenchmark\Config;

  class Configuration
  {
    protected $configuration = array(
      'verbose'           => false,
      'csv'               => true,
      'fullurl'           => true,
      'timestamp'         => true,
      'display-id'        => false,
      'show-logfile'      => false,
      'logging'           => true,
      'logfile'           => '',
      'protocol'          => 'HTTP/1.1',
      'chunked'           => true,
      'cache'             => false,
      'connection'        => 'close',
      'concurrent'        => '10',
      'time'              => '10s',
      'reps'              => '',
      'file'              => '',
      'url'               => '',
      'delay'             => 1,
      'timeout'           => '',
      'expire-session'    => '',
      'failures'          => '',
      'internet'          => false,
      'benchmark'         => false,
      'user-agent'        => '',
      'accept-encoding'   => 'gzip',
      'spinner'           => false,
      'login'             => '',
      'username'          => '',
      'password'          => '',
      'ssl-cert'          => '',
      'ssl-key'           => '',
      'ssl-timeout'       => '',
      'ssl-ciphers'       => '',
      'login-url'         => '',
      'proxy-host'        => '',
      'proxy-port'        => '',
      'proxy-login'       => '',
      'follow-location'   => '',
      'zero-data-ok'      => ''
    );

    public function __construct($configuration)
    {
      $this->configuration = array_merge($this->configuration, (array)$configuration);
    }

    public function flush($path)
    {
      $text = '';

      foreach ($this->configuration as $key => $value)
      {
        if ('' !== $value && null !== $value)
        {
          $text .= sprintf("%s = %s\r\n", $key, $this->getValuePrepared($value));
        }
      }

      $handle = fopen($path, 'w');
      fwrite($handle, $text);
    }

    private function getValuePrepared($value)
    {
      if (is_bool($value))
      {
        return $value ? 'true' : 'false';
      }
      else
      {
        return $value;
      }
    }

    public function setConfiguration($configuration)
    {
      $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
      return $this->configuration;
    }
  }
