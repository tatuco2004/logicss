<?php
/**
 * LogiCSS - Logic CSS framework
 * http://logicss.googlecode.com
 * http://logicoder.com/logicss/
 *
 * The mighty deBLOATER !!!
 * Analyze XHTML pages and CSS styles, remove unused ones and remap semantics.
 *
 * Copyright (c) 2007 Marco Del Tongo et al.
 * Licensed under the MIT license.
 *
 * $Rev$
 * $Author$
 * $HeadURL$
 */

/*
    Commodity functions.
    --------------------
*/

/**
 * Simply an utility function that returns whether parameter is an url.
 *
 * @param   string  $sFilename  Filename to test.
 * @return  boolean True if is an URL, false otherwise.
 */
function is_url ( $sFilename )
{
    return (boolean)preg_match('|^http://|u', $sFilename);
}

/**
 * Converts a CSS selector to a XPath expression.
 *
 * @param   string  $selector   CSS selector.
 * @param   string  $prefix     (Optional) prefix to prepend.
 * @return  string  XPath rule for the passed selector.
 */
function css_to_xpath ( $selector, $prefix = '//' )
{
    /*
        Remove ":" modifiers to simplify parser.
    */
    $selector = trim(preg_replace('|:([-\w]+)|u', '', $selector));
    /*
        Check if we must recurse over a composite selector.
    */
    if (strpos($selector, ' ') !== false)
    {
        $selectors = explode(' ', $selector);
        $xpath_rule = css_to_xpath(array_shift($selectors), $prefix);
        foreach ($selectors as $sub_selector)
        {
            $xpath_rule .= css_to_xpath($sub_selector, $prefix);
        }
        return $xpath_rule;
    }
    // TAG
    if (preg_match('|^([\w]+)$|u', $selector, $matches)) return "$prefix{$matches[1]}";
    // ID
    if (preg_match('|^#([-\w]+)$|u', $selector, $matches)) return "$prefix*[@id='{$matches[1]}']";
    // CLASS
    if (preg_match('|^\.([-\w]+)$|u', $selector, $matches)) return "$prefix*[contains(@class, '{$matches[1]}')]";
    // TAG.CLASS
    if (preg_match('|^([-\w]+)\.([-\w]+)$|u', $selector, $matches)) return "$prefix{$matches[1]}[contains(@class, '{$matches[2]}')]";
    // TAG#ID
    if (preg_match('|^[-\w]+#[-\w]+$|u', $selector, $matches)) return "$prefix{$matches[1]}[@id='{$matches[2]}']";
}

/*
    Prepare needed informations starting from the input data from the userland.
    ---------------------------------------------------------------------------
*/

/*
    Get the filename to analyze.
*/
$source_name = '../tests/template.html';    // DIRECT INJECTION FOR NOW...
$source_dir = (is_url($source_name)) ? dirname($source_name) : dirname(realpath($source_name));

/*
    Load the source HTML file.
*/
$page = @simplexml_load_file($source_name);
$page->registerXPathNamespace('html', 'http://www.w3.org/1999/xhtml');

/*
    Gather information about style-sheets imported inside style tags.
*/
$css_filenames = array();
foreach ($page->head->style as $style)
{
    preg_match_all('|@import [\'"]{1}([\w./]*)[\'"]{1};|u', $style, $matches);
    $css_filenames = array_merge($css_filenames, $matches[1]);
}

/*
    Import CSS rules from stylesheets.
    ----------------------------------
*/
$css_rules = array();
foreach ($css_filenames as $css_filename)
{
    $css_filename = $source_dir . '/' . $css_filename;
    /*
        Translate eventually relative paths to local ones.
    */
    $css_filename = (is_url($css_filename)) ? $css_filename : realpath($css_filename);
    /*
        Load source file as a string.
    */
    $src = file_get_contents($css_filename);
    /*
        Remove CSS comments, make simple lines and remove empty lines.
    */
    $src = preg_replace('|/\*[\s\S]*?\*/|u', '', $src);
    $src = preg_replace(array('|;(?![\n])|', '|(?<![\n]){|', '|{(?![\n])|', '|(?<![\n])}|', '|}(?![\n])|'),
                        array(";\n", "\n{", "{\n", "\n}", "}\n"), $src);
    $src = preg_replace('|^[\r\n]+|m', '', $src);
    /*
        Import CSS rules.
    */
    $src = explode("\n", $src);
    $in_rule = false;
    $selectors = array();
    for ($c = count($src), $i = 0; $i < $c; ++$i)
    {
        $line = trim(trim($src[$i], ','));
        if ($line == '') continue;
        /*
            Check for brackets.
        */
        if ($line == '{')
        {
            $in_rule = true;
            continue;
        }
        elseif ($line == '}')
        {
            $in_rule = false;
            $selectors = array();
            continue;
        }
        if ($in_rule)
        {
            /*
                Should be a rule, go get it.
            */
            $matches = array();
            if (preg_match('|([-\w]+):\s*(.+);|u', $line, $matches))
            {
                /*
                    Save in each selector that have it.
                */
                foreach ($selectors as $selector)
                {
                    $css_rules[$selector][$matches[1]] = $matches[2];
                }
            }
        }
        else
        {
            /*
                Get selectors.
            */
            $matches = explode(',', str_replace(', ', ',', $line));
            $selectors = array_merge($selectors, array_map('trim', $matches));
        }
    }
}

/*
    Run thru the CSS rules and find which are used in the XHTML page.
    -----------------------------------------------------------------
*/
$css = array();
$rewritables = array();
for ($i = 0, $c = count($css_rules), $k = array_keys($css_rules); $i < $c; ++$i)
{
    /*
        Get a XPath rule from the selector.
    */
    $xpath_rule = css_to_xpath($k[$i], '//html:');
    /*
        Get corresponding elements and count.
    */
    $elements = $page->xpath($xpath_rule);
    $n_elements = count($elements);
    if ($elements === false or $n_elements == 0) continue;
    /*
        Search for rewritable selectors/rules to #id/rules.
        Now we have only the needed CSS rules try to set some semantic soup.
    */
    $ic = 0;
    for ($ii = 0; $ii < $n_elements; ++$ii)
    {
        if (!is_null($elements[$ii]['id']))
        {
            ++$ic;
            $id_selector = '#'.$elements[$ii]['id'];
            if (preg_match('|:([-\w]+)|u', $k[$i], $match) === 1)
            {
                $id_selector .= ':'.$match[1];
            }
            if (isset($css[$id_selector]))
            {
                $css[$id_selector] = array_merge($css[$id_selector], $css_rules[$k[$i]]);
            }
            else
            {
                $css[$id_selector] = $css_rules[$k[$i]];
            }
        }
    }
    if ($ic == $n_elements) continue; # All have been rewritten.
    /*
        Save in our new sheet only used selectors.
    */
    $css[$k[$i]] = $css_rules[$k[$i]];
}

/*
    Remove "orphaned" classes from page elements.
    ---------------------------------------------
*/

/*
    Print out the newly created stylesheet and the modified XHTML page to user.
    ---------------------------------------------------------------------------
*/
ksort($css);
$stylesheet = '';
foreach ($css as $selector => $rules)
{
    $stylesheet .= $selector . ' { ';
    ksort($rules);
    foreach ($rules as $style => $value)
    {
        $stylesheet .= $style . ': ' . $value . '; ';
    }
    $stylesheet .= "}\n";
}
echo "CSS:<br /><br />\n" . nl2br($stylesheet);

/*
    Done.
*/
?>
