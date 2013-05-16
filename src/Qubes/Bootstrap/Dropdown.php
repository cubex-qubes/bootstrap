<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Dropdown extends BootstrapItem
{
  protected $_element;
  protected $_text;
  protected $_nav;

  public function __construct($text, Nav $nav, $addCaret = true)
  {
    $this->_element = "a";
    $this->_text = $text;

    if($addCaret)
    {
      $this->_text .= " <b class=\"caret\"></b>";
    }

    $this->_nav = $nav;
    $this->_nav->setStyle(Nav::NAV_DROPDOWN);
  }

  public function setText($text = '')
  {
    $this->_text = $text;
    return $this;
  }

  public function getText()
  {
    return $this->_text;
  }

  public function render()
  {
    $output = '<' . $this->_element;
    $output .= " href=\"#\"";
    $output .= " class=\"{$this->_getDropdownCssClasses()}\"";
    $output .= " data-toggle=\"dropdown\"";
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= (string)$this->_text;
    $output .= '</' . $this->_element . '>';
    $output .= $this->_nav->render();

    return $output;
  }

  protected function _getDropdownCssClasses()
  {
    $class = "dropdown-toggle";

    if(isset($this->_attributes["class"]))
    {
      $class .= " " . $this->_attributes["class"];
      unset($this->_attributes["class"]);
    }

    return $class;
  }
}
