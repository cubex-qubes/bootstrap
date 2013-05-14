<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

use Cubex\View\HtmlElement;

class Pagination extends BootstrapItem
{
  protected $_links;
  protected $_size;
  protected $_align;
  protected $_style;

  const STYLE_DEFAULT = 'pagination';
  const STYLE_PAGER   = 'pager';

  const SIZE_MINI    = 'pagination-mini';
  const SIZE_SMALL   = 'pagination-small';
  const SIZE_DEFAULT = 'default';
  const SIZE_LARGE   = 'pagination-large';

  const ALIGN_CENTER = 'pagination-centered';
  const ALIGN_LEFT   = 'pagination-left';
  const ALIGN_RIGHT  = 'pagination-right';

  public function __construct(
    $links = array(),
    $size = self::SIZE_DEFAULT,
    $align = self::ALIGN_CENTER,
    $style = self::STYLE_DEFAULT
  )
  {
    $this->_links = $links;
    $this->_size  = $size;
    $this->_align = $align;
    $this->_style = $style;
  }

  public function setLinks($links)
  {
    $this->_links = $links;
    return $this;
  }

  public function getLinks()
  {
    return $this->_links;
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

  public function setSize($size)
  {
    $this->_size = $size;
    return $this;
  }

  public function getSize()
  {
    return $this->_size;
  }

  public function setAlignment($align)
  {
    $this->_align = $align;
    return $this;
  }

  public function getAlignment()
  {
    return $this->_align;
  }

  protected function _generateElementCss()
  {
    $output = $this->_style;
    $output .= ' ' . $this->_size;
    $output .= ' ' . $this->_align;

    return $output;
  }

  private function _generateElements()
  {
    $out = '';

    $i = 1;
    foreach($this->_links as $link)
    {
      $li = new HtmlElement('li', ['class' => $link[0]]);
      $a  = new HtmlElement('a', ['href' => $link[1]], $i);

      $out .= $li->nest($a);
      $i++;
    }

    return $out;
  }

  private function _generatePager()
  {
    $output = '<ul class="' . $this->_generateElementCss() . '">';
    $output .= $this->_generateElements();
    $output .= '</ul>';

    return $output;
  }

  private function _generatePagination()
  {
    $output = '<div class="' . $this->_generateElementCss() . '">';
    $output .= '<ul>';
    $output .= $this->_generateElements();
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
  }

  public function render()
  {
    $output = '';
    if($this->_style == self::STYLE_DEFAULT)
    {
      $output .= $this->_generatePagination();
    }
    else
    {
      $output .= $this->_generatePager();
    }

    return $output;
  }
}
