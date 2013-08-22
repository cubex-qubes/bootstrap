<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Collapse extends BootstrapItem
{
  protected $_id;
  protected $_items = [];

  public function __construct($identifier = 'accordion')
  {
    $this->_id = $identifier;
  }

  protected function _items($headerText = '', $content)
  {

  }

  protected function _buildGroup()
  {

  }

  protected function _buildParent()
  {
    $output = '<div ';
    $output .= 'class="accordion" ';
    $output .= 'id="' . $this->_id . '"';
    $output .= '>';
    $output .= $this->_buildGroup();
    $output .= '</div>';

    return $output;
  }

  public function render()
  {}
}
