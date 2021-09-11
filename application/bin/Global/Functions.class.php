<?php
	class Functions
	{
		/**
         * Includes escape characters from a given $value
         *
         * @param string
         * @param string
         * @return string
         */
		public static function capture($value, $emptyValue = NULL)
		{
			if (is_array($value) || is_object($value))
				return $value;

			return (strlen(trim($value)) == 0 && empty($value)) ? $emptyValue : addslashes(trim($value));
		}
		
		/**
         * Includes escape characters from a given $value
         *
         * @param string
         * @param string
         * @return string
         */
		public static function captureMSSQL($value, $emptyValue = NULL)
		{
			$value = (strlen(trim($value)) == 0 && empty($value)) ? $emptyValue : addslashes(trim($value));
			
			return str_replace("'","''", $value);
		}
		
		/**
         * Returns a formatted search query based on the current field
         *
         * @param string
         * @return string
         */
		public static function currentSearchQuery($field_name)
		{
			return (isset($_GET['z'])) ? ((strtolower($_GET['z'])!="numerical") ? " AND (" .$field_name ." LIKE '" .$_GET['z'] ."%') " : " AND (LEFT(" .$field_name .",1) NOT IN('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','z','y','z')) ") : "";
		}
		
		/**
         * Removes escape characters from a given $value
         *
         * @param string
         * @param string
         * @return string
         */
		public static function escape($value, $emptyValue = NULL)
		{
			return (!empty($value)) ? str_replace("\n","<br>",stripslashes(trim($value))) : $emptyValue;
		}
		
		/**
         * Removes escape characters to camelCase from a given $value
         *
         * @param string
         * @return string
         */
		public static function escapeCamel($value)
		{
			if (!empty($value))
			{
				$value = str_replace(" ", "", $value);
				$value[0] = strtolower($value[0]);
			}
			
			return Functions::escape($value);
		}
		
		/**
         * Removes escape characters to Capitalcase from a given $value
         *
         * @param string
         * @return string
         */
		public static function escapeCapital($value)
		{
			if (!empty($value))
			{
				$value = strtolower($value);
				$value[0] = strtoupper($value[0]);
			}
			
			return Functions::escape($value);
		}
		
		/**
         * Removes escape and HTML characters from a given $value
         *
         * @param string
         * @return string
         */
		public static function escapeHTML($value)
		{
			if (!empty($value))
				return stripslashes(trim(htmlspecialchars($value)));
			
			return Functions::escape($value);
		}
		
		/**
         * Removes escape characters from a given $value and formats in Postal Code format e.g. A9A 9A9
         *
         * @param string
         * @param string
         * @return string
         */
		public static function escapePostal($value, $emptyValue = "&nbsp;")
		{
			if (empty($value))
				return($emptyValue);
			
			$strlen = strlen($value);
			if ($strlen != 6)
				return(Functions::escape($value));
			
			$temp_value = "";
			for($i = 0; $i < $strlen; $i++)
			{
				if ($i == 3)
					$temp_value .= " ";
				
				$temp_value .= strtoupper($value[$i]);
			}
			
			return stripslashes(trim($temp_value));
		}
		
		/**
         * Removes escape characters from a given $value and formats in Telephone format e.g. (403) 123-4567
         *
         * @param string
         * @param string
         * @return string
         */
		public static function escapePhone($value, $emptyValue = "&nbsp;")
		{
			if (empty($value))
				return $emptyValue;
			
			$strlen = strlen($value);
			if ($strlen != 10 || !is_numeric($value))
				return Functions::escape($value);
			
			$temp_value = "(";
			for($i = 0; $i < $strlen; $i++)
			{
				if ($i == 3)
					$temp_value .= ") ";
				else if ($i == 6)
					$temp_value .= "-";
				
				$temp_value .= $value[$i];
			}
			
			return stripslashes(trim($temp_value));
		}
		
		/**
         * Formats dates to a particular format
         *
         * @param DateTime
         * @param string
         * @return string
         */
		public static function escapeDate(DateTime $value, $format = "m-d-Y")
		{
			if (is_object($value))
				return($value->format($format));
			else
			{
				if (strlen(strtotime($value)) == 10)
					return(date($format,strtotime($value)));
				
				if ($value != "0000-00-00 00:00:00" && !empty($value))
					return(date($format,$value));
			}
			
			return $value;
		}
		
		/**
         * Formats number to a particular format
         *
         * @param integer
         * @param string
         * @param integer
         * @return string
         */
		public static function escapeNumber($value, $format = NULL, $decimal = 2)
		{
			if (is_numeric($value))
			{
				if ($format == "comma")
					return(number_format($value,$decimal,".",","));
				return(number_format($value,$decimal,".",""));
			}
			else
				return "0.00";
		}
		
		/**
         * Formats a given date value into a timestamp
         *
         * @param string
         * @return integer|boolean
         */
		public static function escapeTimestamp($value)
		{
			$date = explode("-",$value);
			if (count($date) == 0)
				return false;
			
			return mktime(0,0,0,$date[0],$date[1],$date[2]);
		}
		
		/**
         * Removes any unwanted characters from a given $value
         *
         * @param string
         * @param string
         * @return string
         */
		public static function escapeComplete($value)
		{
			$value = stripslashes($value);
			$value = str_replace("'","",$value);
			$value = str_replace("\"","",$value);
			$value = str_replace("’","",$value);
			$value = str_replace("”","",$value);
			$value = str_replace("“","",$value);
			$value = str_replace("#","",$value);
			$value = str_replace("\"","",$value);
			
			return $value;
		}
		
		/**
         * Formats a numerical value to human readable sizes
         *
         * @param integer
         * @return string
         */
		public static function escapeSize($value)
		{
			$value = stripslashes($value);

			if (!is_numeric($value))
				return "Unknown";
			
			if ($value >= 0 && $value <= 999999)
			{
				if ($value / 1024 >= 100)
					return number_format($value/1024,0,".","") .".00 kb";
				else
					return number_format($value/1024,2,".","") ." kb";
			}
			else if ($value >= 1000000 && $value <= 999999999)
			{
				if ($value / (1024 * 1000) >= 100)
					return number_format($value/(1024*1000),0,".","") .".00 mb";
				else
					return number_format($value/(1024*1000),2,".","") ." mb";
			}
			else if ($value >= 1000000000)
				return number_format($value/(1024*1000000),2,".","") ." gb";

            return "Unknown";
		}
		
		/**
         * Removes escape characters from a given $value
         *
         * @param Mixed
         * @return string
         */
		public static function escapeSimple(&$value)
		{
			$value = str_replace("\n","<br>",stripslashes(trim($value)));
		}

		/**
         * Returns the current year quarter of the given $value
         *
         * @param string
         * @return string
         */
		public static function escapeYearQuarter($value)
		{
			if (!is_numeric($value))
				$value = date("m");
			
			if ($value >= 1 && $value <= 3)
				return "Q1";
				
			if ($value >= 4 && $value <= 6)
				return "Q2";
				
			if ($value >= 7 && $value <= 9)
				return "Q3";
				
			if ($value >= 10 && $value <= 12)
				return "Q4";

            return "";
		}
		
		/**
         * Formats a string with break points at words of a given length
         *
         * @param string
         * @param integer
         * @return string
         */
		public static function formatStringBreakPoints($value, $length)
		{
			$parts = explode(" ", $value);
			
			$string = "";
			$wordCount = 0;
			
			foreach($parts as $part)
			{
				if (strlen($part) > $length && $wordCount > 0)
					$string .= "<br>" .$part ." ";
				else
					$string .= $part ." ";
				
				$wordCount++;
			}
			
			return (empty($string)) ? $value : $string;
		}
		
		/**
         * Flattens an array to string delimited by $separator
         *
         * @param array
         * @param string
         * @param string
         * @return string
         */
		public static function flattenArray($values, $separator = ", ", $contains = NULL)
		{
			if (!is_array($values))
				return $values;
			
			$temp = "";
			foreach($values as $value)
			{
				if ($contains == NULL)
					$temp .= $value .$separator;
				else
					$temp .= $contains .$value .$contains .$separator;
			}
			
			return substr($temp,0,(strlen($separator))*-1);
		}
		
		/**
         * Calculates the years, months and days between a given date in YYYY-mm-dd format
         *
         * @param date
         * @param boolean
         * @return string
         */
		public static function calculateYearsBetween($date, $displayText = true)
		{
			$diff = abs(strtotime(date("Y-m-d", time())) - strtotime($date));

			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			//$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

			if ($displayText == true)
				return $years ." years, " .$months ." months";

			return $years;
		}

		/**
         * Returns an array using the <pre> </pre> tags
         * Unfortunately we're displaying information so we'll return some HTML
         *
         * @param array
         * @return string
         */
		public static function dump($array)
		{
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
		
		/**
         * Returns output to the console, useful for FireBug debugging
         *
         * @param string
         * @return string
         */
		public static function debug($data)
		{
		    echo "<script type=\"text/javascript\" language=\"javascript\">";
	            echo "console.log(\"" .$data ."\");";
			echo "</script>";
		}
	}  /*end of class Functions*/