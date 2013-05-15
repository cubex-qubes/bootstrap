<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class Label extends Symbol
{

  public function __construct(
    $text = '',
    $style = self::STYLE_DEFAULT
  )
  {
    parent::__construct($text, $style, static::ELEMENT_LABEL);
  }
}
