<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class ButtonGroup extends BootstrapItem
{
  protected $_buttons;
  protected $_vertical;
  protected $_dropdown = '';

  const ELEMENT_TYPE = 'btn-group';
  const ROTATION_DEFAULT = '';
  const ROTATION_VERTICAL = 'btn-group-vertical';

  public function __construct($buttons = array(), $vertical = false)
  {
    $this->_buttons = $buttons;
    $this->_vertical = $vertical;
  }

  public function setButtons($buttons)
  {
    $this->_buttons = $buttons;
    return $this;
  }

  public function getButtons()
  {
    return $this->_buttons;
  }


  public function setRotation($vertical = self::ROTATION_DEFAULT)
  {
    $this->_vertical = $vertical;
    return $this->_vertical;
  }

  public function getRotation()
  {
    return $this->_vertical;
  }

  protected function _generateElementCss()
  {
    $output = 'btn-group';
    if($this->_vertical)
    {
      $output .= ' ' . self::ROTATION_VERTICAL;
    }
    return $output;
  }

  protected function _generateButtons()
  {
    $output = '';
    foreach($this->_buttons as $button)
    {
      $output .= $button;
    }

    return $output;
  }

  public function render()
  {
    $output = '<div';
    $output .= ' class="' . $this->_generateElementCss() . '"';
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= $this->_generateButtons();
    $output .= '</div>';
    return $output;
  }
}
