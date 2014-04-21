<?php

/**
 * Test jquery
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\Tests;

use Apnet\FunctionalTestBundle\Framework\WebTestCase;

/**
 * Test jquery
 */
class BootstrapTest extends WebTestCase
{

  /**
   * Test imported files
   *
   * @param string $source Source path in app/Resources
   * @param string $target Target path
   *
   * @return null
   * @dataProvider staticCollectionProvider
   */
  public function testImportedFiles($source, $target)
  {
    $client = self::createClient();

    $client->request("GET", $target);
    $response = $client->getResponse();

    $this->assertEquals(200, $response->getStatusCode());

    $container = $client->getContainer();
    $path = $container->getParameter("kernel.root_dir") . "/Resources" . $source;

    $this->assertEquals(
      file_get_contents($path), $response->getContent()
    );
  }

  /**
   * testStaticCollection dataProvider
   *
   * @return array
   */
  public function staticCollectionProvider()
  {
    return array(
      array(
        "/assets/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.eot",
        "/bootstrap/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.eot"
      ),
      array(
        "/assets/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.svg",
        "/bootstrap/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.svg"
      ),
      array(
        "/assets/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.ttf",
        "/bootstrap/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.ttf"
      ),
      array(
        "/assets/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.woff",
        "/bootstrap/stylesheets/fonts/bootstrap/glyphicons-halflings-regular.woff"
      ),
      array(
        "/assets/stylesheets/bootstrap.min.css",
        "/bootstrap/stylesheets/bootstrap.min.css"
      ),
    );
  }
}
