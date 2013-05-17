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
    if(!is_array($path))
    {
      $path         = trim($path, '/');
      $this->_path  = $path == "" ? 'Home' : $path;
      $this->_parts = explode('/', $this->_path);
    }
    else
    {
      $this->_parts = $path;
    }

    $this->setCurrent();

    return $this;
  }

  public function setCurrent()
  {
    $this->_current = end($this->_parts);

    if(is_array($this->_current))
    {
      $this->_current = $this->_current['text'];
    }

    $this->_current = $this->_strReplace($this->_current);

    return $this;
  }

  public function getCurrent()
  {
    return $this->_current;
  }

  protected function _strReplace($string)
  {
    $string = str_replace('-', ' ', $string);
    $string = str_replace('_', ' ', $string);

    return $string;
  }


  protected function _generateElement()
  {
    $count = count($this->_parts);
    $i     = 1;

    $output = '<ul class="breadcrumb">';
    foreach($this->_parts as $part)
    {
      if(is_array($part))
      {
        $a = '<a href="' . $part['href'] . '">' . ucwords(
          $part['text']
        ) . '</a>';
      }
      else
      {
        $text = ucwords($this->_strReplace($part));
        $a = '<a href="' . $part . '">' . $text . '</a>';
      }

      if($i == 1)
      {
        if($count != 1)
        {
          $output .= '<li>';
          $output .= '<a href="/">Home</a>';
          $output .= '<span class="divider">/</span>';
          $output .= '</li>';
        }
      }

      if($i < $count)
      {
        $output .= '<li>';
        $output .= $a;
        $output .= '<span class="divider">/</span>';
        $output .= '</li>';
      }
      else
      {
        $output .= '<li>';
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
