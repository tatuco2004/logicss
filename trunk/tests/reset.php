<?php ob_start ("ob_gzhandler"); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Logic CSS framework : Sample Page for Reset.css</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="imagetoolbar" content="false" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Logic CSS framework : Sample XHTML Page for Reset.css" />
    <?php if (!isset($_GET['unstyled'])) { ?>
    <link rel="stylesheet" type="text/css" href="../logicss/reset.css" media="all" />
    <!--[if IE]><link rel="stylesheet" type="text/css" href="../logicss/reset-ie.css" media="all" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="../logicss/print.css" media="print" />
    <?php } # !unstyled ?>
</head>
<body>
<div id="container">
    <!-- MAIN -->
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus.
        Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus.</p>
    <hr />
    <h1>Heading 1</h1>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <h2>Heading 2</h2>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <h3>Heading 3</h3>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <h4>Heading 4</h4>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <h5>Heading 5</h5>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <h6>Heading 6</h6>
    <p>Sed scelerisque sagittis lorem. Phasellus sodales. Nulla urna justo, vehicula in, suscipit nec, molestie sed, tellus. Quisque justo. Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu. Integer dignissim fermentum enim. Morbi convallis felis vel nibh. Etiam viverra augue non enim.</p>

    <hr />
    <blockquote>This is a Blockquote.<br />
        This another Blockquote line.
        <p><q>Quotes in P in Blockquote.</q></p>
        <p>Paragraphs inside Blockquote:<br />Nam libero leo, elementum in, dapibus a, suscipit vitae, purus. Duis arcu.</p>
    </blockquote>

    <p><q>Quotes in P outside Blockquote.</q></p>
    
    <address>Address: Example address 224, Sweden</address>

    <pre><strong>PRE:</strong>Testing one row
         and another</pre>

    <p>
    I am <a href="?abc123">the a tag</a> example<br />
    I am <abbr title="ABBR!">the abbr tag</abbr> example<br />
    I am <acronym>the acronym tag</acronym> example<br />
    I am <b>the b tag</b> example<br />
    I am <big>the big tag</big> example<br />
    I am <cite>the cite tag</cite> example<br />
    I am <code>the code tag</code> example<br />
    I am <del>the del tag</del> example<br />
    I am <dfn>the dfn tag</dfn> example<br />
    I am <em>the em tag</em> example<br />
    I am <font face="comic sans">the font tag</font> example<br />
    I am <i>the i tag</i> example<br />
    I am <ins>the ins tag</ins> example<br />
    I am <kbd>the kbd tag</kbd> example<br />
    I am <s>the s tag</s> example<br />
    I am <samp>the samp tag</samp> example<br />
    I am <small>the small tag</small> example<br />
    I am <span>the span tag</span> example<br />
    I am <strike>the strike tag</strike> example<br />
    I am <strong>the strong tag</strong> example<br />
    I am <sub>the sub tag</sub> example<br />
    I am <sup>the sup tag</sup> example<br />
    I am <tt>the tt tag</tt> example<br />
    I am <var>the var tag</var> example<br />
    I am <u>the u tag</u> example
    </p>
    <hr />
    <h3>Unordered list:</h3>
    <ul>
        <li>Unordered list 01</li>
        <li>Unordered list 02<br />with a second line</li>
        <li>Unordered list 03
            <ul>
                <li>Unordered list inside list level 2</li>
                <li>Unordered list inside list level 2
                    <ul>
                        <li>Unordered list inside list level 3</li>
                        <li>Unordered list inside list level 3</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>Unordered list 04</li>
    </ul>
    <hr />
    <h3>Ordered list:</h3>
    <ol>
        <li>Ordered list 01</li>
        <li>Ordered list 02<br />with a second line</li>
        <li>Ordered list 03
            <ol>
                <li>Ordered list inside list level 2</li>
                <li>Ordered list inside list level 2
                    <ol>

                        <li>Ordered list inside list level 3</li>
                        <li>Ordered list inside list level 3</li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>Ordered list 04</li>
    </ol>
    <hr />
    <h3>Description list:</h3>
    <dl>
        <dt>Description list title 01</dt>
        <dd>Description list description 01</dd>
        <dt>Description list title 02</dt>
        <dd>Description list description 02<br />with a second line</dd>
        <dd>Description list description 03</dd>
    </dl>
    <hr />
    <h3>Table:</h3>
    <table summary="Test table">
        <caption>Table Caption</caption>
        <thead>
            <tr>
                <th>Table head th</th>
                <td>Table head td</td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Table foot th</th>
                <td>Table foot td</td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <th>Table body th</th>
                <td>Table body td<br/>second line</td>
            </tr>
            <tr>
                <td>Table body td</td>
                <td>Table body td</td>
            </tr>
        </tbody>
    </table>
    <hr />
    <h3>Form:</h3>
    <form action="#">
    <fieldset>
        <legend>Form legend</legend>
        <ul>
        <li><label for="f0">Text input:</label><input type="text" id="f0" value="input text" /></li>
        <li><label for="f1">Text input:</label><input type="text" id="f1" value="input text" /></li>
        <li><label>Radio input:</label>
            <ol>
               <li><input name="RadioGroup1" type="radio" id="f2_0" value="Test" /><label for="f2_0">Yes</label></li>
               <li><input name="RadioGroup1" type="radio" id="f2_1" value="Test" /><label for="f2_1">No</label></li>
            </ol>
        </li>
        <li><label>Radio input:</label>
            <div class="choices">
                <input name="RadioGroup2" type="radio" id="f2_20" value="Test2" /><label for="f2_20">Yes</label>
                <input name="RadioGroup2" type="radio" id="f2_21" value="Test" /><label for="f2_21">No</label>
                <input name="RadioGroup2" type="radio" id="f2_22" value="Test" /><label for="f2_22">Uh?</label>
            </div>
        </li>
        <li><label for="f3">Checkbox input:</label><input type="checkbox" id="f3" /></li>
        <li><label for="f4">Select field:</label><select id="f4"><option>Option 01</option><option>Option 02</option></select></li>
        <li><label for="f5">Textarea:</label><br /><textarea id="f5" rows="10" cols="30">Textarea text</textarea></li>
        <li class="buttons"><label>&nbsp;</label><input type="button" id="f6" value="button text" /><input type="submit" id="f7" value="submit" /></li>
        </ul>
    </fieldset>
    </form>
	<!-- ~MAIN -->
</div>
</body>
</html>