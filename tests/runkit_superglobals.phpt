--TEST--
runkit.superglobal setting
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT7_FEATURE_MANIPULATION) print "skip"; ?>
--INI--
display_errors=on
runkit.superglobal=foo,bar
--FILE--
<?php
function testme() {
	echo "Foo is $foo\n";
	echo "Bar is $bar\n";
	echo "Baz is $baz\n";
}

ini_set('error_reporting', E_ALL & (~E_DEPRECATED) & ((defined('E_STRICT') ? ~E_STRICT : 0)));

$foo = 1;
$bar = 2;
$baz = 3;

testme();
--EXPECTF--
Foo is 1
Bar is 2

%s: Undefined variable%sbaz in %s on line %d
Baz is
