<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

class FormSearch extends BootstrapItem
{
  protected $_text;
  protected $_name;
  protected $_formType;
  protected $_roundCorners;
  protected $_alignment;

  const FORM_TYPE_DEFAULT = 'form';
  const FORM_TYPE_SEARCH  = 'form-search';
  const FORM_TYPE_NAVBAR  = 'navbar-search';

  public function __construct(
    $text = '',
    $formType = self::FORM_TYPE_SEARCH,
    $align = self::ALIGN_DEFAULT
  )
  {
    $this->setText($text);
    $this->setFormType($formType);
    $this->setAlignment($align);
  }

  public function setName($name = '')
  {
    $this->_name = $name;
    return $this;
  }

  public function getName()
  {
    return $this->_name;
  }

  public function setText($text = '')
  {
    $this->_text = $text;
    return $this;
  }

  public function getText()
  {
    return $this->_text;
  }

  public function setFormType($formType = self::FORM_TYPE_DEFAULT)
  {
    $this->_formType = $formType;
    return $this;
  }

  public function getFormType()
  {
    return $this->_formType;
  }

  public function setAlignment($alignment = self::ALIGN_DEFAULT)
  {
    $this->_alignment = $alignment;
    return $this;
  }

  public function getAlignment()
  {
    return $this->_alignment;
  }

  protected function _generateFormCssClass()
  {
    $output = $this->_formType . ' ' . $this->_alignment;

    return $output;
  }

  protected function _generateItemCssClass()
  {
    $output = ' ' . $this->_roundCorners;

    return $output;
  }

  protected function _generateFormElement()
  {
    $output = sprintf(
      '<input type="text" name="%s" class="input-medium %s"/>
       <button type="submit" class="btn">%s</button>',
      $this->getName(),
      $this->_generateItemCssClass(),
      $this->_text
    );

    return $output;
  }

  protected function _generateForm()
  {
    $output = sprintf(
      '<form class="%s" %s>
        %s
      </form>',
      $this->_generateFormCssClass(),
      $this->_attributesToHtml(),
      $this->_generateFormElement()
    );

    return $output;
  }

  public function render()
  {
    return $this->_generateForm();
  }
}
