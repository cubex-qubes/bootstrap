<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap\Views;

use Cubex\View\HtmlElement;
use Cubex\View\RenderGroup;
use Cubex\View\ViewModel;
use Qubes\Bootstrap\Alerts;
use Qubes\Bootstrap\BadgeLabel;
use Qubes\Bootstrap\Breadcrumbs;
use Qubes\Bootstrap\Button;
use Qubes\Bootstrap\ButtonDropdown;
use Qubes\Bootstrap\ButtonGroup;
use Qubes\Bootstrap\Dropdown;
use Qubes\Bootstrap\Nav;
use Qubes\Bootstrap\NavItem;
use Qubes\Bootstrap\Pagination;

class Examples extends ViewModel
{
  public function render()
  {
    $content = "";

    /**
     * Nav
     */
    $nav = new Nav(Nav::NAV_PILLS);

    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 1"),
        NavItem::STATE_ACTIVE
      )
    );

    $nav->addItem(
      new NavItem("A Header", NavItem::STATE_HEADER)
    );

    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 2"),
        NavItem::STATE_DISABLED
      )
    );

    $nav->addItem(new NavItem("", NavItem::STATE_DIVIDER));

    $nav->addItem(
      (new NavItem(new HtmlElement("a", ["href" => "#"], "Link 3")))
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

    $content .= $nav;

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

    $content .= $buttonGroup;

    /**
     * Button Dropdowns
     */
    $buttonnormal = new Button('Button Text 1');
    $buttonnormal = new ButtonGroup([$buttonnormal]);

    $nav = new Nav(Nav::NAV_DROPDOWN);
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 1")
      )
    );
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 2")
      )
    );
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 3")
      )
    );
    $buttondrop = new ButtonDropdown('Dropdown Button 1', $nav, true);
    $buttonGroupInside = new ButtonGroup([$buttondrop]);

    //
    $nav = new Nav(Nav::NAV_DROPDOWN);
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 1")
      )
    );
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 2")
      )
    );
    $nav->addItem(
      new NavItem(
        new HtmlElement("a", ["href" => "#"], "Link 3")
      )
    );
    $buttondrop = new ButtonDropdown('Button Dropdown 2', $nav);
    $buttonGroupInsider = new ButtonGroup([$buttondrop]);

    $buttonDropdown = new ButtonGroup(
      [$buttonnormal, $buttonGroupInside, $buttonGroupInsider]
    );

    $content .= $buttonDropdown;

    /**
     * Badges and Labels
     */
    $badge = new BadgeLabel(
      'Test Badge',
      BadgeLabel::ELEMENT_BADGE,
      BadgeLabel::STYLE_SUCCESS
    );
    $label = new BadgeLabel(
      'Test Label',
      BadgeLabel::ELEMENT_LABEL, BadgeLabel::STYLE_WARNING
    );
    $badgeLabel = $badge . $label;

    $content .= $badgeLabel;

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

    $content .= $alert;

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
    $content .= $breadcrumbs;

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
    $content .= $pagination;

    return $content;
  }
}
