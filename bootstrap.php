<?php

  require_once __DIR__.'/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

  use Symfony\Component\ClassLoader\UniversalClassLoader;

  $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

  $loader->registerNamespaces(array(
    'Symfony'           => __DIR__.'/vendor',
    'SiegeBenchmark'    => __DIR__.'/src'
  ));

  $loader->register();