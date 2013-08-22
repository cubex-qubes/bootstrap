<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

/**
 * Button Generator
 * @package Qubes\Bootstrap
 */
class Alerts extends BootstrapItem
{
  protected $_title;
  protected $_text;
  protected $_style;
  protected $_size;
  protected $_element;
  protected $_dismiss;

  const STYLE_DEFAULT = 'alert';
  const STYLE_ERROR   = 'alert-error';
  const STYLE_SUCCESS = 'alert-success';
  const STYLE_INFO    = 'alert-info';

  const SIZE_DEFAULT = 'alert';
  const SIZE_BLOCK   = 'alert-block';

  public function __construct(
    $title = '',
    $text = '',
    $style = self::STYLE_DEFAULT,
    $size = self::SIZE_DEFAULT,
    $dismiss = false
  )
  {
    $this->_title   = $title;
    $this->_text    = $text;
    $this->_style   = $style;
    $this->_size    = $size;
    $this->_dismiss = $dismiss;
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

  public function setTitle($title)
  {
    $this->_title = $title;
    return $this;
  }

  public function getTitle()
  {
    return $this->_title;
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

  public function setDismiss($dismiss)
  {
    $this->_dismiss = $dismiss;
    return $this;
  }

  public function getDismiss()
  {
    return $this->_dismiss;
  }

  protected function _dismissAlert()
  {
    $output = '';
    if($this->_dismiss == true)
    {
      $output .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
    }

    return $output;
  }

  protected function _generateElementCss()
  {
    $output = 'alert';
    if($this->_size !== null && $this->_size !== self::SIZE_DEFAULT)
    {
      $output .= ' ' . $this->_size;
    }
    if($this->_style !== null && $this->_style !== self::STYLE_DEFAULT)
    {
      $output .= ' ' . $this->_style;
    }

    if(isset($this->_attributes["class"]))
    {
      $output .= " " . $this->_attributes["class"];
      unset($this->_attributes["class"]);
    }

    return $output;
  }

  protected function _generateElementContent()
  {
    $output = '';
    if($this->_size !== null && $this->_size !== self::SIZE_DEFAULT)
    {
      $output .= '<h4>' . $this->_title . '</h4>';
      $output .= '<p>' . $this->_text . '</p>';
    }
    else
    {
      $output .= '<strong>' . $this->_title . '</strong>';
      $output .= ' ' . $this->_text;
    }

    return $output;
  }

  public function render()
  {
    $output = '<div';
    $output .= ' class="' . $this->_generateElementCss() . '"';
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= $this->_dismissAlert();
    $output .= $this->_generateElementContent();
    $output .= '</div>';
    return $output;
  }
}
