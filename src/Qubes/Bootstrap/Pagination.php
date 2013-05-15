<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap;

use Cubex\View\HtmlElement;

class Pagination extends BootstrapItem
{
  protected $_baseUri;
  protected $_totalPages;
  protected $_currentPage;
  protected $_size;
  protected $_align;
  protected $_style;
  protected $_pageFormat = '%d';

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
    $baseUri,
    $totalPages,
    $currentPage = 1,
    $size = self::SIZE_DEFAULT,
    $align = self::ALIGN_CENTER,
    $style = self::STYLE_DEFAULT
  )
  {
    $this->_baseUri     = "/" . trim($baseUri, "/");
    $this->_totalPages  = $totalPages;
    $this->_size        = $size;
    $this->_align       = $align;
    $this->_style       = $style;

    if($currentPage > $this->_totalPages)
    {
      $this->_currentPage = $this->_totalPages;
    }
    else
    {
      $this->_currentPage = $currentPage;
    }
  }

  public function setBaseUri($baseUri)
  {
    $this->_baseUri = $baseUri;
    return $this;
  }

  public function getBaseUri()
  {
    return $this->_baseUri;
  }

  public function setTotalPages($totalPages)
  {
    $this->_totalPages = $totalPages;
    return $this;
  }

  public function setCurrentPage($currentPage)
  {
    $this->_currentPage = $currentPage;
    return $this;
  }

  public function getCurrentPage()
  {
    return $this->_currentPage;
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

  public function setPageFormat($pageFormat)
  {
    $this->_pageFormat = $pageFormat;
    return $this;
  }

  public function getPageFormat()
  {
    return $this->_pageFormat;
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

    for($i = 1; $i <= $this->_totalPages; $i++)
    {
      if($i == $this->_currentPage)
      {
        $li = new HtmlElement('li', ['class' => 'active']);
      }
      else
      {
        $li = new HtmlElement('li');
      }
      $a = new HtmlElement('a', ['href' => $this->_getHref($i)], $i);
      $out .= $li->nest($a);
    }

    return $out;
  }

  protected function _getHref($page)
  {
    $page = sprintf($this->_pageFormat, $page);
    return $this->_baseUri . '/' . $page;
  }

  private function _generatePrev($content = '&laquo;')
  {
    $output = '';
    if($this->_currentPage > 1)
    {
      $prevPage = $this->_currentPage - 1;

      $li = new HtmlElement('li');
      $a  = new HtmlElement(
        'a',
        ['href' => $this->_baseUri . '/' . $prevPage],
        $content
      );
    }
    else
    {
      $li = new HtmlElement('li', ['class' => 'disabled']);
      $a  = new HtmlElement('a', ['href' => '#'], $content);
    }

    $output .= $li->nest($a);

    return $output;
  }

  private function _generateNext($content = '&raquo;')
  {
    $output = '';
    if($this->_currentPage < $this->_totalPages)
    {
      $nextPage = $this->_currentPage + 1;

      $li = new HtmlElement('li');
      $a  = new HtmlElement(
        'a',
        ['href' => $this->_baseUri . '/' . $nextPage],
        $content
      );
    }
    else
    {
      $li = new HtmlElement('li', ['class' => 'disabled']);
      $a  = new HtmlElement('a', ['href' => '#'], $content);
    }

    $output .= $li->nest($a);

    return $output;
  }

  private function _generatePagination()
  {
    $output = '<div class="' . $this->_generateElementCss() . '">';
    $output .= '<ul>';
    $output .= $this->_generatePrev();
    $output .= $this->_generateElements();
    $output .= $this->_generateNext();
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
  }

  private function _generatePager()
  {
    $output = '<ul class="' . $this->_generateElementCss() . '">';
    $output .= $this->_generatePrev('Prev');
    $output .= $this->_generateNext('Next');
    $output .= '</ul>';

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
