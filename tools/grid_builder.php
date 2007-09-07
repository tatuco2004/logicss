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

/*
    TO DO:
    
    - Vertical alignment
*/

// NAME
$name = (empty($_POST['name'])) ? "Custom grid" : $_POST['name'];
// WIDTH
$width = (isset($_POST['width']) and is_numeric($_POST['width'])) ? (float)$_POST['width'] : false;
// COLUMNS
$columns = (isset($_POST['columns']) and is_numeric($_POST['columns'])) ? (int)$_POST['columns'] : false;
// COLUMN WIDTH
$col_width = (isset($_POST['col_width']) and is_numeric($_POST['col_width'])) ? (float)$_POST['col_width'] : false;
// LAYOUT STYLE
$layout = (isset($_POST['layout'])) ? $_POST['layout'] : "fixed";
// H-ALIGN
$halign = (isset($_POST['h-align'])) ? $_POST['h-align'] : false;
// V-ALIGN
$valign = (isset($_POST['v-align'])) ? $_POST['v-align'] : false;
// SPACING
$spacing = (isset($_POST['spacing'])) ? $_POST['spacing'] : "margin";
// SPACING VALUE
$spacing_value = (isset($_POST['spacing_value']) and is_numeric($_POST['spacing_value'])) ? (float)$_POST['spacing_value'] : false;
// SPACING SIDES
$spacing_sides = (isset($_POST['spacing_sides'])) ? $_POST['spacing_sides'] : "both";
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
    if (($width === false) or ($columns === false))
    {
        die("To calculate the column width, I need both container width and number of columns.");
    }
    $col_width = $width / $columns;
    if ($spacing !== 'none')
    {
        if ($spacing_value === false)
        {
            $col_width *= .75;
        }
        else
        {
            $col_width -= ($spacing_sides !== 'both') ? $spacing_value : $spacing_value * 2;
        }
    }
    $col_width = ($unit == 'px') ? round($col_width) : round($col_width, 2);
}

