<?php
class LoadPages
{

	public function __construct()
	{
		function loadDao($className)
		{
			if(file_exists($_SERVER['DOCUMENT_ROOT']."dao/".$className.".php"))
			{
				include_once($_SERVER['DOCUMENT_ROOT']."dao/".$className.".php");
			}
		}
			spl_autoload_register("loadDao");

		function loadModel($className)
		{
			if(file_exists($_SERVER['DOCUMENT_ROOT']."model/".$className.".php"))
			{
				include_once($_SERVER['DOCUMENT_ROOT']."model/".$className.".php");
			}
		}
		spl_autoload_register("loadModel");

		function loadController($className)
		{
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/controller/{$className}.php"))
			{
				include_once($_SERVER['DOCUMENT_ROOT']."/controller/{$className}.php");
			}
		}
		spl_autoload_register("loadController");

		function loadView($className)
		{
			if(file_exists($_SERVER['DOCUMENT_ROOT']."view/".$className.".php"))
			{
				include_once($_SERVER['DOCUMENT_ROOT']."view/".$className.".php");
			}
		}
		spl_autoload_register("loadView");

		function loadIndex($className)
		{
			if(file_exists($_SERVER['DOCUMENT_ROOT'].$className.".php"))
			{
				include_once($_SERVER['DOCUMENT_ROOT'].$className.".php");
			}
		}
		spl_autoload_register("loadIndex");


	}

}

new LoadPages();
