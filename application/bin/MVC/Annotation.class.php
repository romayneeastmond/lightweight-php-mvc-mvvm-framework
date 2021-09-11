<?php
	class Annotation
	{
		/**
         * Discovers all the annotations of a given class file
         *
         * @param string             $class a class file
         * @return array
         */
		public static function discover($class)
		{
			try
			{
				if (!file_exists($class))
					throw new Exception($class . " does not exist");
				
				$text = file($class, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				
				$annotations = array();
				$currentAnnotations = array();
				
				foreach($text as $key => $line)
					if (strpos($line, "* @annotation") !== false)
						$currentAnnotations[] = trim(str_replace("* @annotation", "", $line));
					else
					{
						$functionName = "";
						
						if (count($currentAnnotations) > 0 && Annotation::discoverFunctionName($line, $functionName))
						{
							$annotations[$functionName] = $currentAnnotations;
							$currentAnnotations = array();
						}
						
						unset($text[$key]);
					}
				
				return $annotations;
			}
			catch (Exception $e)
			{
				Functions::dump($e->getMessage());
				return NULL;
			}
		}
		
		/**
         * Discovers the function name based on the given line from a class file
         *
         * @param string             $line a given line from a class file
         * @param string             $functionName eventual name of the annotated function
         * @return boolean
         */
		public static function discoverFunctionName($line, &$functionName)
		{
			$possibleFunctionSignatures = array(
											"public function ",
											"private function ",
											"protection function ",
											"public static function ",
											"private static function ",
											"protection static function ",
											"static function ",
											"public ",
											"private ",
											"protected ",
											"static "										
										  );
			
			$possibleReplacement = str_replace($possibleFunctionSignatures ,"", $line);
			
			if (strlen($possibleReplacement) != strlen($line))
			{
				$functionName = trim($possibleReplacement);
				
				if (strpos($functionName, "(") !== false)
					$functionName = substr($functionName, 0, strpos($functionName, "("));
				else if (strpos($functionName, "(") === false && $functionName[strlen($functionName) - 1] == ";")
					$functionName = substr($functionName, 0, -1);

				return true;
			}
			
			return false;
		}
	} /*end of class Annotation*/