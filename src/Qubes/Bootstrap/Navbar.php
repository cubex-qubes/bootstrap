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
  protected $_style;

  const STYLE_DEFAULT = 'navbar';
  const STYLE_INVERSE = '-inverse';

  public function __construct(
    Nav $nav,
    $brandText = null,
    $brandUri = null,
    $style = self::STYLE_DEFAULT
  )
  {
    $this->setBrandText($brandText);
    $this->setBrandUri($brandUri);
    $this->setStyle($style);
    $this->_nav = $nav;
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

  protected function _generateCssClass()
  {
    $output = self::STYLE_DEFAULT;

    if($this->_style == self::STYLE_INVERSE)
    {
      $output .= ' ' . self::STYLE_DEFAULT . self::STYLE_INVERSE;
    }

    return $output;
  }

  protected function _generateElement()
  {
    $output = '<div';
    $output .= ' class="' . $this->_generateCssClass() . '">';
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