/*
    Get or calculate spacing value.
*/
if ($spacing_value === false)
{
    if ($spacing_sides !== 'both')
    {
        $space = ($unit == 'px') ? round($col_width / 3) : round($col_width / 3, 2);
    }
    else
    {
        $space = ($unit == 'px') ? round($col_width / 6) : round($col_width / 6, 2);
    }
}
else
{
    $space = $spacing_value;
}

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
    $cut = (($gutter) ? $margin + $padding : 0);
    $box = $col_width + $margin + $padding;
}
else
{
    $cut = (($gutter) ? ($margin + $padding) * 2 : 0);
    $box = $col_width + (($margin + $padding) * 2);
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
$_ = array();
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
    Now the Column.
*/
$_['.column'] = array('float' => 'left', 'overflow' => 'visible', 'clear' => 'none');

if ($$spacing != 0) # Setup spacing
{
    if ($spacing_sides !== 'both')
    {
    	$_['.column'][$spacing.'-'.$spacing_sides] = $$spacing . $unit; 
    }
    else
    {
    	$_['.column'][$spacing.'-left'] = $$spacing . $unit;
    	$_['.column'][$spacing.'-right'] = $$spacing . $unit;
    }
}

/*
    First and Last.
*/
$_['.first'] = array('clear' => 'left');
$_['.last'] = array('clear' => 'right');

if ($gutter or $$spacing != 0) # Add gutter removal
{
    /*
        Reset both to mantain compatibility with .padding and .margin
    */
    $_['.first']['margin-left'] = 0;
    $_['.first']['padding-left'] = 0;
    $_['.last']['margin-right'] = 0;
    $_['.last']['padding-right'] = 0;
}

/*
    Padding and Margin.
*/
$_['.padding'] = array();
$_['.margin'] = array();

if ($$spacing != 0)
{
    switch ($spacing) # Prepare only needed ones
    {
        case 'margin':
            if ($spacing_sides !== 'both')
            {
            	$_['.padding'][$spacing.'-'.$spacing_sides] = 0;
            	$_['.padding']['padding-'.$spacing_sides] = $$spacing . $unit;
            }
            else
            {
                $_['.padding']['margin-left'] = 0;
                $_['.padding']['margin-right'] = 0;
                $_['.padding']['padding-left'] = $$spacing . $unit;
                $_['.padding']['padding-right'] = $$spacing . $unit;
            }
        break;
        case 'padding':
            if ($spacing_sides !== 'both')
            {
            	$_['.margin'][$spacing.'-'.$spacing_sides] = 0;
            	$_['.margin']['margin-'.$spacing_sides] = $$spacing . $unit;
            }
            else
            {
                $_['.margin']['margin-left'] = $$spacing . $unit;
                $_['.margin']['margin-right'] = $$spacing . $unit;
                $_['.margin']['padding-left'] = 0;
                $_['.margin']['padding-right'] = 0;
            }
        break;
    }
}

/*
    Commodity functions.
*/

/**
 * Writes a selector with it's rules.
 * 
 * @param   string  $name       Selector tag, id or class name
 * @param   string  $alt_name   Alternative selector tag, id or class name
 * @param   string  $empty      Wheter to print empty selectors
 */
function selector ($name, $alt_name = false, $empty = false)
{
    global $_;
    if (!$empty and empty($_[$name])) return;
    $alt_name = ($alt_name !== false) ? ", $alt_name" : '';
    echo "$name$alt_name\n{\n";
    rules($_[$name]);
    echo "}\n";
}

/**
 * Write CSS rules.
 */
function rules (&$data)
{
    ksort($data);
    foreach ($data as $rule => $value)
    {
        echo str_pad("    $rule: ", 20), $value, ";\n";
    }    
}

/*
    Print the CSS grid.
*/
ob_start ("ob_gzhandler");
header("Content-type: text/css; charset: UTF-8");
?>
/**
 * NAME......:    <?=$name;?> 
 * WIDTH.....:    <?=$width.$unit;?>  
 * COLUMNS...:    <?=$columns;?>  
 * C_WIDTH...:    <?=$col_width.$unit;?> 
 * LAYOUT....:    <?=ucfirst($layout);?> 
 * H-ALIGN...:    <?=ucfirst($halign);?> 
 * V-ALIGN...:    <?=ucfirst($valign);?> 
 * SPACING...:    <?=ucfirst($spacing);?> <?=ucfirst($spacing_sides);?> [<?=($margin + $padding).$unit;?>]
 * GUTTER....:    <?=($gutter) ? "Removed $cut$unit" : "Present";?> 
 * SPANNING..:    <?=ucfirst($spanning);?> 
 *
 * Generated by LogiCSS Grid Builder on <?=date('Y-m-d');?>.
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
    Use these classes to overwrite single columns spacing style.
*/
<?php
    selector('.padding', false, true);
    selector('.margin', false, true);
?>

/*
    Use following classes to set column width.
*/
<?php
    for ($val = $col_width, $i = 1; $i < $columns; ++$i)
    {
        echo ".span-$i, .w$i { width: $val$unit; }\n";
        $val += $box;
    }
    echo ".span-$i, .w$i { width: $val$unit; ",
        (($gutter or $$spacing != 0) ? $spacing . '-left: 0; '  : ''),
        (($gutter or $$spacing != 0) ? $spacing . '-right: 0; '  : ''),
         "}\n";
?>

/*
    Add these to a column to prepend empty columns using default spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".prepend-$i, .pre-$i { {$spanning}-left: $val$unit; }\n";
        $val += $box;
    }
    echo ".prepend-$i, .pre-$i { {$spanning}-left: $val$unit; " , (($gutter or $$spacing != 0) ? $spacing . '-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to append empty columns using default spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".append-$i, .app-$i { {$spanning}-right: $val$unit; }\n";
        $val += $box;
    }
    echo ".append-$i, .app-$i { {$spanning}-right: $val$unit; " , (($gutter or $$spacing != 0) ? $spacing . '-left: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using left padding spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".pl$i { padding-left: $val$unit; }\n";
        $val += $box;
    }
    echo ".pl$i { padding-left: $val$unit; " , (($gutter or $$spacing != 0) ? 'margin-left: 0; margin-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using right padding spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".pr$i { padding-right: $val$unit; }\n";
        $val += $box;
    }
    echo ".pr$i { padding-right: $val$unit; " , (($gutter or $$spacing != 0) ? 'margin-left: 0; margin-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using centering padding spacing style.
*/
<?php
    for ($val = $box / 2, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".pc$i { padding-left: $val$unit; padding-right: $val$unit; }\n";
        $val += $box / 2;
    }
    echo ".pc$i { padding-left: $val$unit; padding-right: $val$unit; " , (($gutter or $$spacing != 0) ? 'margin-left: 0; margin-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using left margin spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".ml$i { margin-left: $val$unit; }\n";
        $val += $box;
    }
    echo ".ml$i { margin-left: $val$unit; " , (($gutter or $$spacing != 0) ? 'padding-left: 0; padding-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using right margin spacing style.
*/
<?php
    for ($val = $box, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".mr$i { margin-right: $val$unit; }\n";
        $val += $box;
    }
    echo ".mr$i { margin-right: $val$unit; " , (($gutter or $$spacing != 0) ? 'padding-left: 0; padding-right: 0; '  : '') , "}\n";
?>

/*
    Add these to a column to prepend empty columns using centering margin spacing style.
*/
<?php
    for ($val = $box / 2, $i = 1; $i < ($columns - 1); ++$i)
    {
        echo ".mc$i { margin-left: $val$unit; margin-right: $val$unit; }\n";
        $val += $box / 2;
    }
    echo ".mc$i { margin-left: $val$unit; margin-right: $val$unit; " ,
        (($gutter or $$spacing != 0) ? 'padding-left: 0; padding-right: 0; '  : '') , "}\n";
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

/*
    Add this to a div enclosing a row of columns to have them have equal heights.
*/
.equal
{
    overflow:       hidden;
}
.equal .column, .equal .col
{
    margin-bottom: -1000px;
    padding-bottom: 1000px;
}

/* -------------------------------------------------------------------------- */