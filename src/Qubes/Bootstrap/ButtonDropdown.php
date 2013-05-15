<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;
class ButtonDropdown extends Button
{
  protected $_text;
  protected $_caretIsButton;
  protected $_dropdown;

  public function __construct($text, Nav $nav, $caretIsButton = false)
  {
    $this->addDropdown($nav);
    $this->_text          = $text;
    $this->_caretIsButton = $caretIsButton;
    parent::__construct($this->_text);
  }

  public function addDropdown(Nav $dropdown)
  {
    $this->_dropdown = $dropdown;
    return $this;
  }

  protected function _generateButtonCss()
  {
    $class = "dropdown-toggle";
    return parent::_generateButtonCss() . ' ' . $class;
  }

  public function render()
  {
    $output = '';
    if($this->_caretIsButton)
    {
      $output .= new Button($this->_text);
    }
    $output .= '<' . $this->_element;
    $output .= ' class="' . $this->_generateButtonCss() . '"';
    $output .= " data-toggle=\"dropdown\"";
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= !$this->_caretIsButton ? $this->_text : null;
    $output .= " <span class=\"caret\"></span>";
    $output .= '</' . $this->_element . '>';
    $output .= $this->_dropdown;
    return $output;
  }
}
