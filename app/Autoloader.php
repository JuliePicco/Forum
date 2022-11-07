<?php
	namespace App;

	// l'Autoloader joue le rôle de rooter avec l'index.php
	
	class Autoloader{

		public static function register(){
			//pour charger les classes cad qd j'appelle une classe il me trouve le className, le fichier correspondant (permet de ne pas avoir d'erreur car on va appeler bcp de classe)
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		public static function autoload($class){

			//$class = Model\Managers\VehiculeManager (FullyQualifiedClassName)
			//namespace = Model\Managers, nom de la classe = VehiculeManager

			// on explose notre variable $class par \
			$parts = preg_split('#\\\#', $class);
			//$parts = ['Model', 'Managers', 'VehiculeManager']

			// on extrait le dernier element 
			$className = array_pop($parts);
			//$className = VehiculeManager

			// on créé le chemin vers la classe
			// on utilise DS car plus propre et meilleure portabilité entre les différents systèmes (windows/linux) 

			$path = strtolower(implode(DS, $parts));
			//$path = 'model/manager'
			$file = $className.'.php';
			//$file = VehiculeManager.php

			$filepath = BASE_DIR.$path.DS.$file;
			//$filepath = model/managers/VehiculeManager.php
			if(file_exists($filepath)){
              
				require $filepath;
			}
			
		}
	}
