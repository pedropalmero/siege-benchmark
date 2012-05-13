<?php

  namespace SiegeBenchmark\Command;

  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\InputArgument;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Input\InputOption;
  use Symfony\Component\Console\Output\OutputInterface;
  use Symfony\Component\Yaml\Parser;

  use SiegeBenchmark\Config\Configuration;
  use SiegeBenchmark\Runner\Runner;

  class BenchmarkCommand extends Command
  {
    protected $urlsConfig;

    /** @var Configuration */
    protected $configuration;

    protected $tmpConfigPath = '/tmp/siegerc';

    protected function configure()
    {
      $this
        ->setName('siege:benchmark')
        ->setDescription('Benchmark one site with multiples urls loaded from file')
        ->addOption('urls', null, InputOption::VALUE_REQUIRED, 'Path with the urls yml')
        ->addOption('config', null, InputOption::VALUE_REQUIRED, 'Path with the configuration yml');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $this->prepareEnvironment($input);

      foreach ($this->urlsConfig['urls'] as $url)
      {
        $runner = new Runner($this->tmpConfigPath, $url);
        $runner->run();
      }
    }

    protected function prepareEnvironment($input)
    {
      $yaml = new Parser();

      $this->urlsConfig = $yaml->parse(file_get_contents($input->getOption('urls')));

      $config = $yaml->parse(file_get_contents($input->getOption('config')));

      $this->configuration = new Configuration($config['siege']);
      $this->configuration->flush($this->tmpConfigPath);
    }
  }