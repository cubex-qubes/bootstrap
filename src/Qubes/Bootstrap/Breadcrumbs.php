<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Breadcrumbs extends BootstrapItem
{
  protected $_parts;
  protected $_current;
  public $baseItemText;

  public function __construct($path, $baseItemText = 'Home')
  {
    $this->baseItemText = $baseItemText;

    if(!is_array($path))
    {
      $path = trim($path, '/');
      $this->_parts = $path == "" ? $this->baseItemText : $path;
      $this->_parts = explode('/', $this->_parts);
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

    $this->_current = str_replace(
      [
      '-',
      '_'
      ], ' ', $this->_current
    );

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
        $text = ucwords(
          str_replace(
            [
            '-',
            '_'
            ], ' ', $part
          )
        );
        $a    = '<a href="' . $part . '">' . $text . '</a>';
      }

      $output .= '<li>';
      if($i == 1)
      {
        if($count != 1)
        {
          $output .= '<a href="/">' . $this->baseItemText . '</a>';
          $output .= '<span class="divider">/</span>';
        }
      }

      if($i < $count)
      {
        $output .= $a;
        $output .= '<span class="divider">/</span>';
      }
      else
      {
        $output .= ucwords($this->_current);
      }
      $output .= '</li>';

      $i++;
    }
    $output .= '</ul>';

    return $output;
  }

  public function render()
  {
    return $this->_generateElement();
  }
}
