<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

use Cubex\View\HtmlElement;
use Cubex\View\Partial;

class Breadcrumbs extends BootstrapItem
{
  protected $_path;
  protected $_parts;
  protected $_current;

  public function __construct($path)
  {
    $this->setPath($path);
  }

  public function setPath($path)
  {
    if(!is_array($path))
    {
      $path        = trim($path, '/');
      $this->_path = $path == "" ? 'Home' : $path;
    }
    else
    {
      $this->_path = implode('/', $path);
    }

    $this->_parts = explode('/', $this->_path);
    $this->setCurrent();
    return $this;
  }

  public function getPath()
  {
    return $this->_path;
  }

  public function setCurrent()
  {
    $this->_current = end($this->_parts);
    return $this;
  }

  public function getCurrent()
  {
    return $this->_current;
  }

  protected function _generateElement()
  {
    $ul  = new HtmlElement('ul', ['class' => 'breadcrumb']);
    $li  = new Partial('<li>%s</li>');
    $lia = new Partial(
      '<li><a href="%s">%s</a><span class="divider">/</span></li>'
    );

    $count = count($this->_parts);
    $i     = 1;
    foreach($this->_parts as $link)
    {
      if($i == 1)
      {
        if($count != 1)
        {
          $lia->addElement('/', 'Home');
        }
      }
      if($i < $count)
      {
        $lia->addElement($link, ucwords($link));
      }
      else
      {
        $li->addElement(ucwords($this->_current));
      }
      $i++;
    }
    $ul->nest($lia);
    $ul->nest($li);

    return $ul;
  }

  public function render()
  {
    $output = $this->_generateElement();
    return $output;
  }
}
