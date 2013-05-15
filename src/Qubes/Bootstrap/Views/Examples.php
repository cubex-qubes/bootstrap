<?php

require '../BootstrapItem.php';
require '../Symbol.php';
require '../Alerts.php';
require '../Badge.php';
require '../Breadcrumbs.php';
require '../Button.php';
require '../ButtonDropdown.php';
require '../ButtonGroup.php';
require '../Dropdown.php';
require '../Icon.php';
require '../Label.php';
require '../Nav.php';
require '../NavItem.php';
require '../Pagination.php';

?>

<!DOCTYPE html>
<head>
  <title>Bootstrap Helpers</title>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <link rel="stylesheet"
        href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css"/>

  <style type="text/css">
    .container-narrow {
      width:700px;
      padding:40px 0;
      margin:0 auto;
    }
  </style>
</head>

<body>

<div id="wrapper">
<div class="container-narrow">
<?php

$content = "";

$class = 'class="clearfix"';
$style = 'style="border-top:1px solid #ccc; margin:30px 0;"';
$hr = '<div ' . $class . ' ' . $style . '></div>';

/**
 * Nav
 */
$nav = new \Qubes\Bootstrap\Nav(\Qubes\Bootstrap\Nav::NAV_PILLS);

$nav->addItem(
  new \Qubes\Bootstrap\NavItem(
    '<a href="#">Link 1</a>',
    \Qubes\Bootstrap\NavItem::STATE_ACTIVE
  )
);

$nav->addItem(
  new \Qubes\Bootstrap\NavItem("A Header", \Qubes\Bootstrap\NavItem::STATE_HEADER)
);

$nav->addItem(
  new \Qubes\Bootstrap\NavItem(
    '<a href="#">Link 2</a>',
    \Qubes\Bootstrap\NavItem::STATE_DISABLED
  )
);

$nav->addItem(new \Qubes\Bootstrap\NavItem("", \Qubes\Bootstrap\NavItem::STATE_DIVIDER));

$nav->addItem(
  (new \Qubes\Bootstrap\NavItem('<a href="#">Link 3</a>'))
);

$dropdownNav = new \Qubes\Bootstrap\Nav();
$dropdownNav->addItem(
  new \Qubes\Bootstrap\NavItem("<a href=\"#\">Item 1</a>")
);
$dropdownNav->addItem(
  new \Qubes\Bootstrap\NavItem("<a href=\"#\">Item 2</a>")
);

$dropdown = new \Qubes\Bootstrap\Dropdown("My Dropdown", $dropdownNav);

$nav->addItem(
  (new \Qubes\Bootstrap\NavItem())->setDropdown($dropdown)
);

$content .= $nav . $hr;

/**
 * Button
 */
$button = new \Qubes\Bootstrap\Button('Button Text 1');

$content .= $button . $hr;

/**
 * button group
 */
$buttons[] = new \Qubes\Bootstrap\Button('Button Text 1');
$buttons[] = new \Qubes\Bootstrap\Button('Button Text 2');
$buttons[] = new \Qubes\Bootstrap\Button('Button Text 3');
$buttonGroup = new \Qubes\Bootstrap\ButtonGroup($buttons);

$content .= $buttonGroup . $hr;

/**
 * Button Dropdowns
 */
$buttonnormal = new \Qubes\Bootstrap\Button('Button Text 1');
$buttonnormal = new \Qubes\Bootstrap\ButtonGroup([$buttonnormal]);

$nav = new \Qubes\Bootstrap\Nav(\Qubes\Bootstrap\Nav::NAV_DROPDOWN);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 1</a>')
);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 2</a>')
);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 1</a>')
);
$buttondrop = new \Qubes\Bootstrap\ButtonDropdown('Dropdown Button 1', $nav, true);
$buttonGroupInside = new \Qubes\Bootstrap\ButtonGroup([$buttondrop]);

//
$nav = new \Qubes\Bootstrap\Nav(\Qubes\Bootstrap\Nav::NAV_DROPDOWN);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 1</a>')
);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 2</a>')
);
$nav->addItem(
  new \Qubes\Bootstrap\NavItem('<a href="#">Link 1</a>')
);
$buttondrop = new \Qubes\Bootstrap\ButtonDropdown('Button Dropdown 2', $nav);
$buttonGroupInsider = new \Qubes\Bootstrap\ButtonGroup([$buttondrop]);

$buttonDropdown = new \Qubes\Bootstrap\ButtonGroup(
  [$buttonnormal, $buttonGroupInside, $buttonGroupInsider]
);

$content .= $buttonDropdown . $hr;

/**
 * Badges and Labels
 */
$badge = new \Qubes\Bootstrap\Badge('Test Badge', \Qubes\Bootstrap\Badge::STYLE_SUCCESS);
$label = new \Qubes\Bootstrap\Label('Test Label', \Qubes\Bootstrap\Label::STYLE_IMPORTANT);

$content .= $badge . $label . $hr;

/**
 * Alerts
 */
$alert = new \Qubes\Bootstrap\Alerts(
  'WARNING!',
  'This is an example alert box',
  \Qubes\Bootstrap\Alerts::STYLE_ERROR,
  \Qubes\Bootstrap\Alerts::SIZE_BLOCK,
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
$breadcrumbs = new \Qubes\Bootstrap\Breadcrumbs($path);

$content .= $breadcrumbs . $hr;

/**
 * Pagination
 */
$baseLink = '/thispage';
$totalPages = 10;
$currentPage = 2;
$pagination = new \Qubes\Bootstrap\Pagination(
  $baseLink,
  $totalPages,
  $currentPage
);

$content .= $pagination . $hr;

echo $content;

?>
</div>
</div>

<script type="text/javascript"
        src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"
        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
</body>
</html>
