<?php

/**
 * Bootstrap javascript assets watcher
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\Dev\Factory\Watcher;

use Apnet\AsseticWatcherBundle\Factory\Watcher\PreWatcher;
use Apnet\Dev\Factory\Importer\BootstrapImporter;

/**
 * Bootstrap javascript assets watcher
 */
class BootstrapWatcher extends PreWatcher
{

  /**
   * @var BootstrapImporter
   */
  private $importer;

  /**
   * Set importer
   *
   * @param BootstrapImporter $importer Bootstrap Importer
   *
   * @return null
   */
  public function setImporter(BootstrapImporter $importer)
  {
    $this->importer = $importer;
  }

  /**
   * {@inheritdoc}
   */
  public function getType()
  {
    return "bootstrap_js";
  }

  /**
   * {@inheritdoc}
   */
  protected function loadConfig($configPath)
  {
    return $this->importer->loadPublicConfig($configPath);
  }
}
