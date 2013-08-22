<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Navbar extends BootstrapItem
{
  protected $_content;
  protected $_brandText;
  protected $_brandUri;
  protected $_items;
  protected $_style;
  protected $_position;
  protected $_collapsible;

  const STYLE_DEFAULT = 'navbar';
  const STYLE_INVERSE = 'navbar-inverse';

  const POSITION_FIXED_TOP = 'navbar-fixed-top';
  const POSITION_FIXED_BOTTOM = 'navbar-fixed-bottom';
  const POSITION_STATIC_TOP = 'navbar-static-top';

  const NAV_COLLAPSE = 'nav-collapse';

  public function __construct(
    $content,
    $brandText = null,
    $brandUri = null,
    $style = self::STYLE_DEFAULT,
    $collapsible = false,
    $position = self::POSITION_STATIC_TOP
  )
  {
    $this->setContent($content);
    $this->setBrandText($brandText);
    $this->setBrandUri($brandUri);
    $this->setStyle($style);
    $this->setCollapsible($collapsible);
    $this->setPosition($position);
  }

  public function setContent($content)
  {
    $this->_content = $content;
    return $this;
  }

  public function getContent()
  {
    return $this->_content;
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

  public function setCollapsible($collapsible = false)
  {
    $this->_collapsible = $collapsible;
    return $this;
  }

  public function getCollapsible()
  {
    return $this->_collapsible;
  }

  public function setPosition($position = self::POSITION_STATIC_TOP)
  {
    $this->_position = $position;
    return $this;
  }

  public function getPosition()
  {
    return $this->_position;
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

    if($this->_style != self::STYLE_DEFAULT)
    {
      $output .= ' ' . $this->_style;
    }

    if($this->_collapsible)
    {
      $output .= ' ' . $this->_position;
    }

    $output .= " " . $this->getAndUnsetAttribute("class");

    return $output;
  }

  protected function _generateElement()
  {
    $span = '<span class="icon-bar"></span>';

    $output = '<div class="' . $this->_generateCssClass() . '">';
    $output .= '<div class="navbar-inner">';

    if($this->_collapsible)
    {
      $output .= '<div class="container">';
      $output .= '<a href="#" ';
      $output .= 'class="btn btn-navbar" ';
      $output .= 'data-toggle="collapse" ';
      $output .= 'data-target=".nav-collapse"';
      $output .= '>';
      $output .= $span;
      $output .= $span;
      $output .= $span;
      $output .= '</a>';
      $output .= $this->_generateBrand();

      $class = 'nav-collapse collapse';
      if($this->_style == self::STYLE_INVERSE)
      {
        $class .= ' navbar-inverse-collapse';
      }

      $output .= '<div class="' . $class . '">';
      $output .= $this->_content;
      $output .= '</div>';
      $output .= '</div>';
    }
    else
    {
      $output .= $this->_generateBrand();
      $output .= $this->_content;
    }

    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  public function render()
  {
    return $this->_generateElement();
  }
}
