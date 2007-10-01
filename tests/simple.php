<?php
    function clean ( $mValue )
    {
        return preg_replace('/[^\d\w\x80-\xff]/', '', $mValue);
    }

    $_GET['grid'] = (!isset($_GET['grid'])) ? 'e24m' : clean($_GET['grid']);

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
        @import '../logicss/typography/medium.css';
        @import '../logicss/grid/<?php echo $_GET['grid']; ?>.css';

        body { background: #2e3436; }
        img { float: left; margin: .25em .5em .25em 0; }
        #container { margin-top: 1em; }
        #nav-sub { background-color: #888a85; }
        #content { background-color: #fafafa; }
        #footer, #footer a { color: #888a85; }
        #footer { border-top: 1px solid #333; text-align: right; }
        #content, #nav-sub { <?php echo (isset($_GET['line'])) ? "background: white url('../gfx/baseline-21.gif');" : ''; ?> }

        .pull7 { margin-left: -14em; }
    </style>
</head>
<body>
    <div id="container" class="content equal">
        <ul id="nav-sub" class="first w6 column">
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Link 4</a></li>
            <li><a href="#">Link 5</a></li>
            <li><a href="#">Link 6</a></li>
        </ul>
        <div id="content" class="w16 last column pc2">
            <h1>Decameron</h1><h6>di Giovanni Boccaccio</h4>
            <hr />
            <p>Umana cosa è aver compassione degli afflitti: e come che a ciascuna persona stea bene, a coloro è massimamente richiesto
li quali già hanno di conforto avuto mestiere e hannol trovato in alcuni; fra quali, se alcuno mai n'ebbe bisogno o
gli fu caro o già ne ricevette piacere, io sono uno di quegli.</p><img src="../gfx/img64.gif" /><p>Per ciò che, dalla mia prima giovinezza infino a questo tempo
oltre modo essendo acceso stato d'altissimo e nobile amore, forse più assai che alla mia bassa condizione non parrebbe,
narrandolo, si richiedesse, quantunque appo coloro che discreti erano e alla cui notizia pervenne io ne fossi lodato
e da molto più reputato, nondimeno mi fu egli di grandissima fatica a sofferire, certo non per crudeltà della donna
amata, ma per soverchio fuoco nella mente concetto da poco regolato appetito: il quale, per ciò che a niuno convenevole
termine mi lasciava un tempo stare, più di noia che bisogno non m'era spesse volte sentir mi facea.</p><p>Nella qual noia tanto
rifrigerio già mi porsero i piacevoli ragionamenti d'alcuno amico le sue laudevoli consolazioni, che io porto fermissima
opinione per quelle essere avvenuto che io non sia morto.</p>
            <img src="../gfx/img64.gif" class="pull-7" />
        </div>
    </div>
    <div id="footer" class="grid content">
        <p>Copyright &copy; 2007 by <a href="http://marcodeltongo.com">Marco Del Tongo</a> et al. <a href="http://logicoder.com/logicss/LICENSE">Licensed under the MIT license.</a></p>
    </div>
</body>
</html>
