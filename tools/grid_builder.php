<?php
/**
 * LogiCSS - Logic CSS framework
 * http://logicss.googlecode.com
 * http://logicoder.com/logicss/
 *
 * Grid builder.
 *
 * Copyright (c) 2007 Marco Del Tongo et al.
 * Licensed under the MIT license.
 *
 * $Rev$
 * $Author$
 * $HeadURL$
 */

ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");

/**
 * Data container
 */
$_ = array();

// NAME
$name = (empty($_POST['name'])) ? "Custom grid" : $_POST['name'];
// WIDTH
$width = (is_numeric($_POST['width'])) ? (float)$_POST['width'] : false;
// COLUMNS
$columns = (is_numeric($_POST['columns'])) ? (int)$_POST['columns'] : false;
// COLUMN WIDTH
$col_width = (is_numeric($_POST['col_width'])) ? (float)$_POST['col_width'] : false;
// LAYOUT STYLE
$layout = (isset($_POST['layout'])) ? $_POST['layout'] : "fixed";
// H-ALIGN
$halign = (isset($_POST['h-align'])) ? $_POST['h-align'] : false;
// V-ALIGN
$valign = (isset($_POST['v-align'])) ? $_POST['v-align'] : false;
// SPACING
$spacing = (isset($_POST['spacing'])) ? $_POST['spacing'] : "margin";
// SPACING VALUE
$spacing_value = (is_numeric($_POST['spacing_value'])) ? (float)$_POST['spacing_value'] : false;
// SPACING SIDES
$spacing_sides = (isset($_POST['spacing_sides'])) ? $_POST['spacing_sides'] : "both";
// BORDER
#$border = (is_numeric($_POST['border'])) ? (float)$_POST['border'] : 0;
$border = 0;
// SPANNING
$spanning = (isset($_POST['spanning'])) ? $_POST['spanning'] : "margin";
// GUTTER
$gutter = (isset($_POST['gutter'])) ? (boolean)$_POST['gutter'] : false;

/*
    Unit type from layout.
*/
$unit = ($layout == 'elastic') ? 'em' : (($layout == 'fixed') ? 'px' : '%');

/*
    Calculate column width if not given.
*/
if ($col_width === false)
{
    if (($width == false) or ($columns == false))
    {
        die("To calculate the column width, I need both container width and number of columns.");
    }
    $col_width = (($unit == 'px') ? ceil($width / $columns) : ($width / $columns)) * .75;
}

/*
    Get or calculate spacing value.
*/
$space = ($spacing_value !== false) ? $spacing_value : (($unit == 'px') ? ceil($col_width / 6) : $col_width / 6);

/*
    Setup column spacing.
*/
switch ($spacing)
{
    case 'margin':
        $margin = $space;
        $padding = 0;
    break;
    case 'padding':
        $margin = 0;
        $padding = $space;
    break;
    case 'none':
        $margin = 0;
        $padding = 0;
        $spacing = 'margin';
    break;
}

/*
    Save total space occupied by column.
*/
if ($spacing_sides !== 'both')
{
    $cut = (($gutter) ? $margin + $padding + $border : 0);
    $box = $col_width + $margin + $padding + $border;
}
else
{
    $cut = (($gutter) ? ($margin + $padding + $border) * 2 : 0);
    $box = $col_width + (($margin + $padding + $border) * 2);
}

/*
    Calculate number of columns if not given.
*/
if ($columns === false)
{
    if (($width == false) or ($col_width == false))
    {
        die("To calculate the number of columns, I need both container and column width.");
    }
    $columns = round($width / $box);
}

/*
    Calculate grid width, overwriting given value.
*/
$width = ($columns * $box) - $cut;

/*
    Define treated selectors.
*/
$_['#container'] = array();
$_['body'] = array();
$_['.column'] = array();

/*
    Setup container.
*/
$_['#container']['position']	    = 'relative';
$_['#container']['padding']         = '0';
$_['#container']['text-align']      = 'left';
$_['#container']['overflow']        = 'hidden';
$_['#container']['clear']           = 'both';
$_['#container']['margin-top']      = '0';
$_['#container']['margin-bottom']	= '0';
$_['#container']['width']           = $width.$unit.' !important';

