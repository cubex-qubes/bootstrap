<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

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
    $count = count($this->_parts);
    $i     = 1;

    $output = '<ul class="breadcrumb">';
    foreach($this->_parts as $link)
    {
      $a = '<a href="' . $link . '">' . ucwords($link) . '</a>';

      if($i == 1)
      {
        if($count != 1)
        {
          $output .= '<li>';
          $output .= '<a href="/">Home</a>';
          $output .= '</li>';
        }
      }
      if($i < $count)
      {
        $output .= '<li>';
        $output .= '<span class="divider">/</span>';
        $output .= $a;
        $output .= '</li>';
      }
      else
      {
        $output .= '<li>';
        $output .= '<span class="divider">/</span>';
        $output .= ucwords($this->_current);
        $output .= '</li>';
      }
      $i++;
    }
    $output .= '</ul>';

    return $output;
  }

  public function render()
  {
    $output = $this->_generateElement();
    return $output;
  }
}
