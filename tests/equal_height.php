<?php ob_start ("ob_gzhandler"); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Logic CSS framework : Equal height columns sample</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="imagetoolbar" content="false" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Logic CSS framework : Sample XHTML Page for equal height columns." />
    <?php if (!isset($_GET['unstyled'])) { ?>
    <link rel="stylesheet" type="text/css" href="../logicss/common.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../logicss/print.css" media="print" />
    <style type="text/css" media="screen, projection">
        @import "../logicss/grid/e24m.css";
    </style>
    <?php } # !unstyled ?>
</head>
<body>
<div id="container" style="background: #2e3436;">
    <div id="equal_row" class="equal">
        <div id="a" class="first col w4" style="background: #4e9a06;">
        first col w4 height: auto
        </div>
        <div id="b" class="last col w20" style="background: #5c3566; height: 20em;">
        last col w20 height: 20em
        </div>
    </div>
    <div id="c" class="col w24" style="color: white;">
    Closer
    </div>
</div>
</body>
</html>
