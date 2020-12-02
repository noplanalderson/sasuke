<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $heading; ?></title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #4e73df;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #ffd;
	background-color: transparent;
	font-size: 19px;
	font-weight: normal;
	margin-top:-2rem;
	margin-left:12px;
}

code {
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	width: 50%;
	height:300px;
	margin: 10% 25%;
	box-shadow: 0 0 8px #fff;
	background: #fff;
	border-radius: 10px;
}

pre {
	width: 50%;
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
    background: #282828;
    border-left: 5px solid #f36d33;
    color: #fff;
    page-break-inside: avoid;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 1.6em;
    overflow: hidden;
	margin: 10% 25%;
    padding: 1em 1.5em;
    display: block;
    word-wrap: break-word;
    border-radius: 10px;
	box-shadow: 0 0 8px #fff;
}

p {
	margin-left: 12px;
}
</style>
</head>
<body>
<pre>
<h3 style="color:#f00">&lt;oops&gt;</h3>
<h1><?php echo $heading; ?></h1>
<p style="margin-top:-3rem"><?php echo $message; ?></p>
<h3 style="color:#f00;margin-top:-2rem;">&lt;/oops&gt;</h3>
</pre>
</body>
</html>