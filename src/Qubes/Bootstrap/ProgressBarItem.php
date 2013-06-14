<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class ProgressBarItem extends BootstrapItem
{
  protected $_percent;
  protected $_style;

  const STYLE_DEFAULT = 'bar-default';
  const STYLE_SUCCESS = 'bar-success';
  const STYLE_WARNING = 'bar-warning';
  const STYLE_DANGER  = 'bar-danger';

  public function __construct($percent, $style = self::STYLE_SUCCESS)
  {
    $this->setPercent($percent);
    $this->setStyle($style);
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

  /**
   * @param int $percent
   * @return $this
   */
  public function setPercent($percent)
  {
    $this->_percent = (int)$percent;
    return $this;
  }

  public function getPercent()
  {
    return $this->_percent;
  }

  public function render()
  {
    $output = '<div ';
    $output .= 'class="bar ' . $this->_style . '" ';
    $output .= 'style="width:' . $this->_percent . '%;"';
    $output .= '>';
    $output .= '</div>';

    return $output;
  }
}
