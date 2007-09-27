<?php
    function clean ( $mValue )
    {
        return preg_replace('/[^\d\w\x80-\xff]/', '', $mValue);
    }

    if (!isset($_GET['grid']))
    {
        $_GET['grid'] = 'e24m';
    }
    ob_start ("ob_gzhandler");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us">
<head>
    <title>Logic CSS framework : XHTML Grids Sampler</title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <meta http-equiv="imagetoolbar" content="false" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Logic CSS framework : XHTML Grids Sampler" />
    <link rel="stylesheet" type="text/css" href="../logicss/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../logicss/print.css" media="print" />
    <style type="text/css" media="screen, projection">
        @import '../logicss/font/mix.css';
        @import '../logicss/typography/medium.css';

        @import '../logicss/grid/<?php echo clean($_GET['grid']); ?>.css';

        #container { background: white url('../gfx/grid10.gif') left top repeat; }
        #header { background: url('../gfx/ruler_bw.gif') left top no-repeat; }
        #footer { background: white; border-top: 1px solid #333; text-align: right; }
        #main div, #main span { background: #dedede; margin-bottom: .25em; text-align: center; }
    </style>
</head>
<body class="content">
    <div id="container">
        <div id="header">&nbsp;
        </div>
        <div id="main" class="clear">
            <h1>Logic CSS framework : XHTML Grids Sampler</h1>
            <div>empty div</div>
            <div class="first last w24 column">first last w24 column</div>

            <div class="first col w4">first col w4</div><div class="last col w20">last col w20</div>

            <div class="first col w8">first col w8</div><div class="col w8">col w8</div><div class="last col w8">last col w8</div>

            <div class="first col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div>
            <div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div>
            <div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div>
            <div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div>
            <div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div>
            <div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="col w1">&nbsp;</div><div class="last col w1">&nbsp;</div>

            <span class="col w12 mc12">"col w12 mc12" on a span</span>
            <span class="first last col w12 pr12">"col w12 pr12" on a span</span>
            <span class="first last col w12 ml12">"col w12 ml12" on a span</span>
        </div>
        <div id="footer">
            <p class="small">Copyright &copy; 2007 by <a href="http://marcodeltongo.com">Marco Del Tongo</a> et al. <a href="http://logicoder.com/logicss/LICENSE">Licensed under the MIT license.</a></p>
        </div>
    </div>
</body>
</html>
