<?php
	class Data
	{
		/**
         * Connection link
         *
         * @var Resource
         */
		private $databaseHandler;
		
		/**
         * Database name
         *
         * @var string
         */
		private $database;
		
		/**
         * Development environment
         *
         * @var string
         */
		private $environment;
		
		/**
         * Creates a data instance
         *
         * @param array              $connectionArray a connection array that contains the server, user, password, and database strings
         * @param string             $environment the current development environment (debug, development or production)
         */
		public function __construct($connectionArray, $environment = "development")
		{
			try
			{
				$this->environment = strtolower($environment);
				
				$this->databaseHandler = new PDO("mysql:host=" .$connectionArray['server'] .";dbname=" .$connectionArray['database'], $connectionArray['user'], $connectionArray['password'], array(
						PDO::ATTR_PERSISTENT => true
				));
				
				$this->databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$this->database = $connectionArray['database'];				
			}
			catch (Exception $e)
			{
                $this->sqlError("Connection Error - " .$e->getMessage());
			}
		}
		
		/**
         * Default destructor
         *
         */
		public function __destruct()
		{
			$this->databaseHandler = NULL;
		}
		
		/**
         * Runs the current select query and return rows in an array
         *
         * @param string              $query a valid select MySQL query, e.g SELECT bar FROM foo
         * @return array
         */
		public function select($query)
		{
			$rows = $this->query($query);
			
			return $this->fetchArray($rows);
		}

		/**
         * Processes the current query
         *
         * @param string              $queryString any valid MySQL query
         * @return Mixed
         */
		public function query($queryString)
		{
		    if (strpos(strtolower($queryString), "<script>") !== false)
				return false;
			
		    if (strpos(strtolower($queryString), "&lt;script&gt;") !== false)
				return false;
		   	
			try
			{
				return $this->databaseHandler->query($queryString);
			}			
			catch (Exception $e)
			{
				$this->sqlError("Query Error - " .$e->getMessage());					
			}
		}

		/**
         * Creates an array of records
         *
         * @param Resource              $rows a MySQL resource result
         * @return array
         */
		public function fetchArray($rows)
		{
			if ($rows == NULL) return NULL;
			
			$rowsAssociatedArray = array();
			$rowsLinearArray = array();
			
			$count = 0;
			
			foreach($rows as $row) 
			{
				$rowsAssociatedArray[$count] = array();
				$rowsLinearArray[$count] = array();
				
				foreach($row as $key => $v)
				{
					if (!is_numeric($key))
						$rowsAssociatedArray[$count][$key] = $v;
					else
						$rowsLinearArray[$count][$key] = $v;
				}
				
				$count++;
			}
			
			return $rowsAssociatedArray;
		}

		/**
         * Retrieves the first matching field based on a set of given criteria
         *
         * @param string               $field the field to select
         * @param string
         * @param string               $primaryKeyField a field that uniquely identifies the record
         * @param integer              $id the primary key value
         * @param string               $record accepts the retrieved record by reference
         * @return boolean
         */
		public function fetchOne($field, $table, $primaryKeyField, $id, &$record)
		{
			$row = $this->select("SELECT " .$field ." AS record FROM " .$table ." WHERE " .$primaryKeyField ." = " .$id ." LIMIT 0,1;");
			
			if ($row != NULL)
			{
				$record = stripslashes(trim($row[0]['record']));
				
				return true;
			}
			
			return false;
		}	

		/**
         * Retrieves the record count of the given criteria from the given table
         *
         * @param string               $table the table to select from
         * @param string               $condition to count
         * @return integer
         */
		public function fetchCount($table, $condition)
		{
			$row = $this->select("SELECT COUNT(*) AS count FROM " .$table ." WHERE " .$condition);
			
			if ($row != NULL)
				return $row[0]['count'];
			
			return 0;
		}

		/**
         * Inserts values into a table based on an array with keys matching names of table fields
         *
         * @param array                $values an associated array with keys matching table fields
         * @param string               $table the table to insert into
         * @param integer              $insertId accepts the insert id by reference
         * @return boolean
         */
		public function insert($values, $table, &$insertId)
		{
			try
			{		
				$parameterizedInsertQuery = "INSERT INTO " .$table ." (";
					foreach($values as $key => $value)
						$parameterizedInsertQuery .= $key .", ";
				
				$parameterizedInsertQuery = substr($parameterizedInsertQuery, 0, -2) .") VALUES (";
				
					foreach($values as $key => $value)
						$parameterizedInsertQuery .= ":" .$key .", ";	
				
				$parameterizedInsertQuery = substr($parameterizedInsertQuery, 0, -2). ");";
				
				$statement = $this->databaseHandler->prepare($parameterizedInsertQuery);

				foreach($values as $key => $value)
				{
					$statement->bindParam(":" .$key, ${$key});
					${$key} = $value;
				}			
				
				$result = $statement->execute();
				
				$insertId = ($result) ? $this->databaseHandler->lastInsertId() : 0;
				
				return $result;
			}
			catch (Exception $e)
			{
				$this->sqlError("Query Error - " .$e->getMessage());
			}				
		}
		
		/**
         * Update values in a table based on an array with keys matching only the selected table fields
         *
         * @param array                $values an associated array with keys matching table fields
         * @param string               $table the table to insert into
         * @param string               $condition update based on the given condition
         * @return boolean
         */
		public function update($values, $table, $condition = "1 = 2") 
		{
			try
			{			
				$parameterizedUpdateQuery = "UPDATE " .$table ." SET ";
				
				foreach($values as $key => $value)
					$parameterizedUpdateQuery .= $key ." = :" .$key .", ";
				
				$parameterizedUpdateQuery = substr($parameterizedUpdateQuery, 0, -2). " WHERE " .$condition .";";

				$statement = $this->databaseHandler->prepare($parameterizedUpdateQuery);
				
				foreach($values as $key => $value)
				{
					$statement->bindParam(":" .$key, ${$key});
					${$key} = $value;
				}
				
				return $statement->execute();
			}
			catch (Exception $e)
			{
				$this->sqlError("Query Error - " .$e->getMessage());
			}				
		}
		
		/**
         * Creates an array of column names and returns the array, disregards any auto increment columns such as primary keys
         *
         * @param string               $table the current table to analyze
         * @return array
         */
		public function fields($table)
		{
			try
			{
				$rows = $this->databaseHandler->query("SHOW COLUMNS FROM " .addslashes($table));
				
				$fields = array();
				
				if ($rows != NULL)
					foreach($rows as $row) {
						if ($row['Extra'] == "auto_increment") continue;
						
						$fields[] = $row['Field'];
					}
				
				return $fields;
			}
			catch (Exception $e)
			{
				$this->sqlError("Query Error - " .$e->getMessage());
			}				
		}
		
		/**
         * Automates the commit functionality for MySQL
         *
         * @return void
         */
		public function commit()
		{
			$this->databaseHandler->commit();
		}
		
		/**
         * Automates the rollback functionality for MySQL
         *
         * @return void
         */
		public function rollback()
		{
			$this->databaseHandler->rollBack();
		}
		
		/**
         * Begins a transaction by turning off auto commit
         *
         * @return void
         */
		public function transactionBegin()
		{
			$this->databaseHandler->beginTransaction();
		}
		
		/**
         * Ends a transaction by turning on auto commit
         *
         * @return void
         */
		public function transactionEnd()
		{
			
		}

		/**
         * Displays the most recent MySQL error
         *
         * @param string               $message the error message to display, usually from the $this->query() method
         * @throws Exception
         * @return void
         */
		public function sqlError($message)
		{
			try
			{
			    $error  = str_pad("User Error Message", 20 , "_") ." " .$message ."\n";
			    $error .= str_pad("Date", 20 , "_") ." " .date("D, F j, Y H:i:s") ."\n";
			    $error .= str_pad("IP Address", 20 , "_") ." " .$_SERVER['REMOTE_ADDR'] ."\n";
			    $error .= str_pad("Browser", 20 , "_") ." " .$_SERVER['HTTP_USER_AGENT'] ."\n";
				
				if (isset($_SERVER['HTTP_REFERER']))
				    $error .= "Referer     	: " .$_SERVER['HTTP_REFERER'] ."\n";
			    
				throw new Exception($error);
			}
			catch (Exception $e)
			{
                if ($this->environment == "debug" || $this->environment == "development")
                {
                    echo "<b>" . $message . "</b>";
                    echo "<hr size=\"1\" noshade>";
                    echo "<pre>";
                    echo $e->getMessage();
                    echo "</pre>";
                }

                if ($this->environment == "production")
                    throw $e;
			}
		}		
	} /*end of class Data*/
