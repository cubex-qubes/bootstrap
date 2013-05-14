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

  public function __construct($path = array())
  {
    $this->_parts   = explode('/', $path);
    $this->_current = array_pop($this->_parts);
  }

  public function setPath($path)
  {
    $this->_path = $path;
    return $this;
  }

  public function getPath()
  {
    return $this->_path;
  }

  public function setCurrent()
  {
    $this->_current = end($this->_path);
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
      '<li><a href="%s">%s</a></li>'
    );
    $liaSep = new Partial(
      '<li><a href="%s">%s</a><span class="divider">/</span></li>'
    );

    foreach($this->_parts as $path)
    {
      $liaSep->addElement('/', 'Home');

      if($path)
      {
        $lia->addElement($path, ucwords($path));
      }
      else
      {
        $li->addElement(ucwords($this->_current));
      }
    }
    $ul->nest($liaSep);
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
