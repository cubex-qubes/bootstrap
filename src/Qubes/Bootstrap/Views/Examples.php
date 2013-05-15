<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap\Views;

use Cubex\View\RenderGroup;
use Cubex\View\ViewModel;
use Qubes\Bootstrap\Alerts;
use Qubes\Bootstrap\Badge;
use Qubes\Bootstrap\Breadcrumbs;
use Qubes\Bootstrap\Button;
use Qubes\Bootstrap\ButtonDropdown;
use Qubes\Bootstrap\ButtonGroup;
use Qubes\Bootstrap\Dropdown;
use Qubes\Bootstrap\Label;
use Qubes\Bootstrap\Nav;
use Qubes\Bootstrap\NavItem;
use Qubes\Bootstrap\Pagination;

class Examples extends ViewModel
{
  public function render()
  {
    $content = "";

    $class = 'class="clearfix"';
    $style = 'style="border-top:1px solid #ccc; margin:30px 0;"';
    $hr = '<div ' . $class . ' ' . $style . '></div>';

    /**
     * Nav
     */
    $nav = new Nav(Nav::NAV_PILLS);

    $nav->addItem(
      new NavItem(
        '<a href="#">Link 1</a>',
        NavItem::STATE_ACTIVE
      )
    );

    $nav->addItem(
      new NavItem("A Header", NavItem::STATE_HEADER)
    );

    $nav->addItem(
      new NavItem(
        '<a href="#">Link 2</a>',
        NavItem::STATE_DISABLED
      )
    );

    $nav->addItem(new NavItem("", NavItem::STATE_DIVIDER));

    $nav->addItem(
      (new NavItem('<a href="#">Link 3</a>'))
    );

    $dropdownNav = new Nav();
    $dropdownNav->addItem(
      new NavItem("<a href=\"#\">Item 1</a>")
    );
    $dropdownNav->addItem(
      new NavItem("<a href=\"#\">Item 2</a>")
    );

    $dropdown = new Dropdown("My Dropdown", $dropdownNav);

    $nav->addItem(
      (new NavItem())->setDropdown($dropdown)
    );

    $content .= $nav . $hr;

    /**
     * Button
     */
    $button = new Button('Button Text 1');

    $content .= $button;

    /**
     * button group
     */
    $buttons[] = new Button('Button Text 1');
    $buttons[] = new Button('Button Text 2');
    $buttons[] = new Button('Button Text 3');
    $buttonGroup = new ButtonGroup($buttons);

    $content .= $buttonGroup . $hr;

    /**
     * Button Dropdowns
     */
    $buttonnormal = new Button('Button Text 1');
    $buttonnormal = new ButtonGroup([$buttonnormal]);

    $nav = new Nav(Nav::NAV_DROPDOWN);
    $nav->addItem(
      new NavItem('<a href="#">Link 1</a>')
    );
    $nav->addItem(
      new NavItem('<a href="#">Link 2</a>')
    );
    $nav->addItem(
      new NavItem('<a href="#">Link 1</a>')
    );
    $buttondrop = new ButtonDropdown('Dropdown Button 1', $nav, true);
    $buttonGroupInside = new ButtonGroup([$buttondrop]);

    //
    $nav = new Nav(Nav::NAV_DROPDOWN);
    $nav->addItem(
      new NavItem('<a href="#">Link 1</a>')
    );
    $nav->addItem(
      new NavItem('<a href="#">Link 2</a>')
    );
    $nav->addItem(
      new NavItem('<a href="#">Link 1</a>')
    );
    $buttondrop = new ButtonDropdown('Button Dropdown 2', $nav);
    $buttonGroupInsider = new ButtonGroup([$buttondrop]);

    $buttonDropdown = new ButtonGroup(
      [$buttonnormal, $buttonGroupInside, $buttonGroupInsider]
    );

    $content .= $buttonDropdown . $hr;

    /**
     * Badges and Labels
     */
    $badge = new Badge('Test Badge', Badge::STYLE_SUCCESS);
    $label = new Label('Test Label', Label::STYLE_IMPORTANT);

    $content .= $badge . $label . $hr;

    /**
     * Alerts
     */
    $alert = new Alerts(
      'WARNING!',
      'This is an example alert box',
      Alerts::STYLE_ERROR,
      Alerts::SIZE_BLOCK,
      true
    );

    $content .= $alert . $hr;

    /**
     * Breadcrumbs
     * In most cases you would pass: $this->request()->path()
     *
     * But you can also pass in an array:
     * $path = array(
     * 'Part1',
     * 'Part2',
     * 'Part3',
     * );
     */
    $path = array(
      'Part1',
      'Part2',
      'Part3',
    );
    //$breadcrumbs = new Breadcrumbs($this->request()->path());
    $breadcrumbs = new Breadcrumbs($path);

    $content .= $breadcrumbs . $hr;

    /**
     * Pagination
     */
    $baseLink = '/thispage';
    $totalPages = 10;
    $currentPage = 2;
    $pagination = new Pagination(
      $baseLink,
      $totalPages,
      $currentPage
    );

    $content .= $pagination . $hr;

    return $content;
  }
}
