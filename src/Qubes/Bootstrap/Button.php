<?php
/**
 * @author  brooke.bryan
 */

namespace Qubes\Bootstrap;

/**
 * Button Generator
 * @package Qubes\Bootstrap
 */
class Button extends BootstrapItem
{
  protected $_text;
  protected $_element;
  protected $_size;
  protected $_style;

  const STYLE_DEFAULT = 'default';
  const STYLE_PRIMARY = 'btn-primary';
  const STYLE_INFO    = 'btn-info';
  const STYLE_SUCCESS = 'btn-success';
  const STYLE_WARNING = 'btn-warning';
  const STYLE_DANGER  = 'btn-danger';
  const STYLE_INVERSE = 'btn-inverse';
  const STYLE_LINK    = 'btn-link';

  const SIZE_LARGE   = 'btn-large';
  const SIZE_DEFAULT = 'default';
  const SIZE_SMALL   = 'btn-small';
  const SIZE_MINI    = 'btn-mini';

  const ELEMENT_BUTTON = 'button';
  const ELEMENT_ANCHOR = 'a';

  public function __construct(
    $text = '', $element = self::ELEMENT_BUTTON, $style = null, $size = null
  )
  {
    $this->_text    = $text;
    $this->_element = $element;
    if($style !== null)
    {
      $this->_style = $style;
    }
    if($size !== null)
    {
      $this->_size = $size;
    }
  }

  public function setSize($size = self::SIZE_DEFAULT)
  {
    $this->_size = $size;
    return $this;
  }

  public function getSize()
  {
    return $this->_size;
  }

  public function setStyle($style = self::STYLE_DEFAULT)
  {
    $this->_style = $style;
    return $this;
  }

  public function getStyle()
  {
    return $this->_style;
  }

  public function setText($text)
  {
    $this->_text = $text;
    return $this;
  }

  public function getText()
  {
    return $this->_text;
  }

  public function setElement($element = self::ELEMENT_BUTTON)
  {
    $this->_element = $element;
    return $this;
  }

  public function getElement()
  {
    return $this->_element;
  }

  public function render()
  {
    $output = '<' . $this->_element;
    $output .= ' class="' . $this->_generateButtonCss() . '"';
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= $this->_text;
    $output .= '</' . $this->_element . '>';
    return $output;
  }

  protected function _generateButtonCss()
  {
    $output = 'btn';
    if($this->_size !== null && $this->_size !== self::SIZE_DEFAULT)
    {
      $output .= ' ' . $this->_size;
    }
    if($this->_style !== null && $this->_style !== self::STYLE_DEFAULT)
    {
      $output .= ' ' . $this->_style;
    }
    return $output;
  }
}
