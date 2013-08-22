<?php
/**
 * @author  brooke.bryan
 */

namespace Qubes\Bootstrap;

abstract class BootstrapItem
{
  protected $_attributes = array();

  const ALIGN_DEFAULT = '';
  const ALIGN_LEFT    = 'pull-left';
  const ALIGN_RIGHT   = 'pull-right';

  public function clearAttributes()
  {
    $this->_attributes = [];
    return $this;
  }

  public function addAttributes(array $attributes)
  {
    foreach($attributes as $k => $v)
    {
      $this->_attributes[$k] = $v;
    }
    return $this;
  }

  public function setAttribute($name, $value)
  {
    $this->_attributes[$name] = $value;
    return $this;
  }

  public function getAttribute($name)
  {
    return $this->_attributes[$name];
  }

  public function getAttributes()
  {
    return $this->_attributes;
  }

  public function getAndUnsetAttribute($name)
  {
    $attribute = "";

    if($this->attributeExists($name))
    {
      $attribute = $this->getAttribute($name);
      unset($this->_attributes[$name]);
    }

    return $attribute;
  }

  public function attributeExists($name)
  {
    return isset($this->_attributes[$name]);
  }

  protected function _attributesToHtml()
  {
    $output = '';
    foreach($this->_attributes as $attribute => $value)
    {
      $output .= " $attribute=\"$value\"";
    }
    return $output;
  }

  public function __toString()
  {
    return (string)$this->render();
  }

  /**
   * @return string
   */
  abstract public function render();
}
