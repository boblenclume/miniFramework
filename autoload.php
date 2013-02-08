<?php
$autoload_map = array('src','tests');

spl_autoload_register(
	function ($className) use ($autoload_map) {
		$className = str_replace('\\','/',$className);
		$className = str_replace('_','/',$className);
		
		foreach ($autoload_map as $value){
			if (file_exists(__DIR__ .'/'.$value.'/'.$className.'.php'))
				require_once __DIR__ .'/'. $value .'/'. $className .'.php';
		}
});
