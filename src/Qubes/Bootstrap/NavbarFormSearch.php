<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class NavbarFormSearch extends FormSearch
{
  protected $_text;
  protected $_roundCorners;
  protected $_alignment;

  const RADIUS_ROUND   = 'search-query';

  public function __construct($text = '', $alignment = self::ALIGN_LEFT)
  {
    parent::__construct(
      $text, self::FORM_TYPE_NAVBAR,
      self::RADIUS_ROUND,
      $alignment
    );
  }

  protected function _generateFormElement()
  {
    $class = 'input-medium search-query' . $this->_generateItemCssClass();

    $output = '<input type="text"';
    $output .= ' class="' . $class . '"';
    $output .= ' placeholder="' . $this->_text . '"';
    $output .= '/>';

    return $output;
  }

  public function render()
  {
    return $this->_generateForm();
  }
}
