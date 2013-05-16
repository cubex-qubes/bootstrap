<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Navbar extends BootstrapItem
{
  protected $_brandText;
  protected $_brandUri;
  protected $_nav;

  public function __construct(Nav $nav, $brandText = null, $brandUri = null)
  {
    $this->setBrandText($brandText);
    $this->setBrandUri($brandUri);
    $this->_nav = $nav;
  }

  public function setBrandText($brandText = null)
  {
    if($brandText != null)
    {
      $this->_brandText = $brandText;
    }

    return $this;
  }

  public function getBrandText()
  {
    return $this->_brandText;
  }

  public function setBrandUri($brandUri = null)
  {
    if($brandUri != null)
    {
      $this->_brandUri = $brandUri;
    }

    return $this;
  }

  public function getBrandUri()
  {
    return $this->_brandUri;
  }

  protected function _generateBrand()
  {
    $output = '';

    if($this->_brandText != null)
    {
      $output .= '<span class="brand">';
      $output .= $this->_brandText;
      $output .= '</span>';
    }

    if($this->_brandUri != null && $this->_brandText != null)
    {
      $output = '<a href="' . $this->_brandUri . '" class="brand">';
      $output .= $this->_brandText;
      $output .= '</a>';
    }

    return $output;
  }

  protected function _generateElement()
  {
    $output = '<div class="navbar">';
    $output .= '<div class="navbar-inner">';
    $output .= $this->_generateBrand();
    $output .= $this->_nav;
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  public function render()
  {
    return $this->_generateElement();
  }
}
