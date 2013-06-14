<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

/**
 * Button Generator
 * @package Qubes\Bootstrap
 */

class ProgressBar extends BootstrapItem
{
  protected $_style;
  protected $_bar;
  protected $_pattern;
  protected $_animate;
  protected $_items = [];

  const STYLE_DEFAULT = 'progress-default';
  const STYLE_INFO    = 'progress-info';
  const STYLE_SUCCESS = 'progress-success';
  const STYLE_WARNING = 'progress-warning';
  const STYLE_DANGER  = 'progress-danger';

  const PATTERN_DEFAULT = '';
  const PATTERN_STRIPED = 'progress-striped';

  const ANIMATE = 'active';

  public function __construct(
    $style = self::STYLE_DEFAULT,
    $pattern = self::PATTERN_DEFAULT,
    $animate = false
  )
  {
    $this->setStyle($style);
    $this->setPattern($pattern);
    $this->setAnimate($animate);
  }

  public function setStyle($style)
  {
    $this->_style = $style;
    return $this;
  }

  public function getStyle()
  {
    return $this->_style;
  }

  public function setPattern($pattern)
  {
    $this->_pattern = $pattern;
    return $this;
  }

  public function getPattern()
  {
    return $this->_pattern;
  }

  public function setAnimate($animate)
  {
    $this->_animate = $animate;
    return $this;
  }

  public function addItem(ProgressBarItem $item)
  {
    $this->_items[] = $item;
  }

  protected function _buildElementCss()
  {
    $output = 'progress ' . $this->_style;

    if($this->_pattern != self::PATTERN_DEFAULT)
    {
      $output .= ' ' . $this->_pattern;
    }

    if($this->_pattern != self::PATTERN_DEFAULT && $this->_animate)
    {
      $output .= ' ' . self::ANIMATE;
    }

    return $output;
  }

  protected function _buildBars()
  {
    $output = '';

    foreach($this->_items as $item)
    {
      $output .= $item;
    }

    return $output;
  }

  public function render()
  {
    $output = '<div ';
    $output .= 'class="' . $this->_buildElementCss() . '"';
    $output .= '>';

    $output .= $this->_buildBars();

    $output .= '</div>';

    return $output;
  }
}
