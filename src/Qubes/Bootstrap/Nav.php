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
  const NAV_DEFAULT       = "";
  const NAV_TABS_STACKED  = "nav-tabs nav-stacked";
  const NAV_PILLS_STACKED = "nav-pills nav-stacked";
  const NAV_DROPDOWN      = "dropdown-menu";

  protected $_element;
  protected $_style;
  protected $_alignment;
  protected $_cssClass;
  protected $_items = [];

  public function __construct(
    $style = self::NAV_TABS,
    $alignment = self::ALIGN_DEFAULT,
    $cssClass = ''
  )
  {
    $this->_element = "ul";
    $this->setStyle($style);
    $this->setAlignment($alignment);
    $this->_cssClass = $cssClass;
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

  public function setAlignment($alignment = self::ALIGN_DEFAULT)
  {
    $this->_alignment = $alignment;
    return $this;
  }

  public function getAlignment()
  {
    return $this->_alignment;
  }

  public function addItem(NavItem $item)
  {
    $this->_items[] = $item;

    return $this;
  }

  protected function _getNavCssClasses()
  {
    $class = '';

    if($this->_style != self::NAV_DROPDOWN)
    {
      $class .= "nav";
    }

    $class .= " {$this->_style} {$this->_alignment} {$this->_cssClass}";

    if(isset($this->_attributes["class"]))
    {
      $class .= " " . $this->_attributes["class"];
      unset($this->_attributes["class"]);
    }

    return $class;
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
}
