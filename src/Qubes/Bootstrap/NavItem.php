<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class NavItem extends BootstrapItem
{
  const STATE_NONE             = "";
  const STATE_ACTIVE           = "active";
  const STATE_DISABLED         = "disabled";
  const STATE_HEADER           = "nav-header";
  const STATE_DIVIDER          = "divider";
  const STATE_DIVIDER_VERTICAL = "divider-vertical";
  const STATE_DROPDOWN         = "dropdown";

  protected $_element;
  protected $_state;
  protected $_content;

  public function __construct($content = null, $state = self::STATE_NONE)
  {
    $this->_element = "li";
    $this->_state   = $state;

    if($content !== null)
    {
      $this->_content = $content;
    }
  }

  public function setContent($content = null)
  {
    if($content !== null)
    {
      $this->_content = $content;
    }

    return $this;
  }

  public function getContent()
  {
    return $this->_content;
  }

  public function setState($state = self::STATE_NONE)
  {
    $this->_state = $state;
    return $this;
  }

  public function getState()
  {
    return $this->_state;
  }

  public function setDropdown(Dropdown $dropdown)
  {
    $this->_state   = self::STATE_DROPDOWN;
    $this->_content = $dropdown->render();

    return $this;
  }

  public function render()
  {
    $output = '<' . $this->_element;
    $output .= " class=\"{$this->_getNavItemCssClasses()}\"";
    $output .= $this->_attributesToHtml();
    $output .= '>';
    $output .= (string)$this->_content;
    $output .= '</' . $this->_element . '>';

    return $output;
  }

  protected function _getNavItemCssClasses()
  {
    $class = $this->_state;

    if(isset($this->_attributes["class"]))
    {
      $class .= " " . $this->_attributes["class"];
      unset($this->_attributes["class"]);
    }

    return $class;
  }
}
