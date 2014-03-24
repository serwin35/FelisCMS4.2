<!DOCTYPE HTML>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <!-- mete dane -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="Mateusz Serwinowski (serwin) - Blue-NET.pl">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0, target-densitydpi=115">

    <!-- styles -->
	<link href="{$TEMPLATES}assets/css/style.css" rel="stylesheet" type="text/css">

{block name="head"}{/block}

</head>
<body>

    <!-- header
    ================================================= -->
{include file="assets/helpview/header.tpl"}


    <!-- content
    ================================================= -->
    <section id="content">
    	<div class="container">
{block name="content"}{/block}
		</div>
	</section>


    <!-- footer
    ================================================= -->
{include file="assets/helpview/footer.tpl"}

</body>
</html>