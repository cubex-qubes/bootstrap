<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

use Cubex\View\HtmlElement;

class Symbol extends BootstrapItem
{
  protected $_text;
  protected $_element;
  protected $_style;

  const ELEMENT_LABEL = 'label';
  const ELEMENT_BADGE = 'badge';

  const STYLE_DEFAULT   = 'default';
  const STYLE_SUCCESS   = '-success';
  const STYLE_WARNING   = '-warning';
  const STYLE_IMPORTANT = '-important';
  const STYLE_INFO      = '-info';
  const STYLE_INVERSE   = '-inverse';

  public function __construct(
    $text = '',
    $style = self::STYLE_DEFAULT,
    $element = self::ELEMENT_LABEL
  )
  {
    $this->_text  = $text;
    $this->_element = $element;
    $this->_style = $style;
  }

  public function setText($text)
  {
    $this->_text = $text;
    return $this;
  }

  public function getText()
  {
    return $this->_text;
  }

  public function setElement($element)
  {
    $this->_element = $element;
    return $this;
  }

  public function getElement()
  {
    return $this->_element;
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

  public function render()
  {
    $out = new HtmlElement(
      'span',
      ['class' => $this->_element . ' ' . $this->_element . $this->_style],
      $this->_text
    );
    return $out->__toString();
  }
}
