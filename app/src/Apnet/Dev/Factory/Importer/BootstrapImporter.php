<?php

/**
 * Bootstrap javascript assets importer
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\Dev\Factory\Importer;

use Apnet\AsseticImporterBundle\Factory\Importer\PreImporter;
use Apnet\AsseticWatcherBundle\Factory\Watcher\WatcherCompileException;
use Symfony\Component\Process\Process;

/**
 * Bootstrap javascript assets importer
 */
class BootstrapImporter extends PreImporter
{

  /**
   * {@inheritdoc}
   */
  protected function _loadConfig($configPath)
  {
    $config = parent::_loadConfig($configPath);

    foreach ($config as $key => $formulae) {
      if (isset($formulae["inputs"]) && $formulae["inputs"] == array("@bootstrap")) {
        $count = substr_count($configPath, "/");
        $parent = ".." . str_repeat("/..", $count - 2);
        $inputs = $this->_getBootstrapSassJavascripts();
        foreach ($inputs as $num => $value) {
          $inputs[$num] = $parent . $value;
        }

        $formulae["inputs"] = $inputs;
        $config[$key] = $formulae;
      }
    }

    return $config;
  }

  /**
   * Get a list of js files
   *
   * @throws WatcherCompileException
   * @return array
   */
  protected function _getBootstrapSassJavascripts()
  {
    $process = new Process("gem which bootstrap-sass");
    $process->run();
    if (!$process->isSuccessful()) {
      throw new WatcherCompileException(
        "`bootstrap-sass` gem was not found\n\n" . $process->getOutput()
      );
    }

    $gemPath = trim($process->getOutput());
    $bjsRootPath = dirname(dirname($gemPath)) . "/vendor/assets/javascripts";
    $bjsPath = $bjsRootPath . "/bootstrap.js";
    $bjs = file_get_contents($bjsPath);

    $inputs = array();
    $matches = array();
    if (preg_match_all("/\/\/= require (.*)/i", $bjs, $matches)) {
      foreach ($matches[1] as $asset) {
        $inputs[] = $bjsRootPath . "/" . $asset . ".js";
      }
    } else {
      $inputs[] = $bjsPath;
    }
    return $inputs;
  }

  /**
   * Public Morozov
   *
   * @param string $configPath Config path
   *
   * @return array
   */
  public function loadConfig($configPath)
  {
    return $this->_loadConfig($configPath);
  }

}
