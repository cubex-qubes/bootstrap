<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Nav extends BootstrapItem
{
  const NAV_TABS          = "nav-tabs";
  const NAV_PILLS         = "nav-pills";
  const NAV_LIST          = "nav-list";
  const NAV_TABS_STACKED  = "nav-tabs nav-stacked";
  const NAV_PILLS_STACKED = "nav-pills nav-stacked";
  const NAV_DROPDOWN      = "dropdown-menu";

  protected $_element;
  protected $_style;
  protected $_items = [];

  public function __construct($style = self::NAV_TABS)
  {
    $this->_element = "ul";
    $this->_style = $style;
  }

  public function setStyle($style = self::NAV_TABS)
  {
    $this->_style = $style;
    return $this;
  }

  public function getStyle()
  {
    return $this->_style;
  }

  public function addItem(NavItem $item)
  {
    $this->_items[] = $item;
  }

  public function render()
  {
    $output = '<' . $this->_element;
    $output .= " class=\"{$this->_getNavCssClasses()}\"";
    $output .= $this->_attributesToHtml();
    $output .= '>';

    foreach($this->_items as $item)
    {
      $output .= $item->render();
    }

    $output .= '</' . $this->_element . '>';

    return $output;
  }

  protected function _getNavCssClasses()
  {
    $class = "nav {$this->_style}";

    if(isset($this->_attributes["class"]))
    {
      $class .= " " . $this->_attributes["class"];
      unset($this->_attributes["class"]);
    }

    return $class;
  }
}