/*
    Horizontal container alignment.
*/
switch ($halign)
{
    case 'left':
        $_['#container']['margin-left']     = '0';
        $_['#container']['margin-right']    = 'auto';
        $_['body']['text-align']            = 'left';
    break;
    case 'center':
        $_['#container']['margin-left']     = 'auto';
        $_['#container']['margin-right']    = 'auto';
        $_['body']['text-align']            = 'center';
    break;
    case 'right':
        $_['#container']['margin-left']     = 'auto';
        $_['#container']['margin-right']    = '0';
        $_['body']['text-align']            = 'right';
    break;
    default:
        $_['#container']['margin-left']     = '0';
        $_['#container']['margin-right']    = '0';
    break;
}

/*
    Vertical container alignment.
*/
# TO DO !!!

/*
    Now the columns.
*/
$_['.column'] = array('float' => 'left', 'overflow' => 'visible', 'clear' => 'none');

if ($spacing_sides !== 'both')
{
	$_['.column'][$spacing] = "0";
	$_['.column'][$spacing.'-'.$spacing_sides] = "${$spacing}$unit"; 
}
else
{
	$_['.column'][$spacing] = "0 ${$spacing}$unit"; 
}
$_['.first'] = array('clear' => 'left');
$_['.last'] = array('clear' => 'right');
if ($gutter)
{
    $_['.first'][$spacing.'-left'] = 0 . $unit;
    $_['.last'][$spacing.'-right'] = 0 . $unit;
}
/*
    Commodity functions.
*/
function selector ($name, $alt_name = false)
{
    global $_;
    if (!empty($_[$name]))
    {
        $alt_name = ($alt_name !== false) ? ", $alt_name" : '';
        echo "$name$alt_name\n{\n";
        rules($_[$name]);
        echo "}\n";
    }
}
function rules (&$data)
{
    ksort($data);
    foreach ($data as $rule => $value)
    {
        echo str_pad("    $rule:", 20), $value, ";\n";
    }    
}
?>
/**
 * NAME......:    <?=$name;?> 
 * WIDTH.....:    <?=$width.$unit;?>  
 * COLUMNS...:    <?=$columns;?>  
 * C_WIDTH...:    <?=$col_width.$unit;?> 
 * LAYOUT....:    <?=ucfirst($layout);?> 
 * H-ALIGN...:    <?=ucfirst($halign);?> 
 * V-ALIGN...:    <?=ucfirst($valign);?> 
 * SPACING...:    <?=ucfirst($spacing);?> [<?=($margin + $padding).$unit;?>]
 * GUTTER....:    <?=($gutter) ? "Removed $cut$unit" : "Present";?> 
 * BORDER....:    <?=$border.$unit;?> 
 * SPANNING..:    <?=ucfirst($spanning);?> 
 */

/* -------------------------------------------------------------------------- */

/*
    Define container for all columns.
*/
<?php
    selector('#container');
    selector('body');
?>

/*
    Clearfix.
*/
#container, .clear
{
    zoom:           1;
}
#container:after, .clear:after
{
    clear:          both;
    content:        ".";
    display:        block;
    height:         0;
    visibility:     hidden;
}

/*
    Columns.
*/
<?php
    selector('.column', '.col');
?>
/*
    Fix for IE double margin bug.
*/
div.column, div.col
{
    display:        inline;
}
/*
    Clean children.
*/
.column div, .col div
{
    <?=$spacing?>:         0;
}

/*
    Ensure row cleaning.
*/
<?php
    selector('.first');
    selector('.last');
?>

/*
    Use following classes to set column width.
*/
<?php
    for ($val = $col_width, $i = 1; $i < $columns; ++$i)
    {
        echo ".span-$i, w-$i { width: $val$unit; }\n";
        $val += $box;
    }
    echo ".span-$i, w-$i { width: $val$unit; " , (($gutter) ? $spacing . ': 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".prepend-$i, pre-$i { {$spanning}-left: $val$unit; }\n";
        $val += $box;
    }
    echo ".prepend-$i, pre-$i { {$spanning}-left: $val$unit; " , (($gutter) ? $spacing . '-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to append empty columns.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".append-$i, app-$i { {$spanning}-right: $val$unit; }\n";
        $val += $box;
    }
    echo ".append-$i, app-$i { {$spanning}-right: $val$unit; " , (($gutter) ? $spacing . '-left: 0; '  : '') , "}\n";
?>

/*
    Commodity classes.
*/

.left
{
    float:          left;
}
.right
{
    float:          right;
}

/* -------------------------------------------------------------------------- */