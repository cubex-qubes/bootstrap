<?php
/**
 * @author  chris.sparshott
 */

namespace Qubes\Bootstrap\Views;

use Cubex\View\HtmlElement;
use Cubex\View\RenderGroup;
use Cubex\View\ViewModel;
use Qubes\Bootstrap\Dropdown;
use Qubes\Bootstrap\Nav;
use Qubes\Bootstrap\NavItem;

class Examples extends ViewModel
{
  public function render()
  {
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

    //var_dump($nav);
    return $nav;

  }
}
