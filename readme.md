Adds macros `n:src` and `n:href`

	<script n:src="/main.js"></script>
	<link n:href="style.css">

to produce code similar to

	<script src="/main.js?512a45c4"></script>
	<link href="style.css?512a45c4">

where `512a45c4` is timestamp which automatically changes when you modify the file (it is filesystem's mtime).


Install
=======

In your config.neon

	nette:
		latte:
			macros:
				- TimestampMacro
