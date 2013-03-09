<?php
/**
 * Adds n:src and n:href macros which append timestamp as a parameter to path (e.g. main.js?512a45c4)
 *
 * @author Ondrej Slamecka, www.slamecka.cz
 * @license BSD-3
 */

use Nette\Latte;

class TimestampMacro extends Latte\Macros\MacroSet
{

	public static function install(Latte\Compiler $latteCompiler)
	{
		$set = new static($latteCompiler);
		$set->addMacro('src', NULL, NULL, [$set, 'macroTimestamp']);
		$set->addMacro('href', NULL, NULL, [$set, 'macroTimestamp']);
	}



	public function macroTimestamp(Latte\MacroNode $node, Latte\PhpWriter $writer)
	{
		// Avoid using n:href in anchor (<a>) context
		if ($node->htmlNode->name === 'a') {
			// Cope of function macroLink @ http://api.nette.org/2.1/source-Latte.Macros.UIMacros.php.html
			return $writer->write('echo %escape(%modify(' . ($node->name === 'plink' ? '$_presenter' : '$_control') . '->link(%node.word, %node.array?)))');
		}

		$class = get_called_class();
		return $writer->write('echo \' ' . $node->name . '="\' . ' . $class . '::getFileTimestamp(\'%node.args\', $_presenter->context->parameters[\'wwwDir\']) . \'"\';');
	}



	public static function getFileTimestamp($filename, $wwwDir)
	{
		$filepath = realpath($wwwDir . '/' . $filename);
		if (file_exists($filepath)) {
			$mtime = filemtime($filepath);
			$mtime = dechex($mtime);
		} else {
			$mtime = 0; // Fail silently
		}

		return $filename . '?' . $mtime;
	}

}
