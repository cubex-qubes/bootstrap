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

  public function addItem($headerText = '', $content = '', $groupId = '', $collapseLink = '')
  {
    $this->_items[] = [
      'header'  => $headerText,
      'content' => $content,
      'groupid' => $groupId,
      'collapseLink' => $collapseLink
    ];

    return $this;
  }

  protected function _buildGroup(
    $headerContent, $bodyContent, $i, $groupId = '', $collapseLink = ''
  )
  {
    $output = '<div';
    $output .= ' class="accordion-group"';
    if(!empty($groupId))
    {
      $output .= ' id="' . $groupId .'"';
    }
    $output .= '>';
    $output .= $this->_buildHeader($headerContent, $i, $collapseLink);
    $output .= $this->_buildBody($bodyContent, $i, $collapseLink);
    $output .= '</div>';

    return $output;
  }

  protected function _buildHeader($text, $i, $collapseLink = '')
  {
    $output = '<div';
    $output .= ' class="accordion-heading"';
    $output .= '>';
    $output .= '<a';

    if($collapseLink != '')
    {
      $output .= ' href="#'. $collapseLink . '"';
    }
    else
    {
      $output .= ' href="#collapse' . $i . '"';
    }

    $output .= ' class="accordion-toggle"';
    $output .= ' data-toggle="collapse"';
    $output .= ' data-parent="#' . $this->_id . '"';
    $output .= '>';
    $output .= $text;
    $output .= '</a>';
    $output .= '</div>';

    return $output;
  }

  protected function _buildBody($text, $i, $collapseLink = '')
  {
    $cssClass = $i == 1 ? 'in' : '';

    $output = '<div';

    if($collapseLink != '')
    {
      $output .= ' id="' . $collapseLink . '"';
    }
    else
    {
      $output .= ' id="collapse' . $i . '"';
    }

    $output .= ' class="accordion-body collapse ' . $cssClass . '"';
    $output .= '>';
    $output .= '<div';
    $output .= ' class="accordion-inner"';
    $output .= '>';
    $output .= $text;
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  protected function _buildParent()
  {
    $i = 1;

    $output = '<div';
    $output .= ' class="' . $this->_generateParentCss() . '"';
    $output .= ' id="' . $this->_id . '"';
    $output .= '>';

    foreach($this->_items as $item)
    {
      $output .= $this->_buildGroup(
        $item['header'], $item['content'], $i, $item['groupid'], $item['collapseLink']
      );
      $i++;
    }

    $output .= '</div>';

    return $output;
  }

  protected function _generateParentCss()
  {
    $output = 'accordion';
    $output .= " " . $this->getAndUnsetAttribute("class");

    return $output;
  }

  public function render()
  {
    return $this->_buildParent();
  }
}
