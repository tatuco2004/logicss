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
    <title>Logic CSS framework : Simple Sampler</title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
    <meta http-equiv="imagetoolbar" content="false" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Logic CSS framework : Simple Sampler" />
    <link rel="stylesheet" type="text/css" href="../logicss/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../logicss/print.css" media="print" />
    <style type="text/css" media="screen, projection">
        @import '../logicss/font/mix.css';
        @import '../logicss/typography/small.css';

        @import '../logicss/grid/<?php echo clean($_GET['grid']); ?>.css';

        body { background: #2e3436; }
        #header { margin: 1em 0; }
        #footer, #footer a { color: #888a85; }
        #footer { border-top: 1px solid #333; text-align: right; }
    </style>
</head>
<body>
    <div id="container" class="content">
        <div id="header">
            <img id="branding-logo" src="../gfx/logo.png" alt="Logic CSS framework" />
            <h3 id="branding-tagline">Logic CSS framework : Simple Sampler</h3>
            <ul id="nav-main"></ul>
            <form id="search-input"></form>
        </div>
        <div id="main" class="clear">
        </div>
        <div id="footer">
            <p>Copyright &copy; 2007 by <a href="http://marcodeltongo.com">Marco Del Tongo</a> et al. <a href="http://logicoder.com/logicss/LICENSE">Licensed under the MIT license.</a></p>
        </div>
    </div>
</body>
</html>
