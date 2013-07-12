Adds macros `n:src` and `n:href`

	<script n:src="/main.js"></script>
	<link n:href="style.css">

to produce code similar to

	<script src="/main.js?512a45c4"></script>
	<link href="style.css?512a45c4">

where `512a45c4` is timestamp which automatically changes when you modify the file (it is filesystem's mtime).

Please note that you don't have to & can't use `{$basePath}` with these macros because every path is constructed as `$basePath . '/' . $fileName`.

Install
=======

	$ composer require slamecka/timestamp:dev-master

In your config.neon

	nette:
		latte:
			macros:
				- TimestampMacro

-----

Without license - Public Domain
