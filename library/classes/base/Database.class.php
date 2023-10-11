
  <?php
  /**
   * Database - Database Abstraction Layer
   *
   * Copyright 2002 - 2007, iMarc <info@imarc.net>
   *
   * @version  7.3.0
   *
   * @author  Dave Tufts      [dt] <dave@imarc.net>
   * @author  Will Bond       [wb] <will@imarc.net>
   * @author  Bill Bushee     [bb] <bill@imarc.net>
   * @author  Jeff Turcotte   [jt] <jeff@imarc.net>
   * @author  Fred LeBlanc    [fl] <fred@imarc.net>
   * @author  Patrick McPhail [pm] <jeff@imarc.net>
   *
   * @requires  PHP 5.0 or higher, MySQL >= 4.0, PostgreSQL >= 8.1, MSSQL.
   *
   * @changes  7.3.0   Added smartSelect() method [jt, 2008-01-11]
   * @changes  7.2.5   Fixed a bug in startTransaction() where the isolation level would be set multiple times, causing errors for nested transactions [wb, 2007-11-14]
   * @changes  7.2.4   Fixed prepareData() to use the SQL spec method of escaping single quotes [wb, 2007-07-14]
   * @changes  7.2.3   Fixed a bug where getRow() on mssql database will return ' ' for '' values (http://bugs.php.net/bug.php?id=26315), assumes we will never have a blank space in a field [wb, 2007-07-11]
   * @changes  7.2.2   Fixed a bug with not null and default info for mssql databases with getStructure() [wb, 2007-06-26]
   * @changes  7.2.1   Removed a trace() statement [wb, 2007-06-26]
   * @changes  7.2.0   Finished adding support for mssql to getStructure(), getKeyes(), listTables() and listDatabases() [wb, 2007-06-20]
   * @changes  7.1.0   Added prepareData() which prepares a value for database entry [fl, 2007-05-31]
   * @changes  7.0.0   Removed conf file, uses standardized debug code [wb, 2007-05-30]
   * @changes  6.5.0   Added complete mssql support to getStructure(), listDatabases(), and listTables(), and mssql primary key support to getKeys() [jt, 2007-04-19]
   * @changes  6.4.0   Added all other ON DELETE clause checking (was just cascade) to getKeys() [wb, 2007-04-16]
   * @changes  6.3.0   Added cascade checking to foreign key constraints in getKeys() [wb, 2007-04-05]
   * @changes  6.2.3   Updated the default ip range to our new cidr range [wb, 2007-04-05]
   * @changes  6.2.2   Updated simpleSelect to fix bug in which single aggregate function selects were incorrectly returning null [fl, 2007-02-26]
   * @changes  6.2.1   Fixed bug where you can't connect to a pgsql database with a password [wb, 2007-02-23]
   * @changes  6.2.0   Support for mssql excluding getStructure(), getKeys(), listDatabases(), listTables() [pm, 2007-02-13]
   * @changes  6.1.1   Fixed listDatabases() and listTables() so results are sorted alphabetically [wb, 2006-12-15]
   * @changes  6.1.0   Added listDatabases() [wb, 2006-12-11]
   * @changes  6.0.1   setDebug() would not show the SQL if the query failed [wb, 2006-11-29]
   * @changes  6.0.0   ONLY AFFECTS RECORD CLASS, USE 2.0.0 OR NEWER! Changed output structure of getKeys() to coincide with what the RecordClass wants [wb, 2006-11-15]
   * @changes  5.12.0  Added the data type 'time' to getStructure() [wb, 2006-10-31]
   *
   * See http://wiki.imarc.net/wikka/DatabaseClassChangeLog for the complete change log
   */
  class Database
  {

      /**
           * Version number: major.minor.bug-fix
           *
           * @var string
           */
          private $version = '7.3.0';

      /**
           * Error message
           *
           * @var string
           */
      private $error;

      /**
           * Database connection
           *
           * @var resource
           */
      private $connection;

      /**
           * Last executed SQL statement
           *
           * @var string
           */
      private $sql;

      /**
           * Number of affected rows for last SQL statement
           *
           * @var int
           */
          private $affected_rows;

      /**
           * Prefix to use with php db functions
           *
           * @var string
           */
          private $prefix;

      /**
           * Database type
           *
           * @var string
           */
          private $database_type;

      /**
           * Database host name
           *
           * @var string
           */
          private $database_host;

      /**
           * Database name
           *
           * @var string
           */
      private $database_name;

      /**
           * Database login
           *
           * @var string
           */
      private $database_user;

      /**
           * Database password
           *
           * @var string
           */
      private $database_password;

      /**
       * If debug information should be displayed
       *
       * @var boolean
       */
          private $debug;

      /**
           * The total time spent performing sql queries
       *
       * @var float
       */
          private $debug_time;


          /**
           * Connects to the database
           *
           * @since 3.0.0
           *
           * @param  string $host      Hostname of database server
           * @param  string $name      Name of database
           * @param  string $user      Database user
           * @param  string $password  User's password
           * @param  string $type      Database type: mysql, mssql, pgsql (default: mysql)
           * @return void
           */
          public function __construct($host, $name, $user, $password, $type)
          {
                  $this->debug_time = 0.0;

                  $this->database_host      = $host;
                  $this->database_name      = $name;
                  $this->database_user      = $user;
                  $this->database_password  = $password;
                  $this->database_type      = $type;

                  // Make sure we have a valid database type
                  if (!in_array($this->database_type, array('mysql', 'pgsql', 'mssql'))) {
                          die('Database type specified is invalid, please select mysql, mssql or pgsql');
                  }

                  // Set the common command prefix for the database type
                  if ($this->database_type == 'mysql') {
                          $this->prefix = 'mysqli_';
                  } elseif ($this->database_type == 'pgsql') {
                          $this->prefix = 'pg_';
                  } elseif ($this->database_type == 'mssql') {
                          $this->prefix = 'mssql_';
                  }

                  // Connect to the database
                  if (($this->database_type == 'mysql') || ($this->database_type == 'mssql')) {
                          $connect = $this->prefix . 'connect';
                          $this->connection = @$connect($this->database_host, $this->database_user, $this->database_password, TRUE);
                          // mysqli_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
                          if (!$this->connection) {
                                  die('We are so sorry, but we had a problem connecting to the database server: ' . $this->database_host);
                          } else {
                                  $select_db = $this->prefix . 'select_db';
                                  if (!@$select_db($this->database_name, $this->connection)) {
                                          die('We are so, so sorry, but we had a problem connecting to the database'. $this->database_password);
                                  }
                          }
                  } elseif ($this->database_type == 'pgsql') {
                          $this->connection = @pg_connect('host=' . $this->database_host . ' user=' . $this->database_user . ' password=\'' . $this->database_password . '\' dbname=' . $this->database_name);
                          if (!is_resource($this->connection)) {
                                  die('We are sorry, but we had a problem connecting to the database');
                          }
                  }

          }


      /**
           * Returns the version of the class
           *
           * @since 4.0.0
           *
           * @param  void
           * @return string  The current class version
           */
          public function getVersion()
          {
                  return $this->version;
          }


          /**
           * Turns debugging on or off, will override global DEBUG flag
           *
           * @since 5.10.0
           *
           * @param  boolean $enabled  If debugging should be enabled
           * @return void
           */
          public function setDebug($enabled)
          {
                  $this->debug = ($enabled) ? TRUE : FALSE;
          }


          /**
           * Prints a debug message if class debugging is enabled or global debugging is enabled and class debugging is not set
           *
           * @since 7.0.0
           *
           * @param  string $message          The debug message
           * @param  boolean $full_backtrace  Show the full backtrace of function calls, etc
           * @return void
           */
          public function printDebug($message, $full_backtrace)
          {
                  $print = ($this->debug || (!is_bool($this->debug) && defined('DEBUG') && DEBUG)) ? TRUE : FALSE;
                  if (!$print) { return; }
                  if (function_exists('print_debug')) {
                          print_debug($message, $full_backtrace);
                  } else {
                          echo '<pre class="debug">' . $message . '</pre>';
                  }
          }


          /**
           * Get the database connection
           *
           * @since 4.0.0
           *
           * @param  void
           * @return resource  The connetion to the database server
           */
          public function getConnection()
          {
                  return $this->connection;
          }


      /**
           * Get the database type of the current instance
           *
           * @since 5.0.0
           *
           * @param  void
           * @return string  The database type (mysql or pgsql)
           */
          public function getDatabaseType()
          {
                  return $this->database_type;
          }


      /**
           * Get the host for the current instance of the class
           *
           * @since 4.0.0
           *
           * @param  void
           * @return string  The host name of the database server
           */
          public function getDatabaseHost()
          {
                  return $this->database_host;
          }


          /**
           * Get the database name for the current instance of the class
           *
           * @since 4.0.0
           *
           * @param  void
           * @return string  The database name
           */
          public function getDatabaseName()
          {
                  return $this->database_name;
          }


      /**
           * Get the database user for the current instance of the class
           *
           * @since 4.0.0
           *
           * @param  void
           * @return string  The database user
           */
          public function getDatabaseUser()
          {
                  return $this->database_user;
          }


      /**
           * Get the database password for the current instance of the class
           *
           * @since 4.0.0
           *
           * @param  void
           * @return string  The database password
           */
          public function getDatabasePassword()
          {
                  return $this->database_password;
          }


          /**
           * Get the current sql statement
           *
           * @since 4.0.0
           *
           * @param  void
           * @return mixed  The sql statement string if set, or false if none
           */
          public function getSql()
          {
                  return (!empty($this->sql)) ? $this->sql : FALSE;
          }


      /**
           * Get the current error (if exists)
           *
           * @since 4.0.0
           *
           * @param  void
           * @return mixed  The error string if set, or false if no error
           */
          public function getError()
          {
                  return (!empty($this->error)) ? $this->error : FALSE;
          }


      /**
           * Get the number of affected rows from last query
           *
           * @since 4.0.0
           *
           * @param  void
           * @return integer  The number of affected rows from last query
           */
          public function getAffectedRows()
          {
                  return $this->affected_rows;
          }


          /**
           * Return a single row value or an entire row array from an SQL select stament
           *
           * @since 4.0.0
           *
           * @param  string $row_name     select *ROW_NAME* from table_name where where_row='where_value'
           * @param  string $table_name   select row_name from *TABLE_NAME* where where_row='where_value'
           * @param  string $where_row    select row_name from table_name where *WHERE_ROW*='where_value'
           * @param  string $where_value  select row_name from table_name where where_row='*WHERE_VALUE*'
           * @return mixed  array if $row_name = "*"; string if not
           */
          public function simpleSelect($row_name='*', $table_name='', $where_row='', $where_value='')
          {
                  if ($table_name) {
                          $this->sql = 'SELECT ' . $row_name . ' FROM ' . $table_name . ' WHERE ' . $where_row . " = '" . $where_value . "'";

                      $result = $this->query($this->sql);
                          $func = $this->prefix . 'num_rows';

                          // If we did not get a result, pass on the result/error
                          if (!is_resource($result)) {
                                  return $result;

                          // If we got a result, pass it on
                          } elseif ($func($result)) {
                                  if (strpos($row_name, '*') !== FALSE) {
                                          $func = $this->prefix . 'fetch_assoc';
                                          $row = $func($result);
                                          return $row;
                                  } else {
                                          $func = $this->prefix . 'fetch_row';
                                          $row = $func($result);
                                          return $row[0];
                                  }
                          } else {
                                  return NULL;
                          }
                  } else {
                          $this->error = 'Not enough data to execute a query - No $table_name passed.';
                          return NULL;
                  }
          }


          /**
           * Return an array from an SQL select statement
           *
           * @since 7.3.0
           *
           * @param  mixed $row_names     string of row name or array of row names
           * @param  string $table_name   select row_name from *TABLE_NAME* where where_row='where_value'
           * @param  array $where         assoc array of any where_row => where_value
           * @return array of results
           */
          public function smartSelect($row_names, $table_name, $where=NULL)
          {
                  $row_sql = (is_array($row_names)) ? join(', ', $row_names) : $row_names;

                  $where_sql = '';
                  if (is_array($where)) {
                          foreach($where as $row => $value) {
                                  (is_array($where_sql)) ? array_push($where_sql, "${row} = '${value}'") : $where_sql = array("WHERE ${row} = '${value}'");
                          }
                          $where_sql = join(' AND ', $where_sql);
                  }

                  $this->sql = "SELECT ${row_sql} FROM ${table_name} ${where_sql}";

                  $result = $this->query($this->sql);
                  $return = array();
                  if (is_resource($result) && $this->numRows($result)) {
                          while ($row = $this->getRow($result)) {
                                  array_push($return, $row);
                          }
                  }
                  return $return;
          }




          /**
           * Send a complete SQL statement to the database
           *
           * @since 1.0.0
           *
           * @param  string $sql  SQL statement
           * @return mixed  false if no result; resource if there is a result
           */
          public function query($sql='')
          {
                  $this->sql = $sql;
                  $start_time = microtime(TRUE);
          $this->affected_rows = 0;

                  if (!is_string($this->sql) || empty($this->sql)) {
                          $this->error = 'No SQL passed to query()';
                          return FALSE;
                  } else {

                          if ($this->database_type == 'mysql') {
                                  $result = @mysqli_query($this->sql, $this->connection);
              } elseif ($this->database_type == 'mssql') {
                  $result = @mssql_query($this->sql, $this->connection);
                          } elseif ($this->database_type == 'pgsql') {
                                  $result = @pg_query($this->connection, $this->sql);
                          }

                          if (!$result) {
                                  if ($this->database_type == 'mysql') {
                      $this->error = mysqli_errno($this->connection) . ': ' . mysqli_error($this->connection);
                  } elseif ($this->database_type == 'mssql') {
                      $this->error = mssql_get_last_message();
                                  } elseif ($this->database_type == 'pgsql') {
                                          // As of PHP 5.1 we can get the SQL STATE (error number) from pgsql
                                          $prepend = '';
                                          if (function_exists("pg_result_error_field")) {
                                                  $prepend = pg_result_error_field($result, PGSQL_DIAG_SQLSTATE) . ': ';
                                          }
                                          $this->error = $prepend . pg_last_error();
                                  }

                                  $this->printDebug("The following query failed:\n" . $this->error . "\n" . $this->sql, TRUE);

                                  return NULL;
                          } else {
                                  $this->error = '';
                                  if ($this->database_type == 'mysql') {
                      $this->affected_rows = @mysqli_affected_rows($this->connection);
                  } elseif ($this->database_type == 'mssql') {
                      $this->affected_rows = @mssql_rows_affected($this->connection);
                                  } elseif ($this->database_type == 'pgsql') {
                                          $this->affected_rows = @pg_affected_rows($result);
                                  }

                                  $this->debug_time += microtime(TRUE) - $start_time;
                                  $this->printDebug('The following query took ' . (number_format((microtime(TRUE)-$start_time), 5, '.', ',')) . " seconds:\n" . $this->sql, TRUE);

                                  return $result;
                          }
                  }
          }



          /**
           * Returns the number of rows in a SELECT result
           *
           * @since 4.0.0
           *
           * @param resource $result  Result set of an SELECT query
           * @return integer
           */
          public function numRows($result)
          {
                  if (!is_resource($result)) {
                          $this->error = 'Invalid result resource passed to numRows()';
                          return FALSE;
                  } else {
                          $this->error = '';
                          $func = $this->prefix . 'num_rows';
                          return $func($result);
                  }
          }


          /**
           * Returns an associated array of the current database row for the result passed
           *
           * @since 4.0.0
           *
           * @param resource result  Result set of an SELECT query
           * @return array  Associative array of
           */
          public function getRow($result)
          {
                  if (!is_resource($result)) {
                          $this->error = 'Invalid result resource passed to getRow()';
                          return FALSE;
                  } else {
                          $this->error = '';
                          $func = $this->prefix . 'fetch_assoc';
                          $result = $func($result);
                          if ($this->database_type == 'mssql' && $result) {
                                  $new_result = array();
                                  foreach ($result as $key => $value) {
                                          if ($value == ' ') {
                                                  $new_result[$key] = '';
                                          } else {
                                                  $new_result[$key] = $value;
                                          }
                                  }
                                  return $new_result;
                          }
                          return $result;
                  }
          }


          /**
           * Returns an array describing the structure of the database table specified
           *
           * @since 4.0.0
           *
           * @param  void
           * @return mixed  The last auto_increment/sequence ID, or FALSE if none
           *
           */
          public function getId()
          {
                  $this->error = '';
                  $last_id = FALSE;
                  if ($this->database_type == 'mysql') {
              $last_id = mysqli_insert_id($this->connection);
                  } elseif ($this->database_type == 'mssql') {
                          $result = mssql_query("SELECT @@IDENTITY AS 'the_unique_id'");
                          if (is_resource($result)) {
                                  $row = mssql_fetch_array($result);
                                  $last_id = $row['the_unique_id'];
                          }
                  } elseif ($this->database_type == 'pgsql') {
                          $result = pg_query($this->connection, 'SELECT lastval()');
                          if (is_resource($result)) {
                                  $row = pg_fetch_array($result);
                                  $last_id = $row[0];
                          }
                  }
                  return $last_id;
          }


          /**
           * Seek to a specific position in a result object.  Zero based.
           *
           * @since 5.3.0
           *
           * @param  resource $result  The Result resource to seek through
           * @param  integer $row      The Row to seek to. Zero based.
           * @return boolean  If the seek worked
           *
           */
          public function seek($result, $row)
          {
                  $this->error = '';
                  if (!is_numeric($row)) {
                          $this->error = 'Row must be an integer';
                          return FALSE;
                  }
                  settype($row, 'integer');
                  if ($row > $this->numRows($result) - 1 || $row < 0) {
                          $this->error = 'Row specified out of range';
                          return FALSE;
                  }

                  if ($this->database_type == 'mysql') {
              mysqli_data_seek($result, $row);
          } elseif ($this->database_type == 'mssql') {
              mssql_data_seek($result, $row);
                  } elseif ($this->database_type == 'pgsql') {
                          pg_result_seek($result, $row);
                  }
                  return TRUE;
          }


      /**
           * Starts a new transaction
           *
           * @since  5.8.0
           *
           * @param  void
           * @return boolean  If the transaction was successfully started
           *
           */
          public function startTransaction()
          {
                  if ($this->database_type == 'mysql' || $this->database_type == 'pgsql') {
              static $level_set = FALSE;
              if (!$level_set) {
                                  $result = $this->query('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
                      if ($result === FALSE) {
                          return FALSE;
                      }
                          $level_set = TRUE;
              }
              $result = $this->query('START TRANSACTION');
                      if ($result === FALSE) {
                  return FALSE;
              }
          } else if ($this->database_type == 'mssql') {
                          $result = $this->query('BEGIN TRANSACTION');
                      if ($result === FALSE) {
                  return FALSE;
              }
                  }
          return TRUE;
          }


      /**
           * Commits the currently open transaction
           *
           * @since  5.8.0
           *
           * @param  void
           * @return boolean  If the transaction was successfully committed
           *
           */
          public function commitTransaction()
          {
                  if ($this->database_type == 'mysql' || $this->database_type == 'pgsql') {
              $result = $this->query('COMMIT');
              if ($result === FALSE) {
                  return FALSE;
              }
          } else if ($this->database_type == 'mssql') {
                     $result = $this->query('COMMIT TRANSACTION');
              if ($result === FALSE) {
                  return FALSE;
              }
                  }
          return TRUE;
          }


      /**
           * Rolls back the currently open transaction
           *
           * @since  5.8.0
           *
           * @param  void
           * @return boolean  If the transaction was successfully rolled back
           *
           */
          public function rollbackTransaction()
          {
                  if ($this->database_type == 'mysql' || $this->database_type == 'pgsql' || $this->database_type == 'mssql') {
              $result = $this->query('ROLLBACK');
              if ($result === FALSE) {
                  return FALSE;
              }
          }
          return TRUE;
          }


          /**
           * Returns the database field structure of a table or all tables
           *
           *  For a single table this function returns an associative array of field names => field info array. Each field
           *  info array contains a 'type' key which will return one of the following values:
           *
           *              - varchar
           *              - integer
           *              - enum
           *              - text
           *              - boolean
           *              - date
           *              - datetime
       *      - time
           *              - float
           *
           *      All fields also have a key 'not_null' in the field info array set to either TRUE or FALSE.
           *  This 'not_null' value is correct for PGSQL and MySQL 5 and greater (does not work in MySQL 4).
           *  Varchar type fields will have a 'length' key in the field info array and enum type
           *  fields will have a 'valid_values' key in the field info array that contains an
           *  array of valid values. If the primary key is auto incrementing, there will be a key
       *  'auto_increment' => TRUE. If the column has a unique constraint (on just it) there will be a
       *  key 'unique' => TRUE. If the column has a regex check constraint on it there will be a key 'regex'
       *  that will have the regular expression as a value (in preg_match ready format). Only PGSQL supports
       *  check constraints. Key 'default' returns the default value for the field.
           *
           *
       *  Example:
           *
           *      array('field_name' => array('type' => 'varchar', 'not_null' => TRUE, 'length' => 20),
           *                'field_name2' => array('type' => 'integer' 'not_null' => FALSE,),
           *                'field_name3' => array('type' => 'enum', 'not_null' => TRUE, 'valid_values' => array('yes', 'no'))
           *               );
       *
       *  If no table is specified an associative array of table_name => single_table_field_info associative array
           *
           *
           * @since 5.2.0
           *
           * @param  string $table  The table to get the structure of
           * @return mixed  FALSE if error, otherwise associative array (see method description)
           *
           */
          public function getStructure($table=NULL)
          {
                  $this->error = '';

                  $final_output = array();
          $single_table = TRUE;

          if (!$table) {
              $tables = $this->listTables();
              $single_table = FALSE;
          } else {
              $tables = array($table);
          }

                  if ($this->database_type == 'mysql') {

                          $sql = "SELECT VERSION();";
                          $result = $this->query($sql);
                          if ($this->numRows($result)) {
                                  $row = $this->getRow($result);
                                  $mysqli_version = $row['VERSION()']{0};
                          }

                          foreach ($tables as $table) {
                  $output = array();

                  // Describe the table if we have mysql version 4, or use the information_schema table if we have 5 or above
                              if ($mysqli_version == 4) {
                                      $sql = 'DESC ' . $table;
                              } elseif ($mysqli_version >= 5) {
                                      $sql = "SELECT COLUMN_NAME AS Field, COLUMN_TYPE AS Type, IS_NULLABLE AS NotNull, COLUMN_DEFAULT AS DefaultVal, EXTRA AS Extra, COLUMN_KEY AS ColumnKey
                                                              FROM INFORMATION_SCHEMA.COLUMNS
                                                              WHERE table_name = '" . $table . "'
                                                              AND table_schema = '" . $this->database_name . "'";
                              }
                              $result = $this->query($sql);

                              if ($this->numRows($result)) {
                                      while ($row = $this->getRow($result)) {

                                                  // If we are getting info from the information_schema table, remap some of the columns so they are the same as the DESC command
                                              if (array_key_exists('NotNull', $row)) {
                                                      $row['Null']        = $row['NotNull'];
                                                      $row['Default'] = $row['DefaultVal'];
                              $row['Key']     = $row['ColumnKey'];
                                              }

                          if ($row['Default'] === 'NULL') {
                              $row['Default'] = NULL;
                          }

                                              // If the row is a varchar, we want to return the maxlength
                                              if (strpos($row['Type'], 'varchar') !== FALSE) {
                                                      $output[$row['Field']]['length'] = substr($row['Type'], 8, strlen($row['Type'])-9);
                                                      $output[$row['Field']]['type'] = 'varchar';
                              $output[$row['Field']]['default'] = $row['Default'];

                                              // If the row is an enum, get the possible values
                                              } elseif (strpos($row['Type'], 'enum') !== FALSE) {
                                                      $valid_values = explode(',', substr($row['Type'], 5, strlen($row['Type'])-6));
                                                      for($i = 0; $i < sizeof($valid_values); ++$i) {
                                                              $valid_values[$i] = substr($valid_values[$i], 1, strlen($valid_values[$i])-2);
                                                      }
                                                      $output[$row['Field']]['valid_values'] = $valid_values;
                                                      $output[$row['Field']]['type'] = 'enum';
                                                  $output[$row['Field']]['default'] = $row['Default'];

                                              } elseif ($row['Type'] == 'tinyint(1)') {
                                                      $output[$row['Field']]['type'] = 'boolean';
                              if ($row['Default'] === NULL) {
                                  $output[$row['Field']]['default'] = NULL;
                              } else {
                                  $output[$row['Field']]['default'] = ($row['Default']) ? TRUE : FALSE;
                              }

                                              } elseif (stripos($row['Type'], 'int(') !== FALSE) {
                                                      $output[$row['Field']]['type'] = 'integer';
                              if ($row['Default'] === NULL) {
                                  $output[$row['Field']]['default'] = NULL;
                              } else {
                                  $output[$row['Field']]['default'] = (int) $row['Default'];
                              }

                                              } elseif (stripos($row['Type'], 'float') !== FALSE || stripos($row['Type'], 'double') !== FALSE || stripos($row['Type'], 'dec') !== FALSE) {
                                                      $output[$row['Field']]['type'] = 'float';
                              if ($row['Default'] === NULL) {
                                  $output[$row['Field']]['default'] = NULL;
                              } else {
                                  $output[$row['Field']]['default'] = (float) $row['Default'];
                              }

                                              } elseif (strpos($row['Type'], 'text') !== FALSE) {
                                                      $output[$row['Field']]['type'] = 'text';
                              $output[$row['Field']]['default'] = $row['Default'];

                                              } elseif ($row['Type'] == 'date') {
                                                      $output[$row['Field']]['type'] = 'date';
                              $output[$row['Field']]['default'] = $row['Default'];

                                              } elseif ($row['Type'] == 'datetime') {
                                                      $output[$row['Field']]['type'] = 'datetime';
                              $output[$row['Field']]['default'] = $row['Default'];

                          } elseif ($row['Type'] == 'time') {
                              $output[$row['Field']]['type'] = 'time';
                              $output[$row['Field']]['default'] = $row['Default'];
                          }

                          if ($row['Extra'] == 'auto_increment') {
                              $output[$row['Field']]['auto_increment'] = TRUE;
                          }

                          if ($row['Key'] == 'UNI') {
                              $output[$row['Field']]['unique'] = TRUE;
                          }

                                              // Check to see if the field must have a value (this only property works on MySQL v5 and up
                                              if ($row['Null'] == 'NO' && $row['Default'] === NULL) {
                                                      $output[$row['Field']]['not_null'] = TRUE;
                                              } else {
                                                      $output[$row['Field']]['not_null'] = FALSE;
                                              }
                                      }
                              }
                  $full_output[$table] = $output;
              }

                  } elseif ($this->database_type == 'mssql') {

                          foreach($tables as $table) {
                                  $output = array();

                                  $sql = "SELECT column_name AS Field, data_type AS Type, is_nullable AS NotNull, column_default AS DefaultVal, character_maximum_length AS Length
                                                          FROM INFORMATION_SCHEMA.COLUMNS
                                                          WHERE table_name = '" . $table . "'
                                                          AND table_catalog = '" . $this->database_name . "'";

                                  $result = $this->query($sql);

                              if ($this->numRows($result)) {
                                      while ($row = $this->getRow($result)) {

                                                  if ($row['DefaultVal'] === 'NULL') {
                                  $row['DefaultVal'] = NULL;
                          }
                                                  if ($row['Length'] == '-1') {
                                                          $row['Length'] = 255;
                                                  }

                                                  if (in_array($row['Type'], array('bigint', 'int', 'smallint', 'tinyint'))) {
                                  $output[$row['Field']]['type'] = 'integer';
                                                          $output[$row['Field']]['default'] = (int) $row['DefaultVal'];
                              } elseif ($row['Type'] == 'bit') {
                                                          $output[$row['Field']]['type'] = 'boolean';
                                                          $output[$row['Field']]['default'] = (int) $row['DefaultVal'];
                          } elseif (in_array($row['Type'], array('decimal','numeric','smallmoney','float','real'))) {
                                                      $output[$row['Field']]['type'] = 'float';
                                                          $output[$row['Field']]['default'] = (float) $row['DefaultVal'];
                          } elseif (in_array($row['Type'], array('datetime','smalldatetime'))) {
                                                          $output[$row['Field']]['type'] = 'datetime';
                                                          $output[$row['Field']]['default'] = $row['DefaultVal'];
                          } elseif (in_array($row['Type'], array('char','varchar'))) {
                                                          $output[$row['Field']]['type'] = 'varchar';
                                                          $output[$row['Field']]['length'] = (int) $row['Length'];
                                                          $output[$row['Field']]['default'] = ($row['DefaultVal'] === NULL) ? NULL : substr($row['DefaultVal'], 2, strlen($row['DefaultVal'])-4);
                                                  } elseif ($row['Type'] == 'text') {
                                                          $output[$row['Field']]['type'] = 'text';
                                                          $output[$row['Field']]['default'] = ($row['DefaultVal'] === NULL) ? NULL : substr($row['DefaultVal'], 2, strlen($row['DefaultVal'])-4);
                                  } elseif ($row['Type'] == 'timestamp') {
                                                  $output[$row['Field']]['type'] = 'time';
                                  $output[$row['Field']]['default'] = $row['DefaultVal'];
                                                  } elseif ($row['Type'] == 'uniqueidentifier') {
                                                          $output[$row['Field']]['type'] = 'varchar';
                              $output[$row['Field']]['unique'] = TRUE;
                          }

                                                  if ($row['NotNull'] == 'NO' && $output[$row['Field']]['default'] === NULL) {
                              $output[$row['Field']]['not_null'] = TRUE;
                                                  } else {
                                                          $output[$row['Field']]['not_null'] = FALSE;
                                                  }
                                          }
                                  }

                                  $sql = "SELECT column_name AS Field FROM INFORMATION_SCHEMA.COLUMNS
                                                  WHERE COLUMNPROPERTY(OBJECT_ID(QUOTENAME(TABLE_SCHEMA) + '.' + QUOTENAME(table_name)), column_name, 'IsIdentity') = 1
                                                  AND OBJECTPROPERTY(OBJECT_ID(QUOTENAME(TABLE_SCHEMA) + '.' + QUOTENAME(table_name)), 'IsMSShipped') = 0
                                                  AND table_name = '" . $table . "'
                                                  AND table_catalog = '" . $this->database_name . "'";

                                  $result = $this->query($sql);
                                  if ($this->numRows($result)) {
                                      while ($row = $this->getRow($result)) {
                                                  $output[$row['Field']]['auto_increment'] = TRUE;
                                          }
                                  }

                  $sql = "SELECT
                                  table_name,
                                  column_name,
                                  check_clause
                              FROM
                                  INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE AS CCU INNER JOIN
                                  INFORMATION_SCHEMA.CHECK_CONSTRAINTS AS CC ON CCU.CONSTRAINT_NAME = CC.CONSTRAINT_NAME
                              WHERE
                                  CC.CONSTRAINT_CATALOG = '" . $this->database_name . "' AND
                                  CCU.TABLE_NAME = '" . $table . "'";

                  $result = $this->query($sql);
                  if ($this->numRows($result)) {
                      while ($row = $this->getRow($result)) {
                          $output[$row['column_name']]['type'] = 'enum';
                          preg_match_all('#^\(((?:(?: OR )?\[[^\]]+\]=\'(?:\'\'|[^\'])+\')+)\)$#', $row['check_clause'], $matches);
                          $valid_values = explode(' OR ', $matches[1][0]);
                          for ($i=0; $i<sizeof($valid_values); $i++) {
                              $valid_values[$i] = substr($valid_values[$i], strpos($valid_values[$i], "'")+1, -1);
                          }
                          $output[$row['column_name']]['valid_values'] = $valid_values;
                      }
                  }

                                  $full_output[$table] = $output;
              }

                  } elseif ($this->database_type == 'pgsql') {

              foreach ($tables as $table) {
                  $output = array();

                              // Use the PGSQL system catalogs to find out about the data type
                              $sql = "SELECT pt.typname AS type, pa.atttypmod AS length, pa.attname AS field, pg_get_constraintdef(pco.oid) AS constraint, pa.attnotnull as not_null, pd.adsrc as default
                                                  FROM pg_attribute AS pa LEFT JOIN
                                                       pg_class AS pc ON pa.attrelid = pc.oid LEFT JOIN
                                                       pg_type AS pt ON pt.oid = pa.atttypid LEFT JOIN
                                                       pg_constraint AS pco ON pco.conrelid = pc.oid AND pa.attnum = ANY (pco.conkey) AND (pco.contype = 'c' OR pco.contype = 'u') LEFT JOIN
                                                       pg_attrdef AS pd ON pc.oid = pd.adrelid AND pa.attnum = pd.adnum
                                                  WHERE pc.relname = '" . $table . "' AND NOT pa.attisdropped
                              ORDER BY pa.attnum, pco.contype";
                              $result = $this->query($sql);

                              if ($this->numRows($result)) {
                                      while ($row = $this->getRow($result)) {

                                              // Ignore some postgres variables
                                              if (!in_array($row['type'], array('oid', 'cid', 'xid', 'cid', 'xid', 'tid'))) {

                              $parse_default = TRUE;

                                                      // If the row is a varchar, we want to return the maxlength
                                                      if ($row['type'] == 'varchar') {

                                                              // See if the field has a check constraint on it
                                                              if (!empty($row['constraint'])) {
                                      // Check for enumerated constraints
                                      if (preg_match('/CHECK[\( "]+' . $row['field'] . '[a-z\) ":]+\s+=\s+/i', $row['constraint'])) {
                                          $output[$row['field']]['type'] = 'enum';
                                                                          $matches = array();
                                                                          $success = preg_match_all("/(?!').'((''|[^'])*)'/", $row['constraint'], $matches, PREG_PATTERN_ORDER);
                                                                          $output[$row['field']]['valid_values'] = str_replace("''", "'", $matches[1]);

                                      // Check for unique constraints
                                      } elseif (stripos($row['constraint'], 'UNIQUE') === 0) {
                                          $output[$row['field']]['length'] = $row['length']-4;
                                          $output[$row['field']]['type'] = 'varchar';
                                          $output[$row['field']]['unique'] = TRUE;

                                      // Check for regex constraints
                                      } elseif (preg_match('/CHECK[\( "]+' . $row['field'] . '[a-z\) ":]+\s+(\!?~\*?)\s+([\'"])(.*)\2/i', $row['constraint'], $matches)) {
                                          $regex = str_replace('#', '\#', $matches[3]);
                                          $regex = str_replace($matches[2] . $matches[2], $matches[2], $regex);
                                          if ($matches[1]{0} == '!') {
                                              $regex = '!(' . $regex . ')';
                                          }
                                          $regex = '#' . $regex . '#';
                                          if ($matches[1]{strlen($matches[1])-1} == '*') {
                                              $regex .= 'i';
                                          }
                                          $output[$row['field']]['length'] = $row['length']-4;
                                          $output[$row['field']]['type'] = 'varchar';
                                          $output[$row['field']]['regex'] = $regex;
                                      }
                                                              } else {
                                                                  // Postgres uses an extra 4 bytes for varchars (presumably for internal purposes)
                                                                  $output[$row['field']]['length'] = $row['length']-4;
                                      $output[$row['field']]['type'] = 'varchar';
                                                              }

                                                      } elseif ($row['type'] == 'int4') {
                                                              $output[$row['field']]['type'] = 'integer';

                                                              $parse_default = FALSE;
                                  if (strlen($row['default']) > 0) {
                                                                      $output[$row['field']]['default'] = (int) $row['default'];
                                                              }

                                                      } elseif (stripos($row['type'], 'float') !== FALSE || stripos($row['type'], 'numeric') !== FALSE) {
                                                              $output[$row['field']]['type'] = 'float';

                                                              $parse_default = FALSE;
                                  if (strlen($row['default']) > 0) {
                                                                      $output[$row['field']]['default'] = (float) $row['default'];
                                                              }

                                                      } elseif ($row['type'] == 'text') {
                                                              $output[$row['field']]['type'] = 'text';

                                                      } elseif ($row['type'] == 'bool') {
                                                              $output[$row['field']]['type'] = 'boolean';

                                                              $parse_default = FALSE;
                                  if (strlen($row['default']) > 0) {
                                                                      $output[$row['field']]['default'] = ($row['default'] == 'false') ? FALSE : TRUE;
                                                              }

                                                      } elseif ($row['type'] == 'date') {
                                                              $output[$row['field']]['type'] = 'date';

                                                      } elseif ($row['type'] == 'timestamp') {
                                                              $output[$row['field']]['type'] = 'datetime';

                                                      } elseif ($row['type'] == 'time') {
                                  $output[$row['field']]['type'] = 'time';
                              }

                              if (stripos($row['default'], 'nextval(') !== FALSE) {
                                  $output[$row['field']]['auto_increment'] = TRUE;
                              } elseif ($parse_default && strlen($row['default']) > 0) {
                                  $output[$row['field']]['default'] = str_replace("''", "'", preg_replace("/^'(.*)'::[a-z ]+$/i", '\1', $row['default']));
                              }

                                                      // Check to see if the field must have a value
                                                      if ($row['not_null'] == 't' && empty($row['default']) && $row['default'] !== '' && $row['default'] !== '0' && $row['default'] !== 0) {
                                                              $output[$row['field']]['not_null'] = TRUE;
                                                      } else {
                                  $output[$row['field']]['not_null'] = FALSE;
                              }
                                              }
                                      }
                              }
                  $full_output[$table] = $output;
              }
                  }

                  if (sizeof($full_output) < 1) {
                          $this->error = 'Unable to retrieve structure for table specified';
                          return FALSE;
                  }

          // If a single table was requested, just return that field info array
          if ($single_table) {
              $full_output = $full_output[$tables[0]];
          }

                  return $full_output;

          }


      /**
           * Returns a list of primary key, foreign key and unique key constraints for the whole database
           *
           *  This function returns an array of field info. It is structured in the following way:
       *
       *      'table_name'    => array(
       *          'type'          => array(     type will be 'primary_key_field', 'foreign_keys', 'unique_keys', 'child_keys'
       *              primary_key_field will have a single field name
       *              foreign_keys will have an array of arrays with the following keys:
       *                'field'           => The name of the field
       *                'foreign_table'   => If a foreign key, the table it references
       *                'foreign_field'   => If a foreign key, the field it references
       *                'on_delete'       => The action to perform on a delete of the foreign row (no_action, restrict, set_null, set_default, cascade)
       *              child_keys will have an array of arrays with the following keys:
       *                'child_table'            => the table who references the current table
       *                'child_primary_key'      => the field that is the primary key of the child table
       *                If the child table is a normal (not through a linking) table, if will have the following key:
       *                'child_field'            => the field in the child table that references the current table's primary key
       *                'on_delete'              => The action to perform on the child fields if a delete of the current row occurs (no_action, restrict, set_null, set_default, cascade)
       *                If the child table is through a linking table it will have the following keys:
       *                'link_table'             => The table that links the current table and child table together
       *                'link_child_primary_key' => The field in the link table that corresponds to the primary key of the child table
       *                'link_field'             => The field in the link table that corresponds to the primary key of the current table
       *              unique_keys will have an associative array of constraint_names => array of fields
       *          )
       *      )
           *
           *      Example:
           *
           *      array('table1' => array('primary' => array('field' => 'field_name')),
           *                'table2' => array('foreign' => array('field' => 'field_name2', foreign_table' => 'table1', 'foreign_field' => 'field_name'))
           *               );
           *
           *
           * @since 5.7.0
           *
           * @param  void
           * @return mixed  FALSE if error, otherwise associative array (see method description)
           *
           */
          public function getKeys()
          {
                  $this->error = '';

                  $output = array();

          $tables = $this->listTables();
                  foreach ($tables as $table) {
              // Create the output arrays for this table
              $output[$table] = array();
              $output[$table]['primary_keys'] = array();
              $output[$table]['foreign_keys'] = array();
              $output[$table]['child_keys']   = array();
              $output[$table]['unique_keys']  = array();
          }

          // Get a list of tables and a little info about the database
                  if ($this->database_type == 'mysql') {
                          $result = $this->query("SELECT VERSION();");
              if ($this->numRows($result)) {
                  $row = $this->getRow($result);
                  $mysqli_version = $row['VERSION()']{0};
              }
          }

                  // Describe the table if we have mysql version 4
                  if ($this->database_type == 'mysql' && $mysqli_version == 4) {
              // For each table, describe it and pick out the primary keys
              foreach ($tables as $table) {
                  $result = $this->query("DESC " . $table);
                              if ($this->numRows($result)) {
                      while ($row = $this->getRow($result)) {
                                              if ($row['Key'] == 'PRI') {
                              $output[$table]['primary_key_field'] = $row['Field'];
                          }
                                      }
                      // Handle finding unique constraints
                      $result = $this->query("SHOW CREATE TABLE " . $table);
                      if ($this->numRows($result)) {
                          $row = $this->getRow($result);
                          $matches = array();
                          preg_match_all('/UNIQUE KEY\s+`(.*)`\s+\(`(.*)`\),?\n/U', $row['Create Table'], $matches, PREG_SET_ORDER);
                          foreach ($matches as $constraint) {
                              $fields = explode('`,`', $matches[2]);
                              foreach ($fields as $field) {
                                  if (!isset($output[$table]['unique_keys'][$matches[1]])) {
                                      $output[$table]['unique_keys'][$matches[1]] = array();
                                  }
                                  $output[$table]['unique_keys'][$matches[1]][] = $field;
                              }
                          }
                      }
                  }
              }

          // Mysql 5 and Postgres can output the same structure info
          } elseif (($this->database_type == 'mysql' && $mysqli_version >= 5) || $this->database_type == 'pgsql' || $this->database_type == 'mssql') {

              if ($this->database_type == 'mysql') {

                  // Mysql 5 doesn't store ON DELETE clauses in the INFORMATION_SCHEMA table, so we have to extract it from SHOW TABLE CREATE, gross!
                  $mysql5_foreign_key_on_deletes = array();
                  $on_delete_map = array('CASCADE'     => 'cascade',
                                         'SET NULL'    => 'set_null',
                                         'SET DEFAULT' => 'set_default',
                                         'NO ACTION'   => 'no_action',
                                         'RESTRICT'    => 'restrict',
                                         ''            => 'no_action');
                  foreach ($tables as $table) {
                          $sql = "SHOW CREATE TABLE " . $table;
                          $result = $this->query($sql);
                          if ($this->numRows($result)) {
                                                  while ($row = $this->getRow($result)) {
                                                          $found = preg_match_all('#FOREIGN KEY \(`([^`]+)`\) REFERENCES `([^`]+)` \(`([^`]+)`\)(?:\sON\sDELETE\s(SET\sNULL|SET\sDEFAULT|CASCADE|NO\sACTION|RESTRICT))?#', $row['Create Table'], $constraint_matches, PREG_SET_ORDER);
                                                          if (!empty($constraint_matches)) {
                                                                  foreach ($constraint_matches as $match) {
                                                                          if (!isset($match[4])) {
                                                                                  $match[4] = '';
                                                                          }
                                                                          $current_match = $table . ':' . $match[1] . ':' . $match[2] . ':' . $match[3];
                                                                          $mysql5_foreign_key_on_deletes[$current_match] = $on_delete_map[$match[4]];
                                                                  }
                                                          }
                                                  }
                                          }
                                  }

                  $sql  = "SELECT
                                   KCU.TABLE_NAME AS `table`,
                                   KCU.COLUMN_NAME AS field,
                                   KCU.REFERENCED_TABLE_NAME AS foreign_table,
                                   KCU.REFERENCED_COLUMN_NAME AS foreign_field,
                                   TC.CONSTRAINT_NAME AS constraint_name,
                                   CASE WHEN KCU.REFERENCED_TABLE_NAME IS NOT NULL THEN 'foreign_keys'
                                        WHEN KCU.CONSTRAINT_NAME = 'PRIMARY' THEN 'primary_keys'
                                        WHEN TC.CONSTRAINT_TYPE = 'UNIQUE' THEN 'unique_keys'
                                   END AS key_type
                               FROM
                                   INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS KCU LEFT JOIN
                                   INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS TC ON (KCU.CONSTRAINT_NAME = TC.CONSTRAINT_NAME AND
                                                                                  KCU.TABLE_NAME = TC.TABLE_NAME AND
                                                                                  KCU.TABLE_SCHEMA = TC.TABLE_SCHEMA)
                               WHERE
                                   KCU.CONSTRAINT_SCHEMA = '" . $this->database_name . "' AND
                                   (KCU.CONSTRAINT_NAME = 'PRIMARY' OR
                                       (KCU.REFERENCED_TABLE_NAME IS NOT NULL AND
                                           KCU.REFERENCED_COLUMN_NAME IS NOT NULL) OR
                                       TC.CONSTRAINT_TYPE = 'UNIQUE')
                               ORDER BY
                                   KCU.TABLE_NAME ASC,
                                   KCU.COLUMN_NAME ASC";

              } elseif ($this->database_type == 'pgsql') {

                              $sql  = "SELECT
                                   c.relname AS table,
                                   a.attname AS field,
                                   rt.relname AS foreign_table,
                                   rf.attname AS foreign_field,
                                   co.conname AS constraint_name,
                                   CASE WHEN co.contype = 'f' THEN 'foreign_keys'
                                        WHEN co.contype = 'p' THEN 'primary_keys'
                                        WHEN co.contype = 'u' THEN 'unique_keys'
                                   END AS key_type,
                                   CASE co.confdeltype
                                           WHEN 'c' THEN 'cascade'
                                           WHEN 'a' THEN 'no_action'
                                           WHEN 'r' THEN 'restrict'
                                           WHEN 'n' THEN 'set_null'
                                           WHEN 'd' THEN 'set_default'
                                   END AS on_delete
                               FROM
                                   pg_attribute AS a INNER JOIN
                                   pg_class AS c ON a.attrelid = c.oid INNER JOIN
                                   pg_constraint AS co ON (a.attnum = ANY (co.conkey) AND co.conrelid = c.oid) LEFT JOIN
                                   pg_class AS rt ON co.confrelid = rt.oid LEFT JOIN
                                   pg_attribute AS rf ON (rf.attnum = ANY (co.confkey) AND rt.oid = rf.attrelid)
                               WHERE
                                   (co.contype = 'p' OR co.contype = 'f' OR co.contype = 'u') AND
                                   NOT a.attisdropped
                               ORDER BY
                                   c.relname, a.attname";

                          } elseif ($this->database_type == 'mssql') {

                                  $sql = "SELECT
                                  c.table_name AS 'table',
                                  kcu.column_name AS field,
                                  kcu.constraint_name AS constraint_name,
                                  CASE c.constraint_type
                                      WHEN 'PRIMARY KEY' THEN 'primary_keys'
                                      WHEN 'FOREIGN KEY' THEN 'foreign_keys'
                                      WHEN 'UNIQUE' THEN 'unique_keys'
                                  END AS key_type,
                                  ccu.table_name as foreign_table,
                                  ccu.column_name as foreign_field,
                                  REPLACE(LOWER(rc.delete_rule), ' ', '_') AS on_delete
                              FROM
                                  INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS c INNER JOIN
                                  INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS kcu ON c.table_name = kcu.table_name AND c.constraint_name = kcu.constraint_name LEFT JOIN
                                  INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS AS rc ON c.constraint_name = rc.constraint_name LEFT JOIN
                                  INFORMATION_SCHEMA.CONSTRAINT_COLUMN_USAGE AS ccu ON ccu.constraint_name = rc.unique_constraint_name
                              WHERE
                                  c.constraint_catalog = '" . $this->database_name . "'";
                          }

                          $result = $this->query($sql);

                          if ($this->numRows($result)) {

                                  while ($row = $this->getRow($result)) {
                      $temp = array();
                      if ($row['key_type'] == 'unique_keys') {
                          if (!isset($output[$row['table']]['unique_keys'][$row['constraint_name']])) {
                              $output[$row['table']]['unique_keys'][$row['constraint_name']] = array();
                          }
                              array_push($output[$row['table']][$row['key_type']][$row['constraint_name']], $row['field']);
                      } else {
                          foreach ($row as $column => $value) {
                              if (!in_array($column, array('table', 'key_type', 'on_delete', 'constraint_name')) && !empty($value)) {
                                  $temp[$column] = $value;
                              }
                              if ($column == 'on_delete') {
                                  $temp[$column] = $value;
                                                          }
                          }
                          // Add the mysql cascade info
                          if ($this->database_type == 'mysql') {
                                  if (isset($mysql5_foreign_key_on_deletes[$row['table'] . ':' . $row['field'] . ':' . $row['foreign_table'] . ':' . $row['foreign_field']])) {
                                          $temp['on_delete'] = $mysql5_foreign_key_on_deletes[$row['table'] . ':' . $row['field'] . ':' . $row['foreign_table'] . ':' . $row['foreign_field']];
                                                          }
                                                  }
                          $output[$row['table']][$row['key_type']][] = $temp;
                      }
                                  }

                  // Add child keys by looping through every foreign key
                  $tables = array_keys($output);
                  foreach ($tables as $table) {
                      if (empty($output[$table]['foreign_keys'])) { continue; }

                      $temp = array();

                      // Get a list of foreign keys
                      $foreign_keys = array();
                      foreach ($output[$table]['foreign_keys'] as $key => $value) {
                          if ($key == 'field') { $foreign_keys[] = $value['field']; }
                      }
                      sort($foreign_keys);

                      // Get a list of primary keys
                      $primary_keys = array();
                      foreach ($output[$table]['primary_keys'] as $key => $value) {
                          if ($key == 'field') { $primary_keys[] = $value['field']; }
                      }
                      sort($primary_keys);

                      // If the foreign keys and primary keys are the same it is a linking table
                      if ($foreign_keys == $primary_keys) {
                          $fkey1 = $output[$table]['foreign_keys'][0];
                          $fkey2 = $output[$table]['foreign_keys'][1];

                          // Add the child key to the first foreign table
                          $temp['child_table']            = $fkey2['foreign_table'];
                          $temp['child_primary_key']      = $fkey2['foreign_field'];
                          $temp['link_child_primary_key'] = $fkey2['field'];
                          $temp['link_table']             = $table;
                          $temp['link_field']             = $fkey1['field'];
                          $output[$fkey1['foreign_table']]['child_keys'][] = $temp;

                          // Add the child key to the second foreign table
                          $temp['child_table']            = $fkey1['foreign_table'];
                          $temp['child_primary_key']      = $fkey1['foreign_field'];
                          $temp['link_child_primary_key'] = $fkey1['field'];
                          $temp['link_table']             = $table;
                          $temp['link_field']             = $fkey2['field'];
                          $output[$fkey2['foreign_table']]['child_keys'][] = $temp;

                          // Since this is a link table we don't want any record of it
                          unset($output[$table]);
                          continue;
                      }

                      // This is a normal table
                      foreach ($output[$table]['foreign_keys'] as $foreign_key) {
                                                  $temp['child_table']       = $table;
                                                  $temp['child_primary_key'] = $output[$table]['primary_keys'][0]['field'];
                          $temp['child_field']       = $foreign_key['field'];
                                                  $temp['on_delete']         = $foreign_key['on_delete'];
                          $output[$foreign_key['foreign_table']]['child_keys'][] = $temp;
                      }
                  }

                  // Change the primary keys array into a single primary key value
                  $tables = array_keys($output);
                  foreach ($tables as $table) {
                      if (isset($output[$table]['primary_keys'][0])) {
                          $output[$table]['primary_key_field'] = $output[$table]['primary_keys'][0]['field'];
                      } else {
                          $output[$table]['primary_key_field'] = '';
                      }
                      unset($output[$table]['primary_keys']);
                  }
                          }
                  }

                  if (sizeof($output) < 1) {
                          $this->error = 'Unable to retrieve constraints for the options specified';
                          return FALSE;
                  }

                  return $output;
          }


      /**
       * Gets a list of all tables in the current database
       *
       * @since 6.0.0
       *
       * @param  void
       * @return array  The tables in the current database
       */
      public function listTables()
      {
          $tables = array();

          // Get a list of tables and a little info about the database
          if ($this->database_type == 'mysql') {
              $sql = "SHOW TABLES";
                  } elseif ($this->database_type == 'mssql') {
                          $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES";
          } elseif ($this->database_type == 'pgsql') {
              $sql = "SELECT tablename FROM pg_tables WHERE tableowner = current_user AND tablename !~ '^(pg|sql)_' ORDER BY lower(tablename)";
          }

          $result = $this->query($sql);
          if ($this->numRows($result)) {
              $keys_found = FALSE;
              while ($row = $this->getRow($result)) {
                  if (!$keys_found) {
                      $keys = array_keys($row);
                      $keys_found = TRUE;
                  }
                  $tables[] = $row[$keys[0]];
              }
          }

          return $tables;
      }


      /**
       * Gets a list of all databases on the current server
       *
       * @since 6.1.0
       *
       * @param  boolean $exclude_system_databases  If system databases should be excluded from the list
       * @return array  The databases on the current server
       */
      public function listDatabases($exclude_system_databases=TRUE)
      {
          $databases = array();

          // Get a list of tables and a little info about the database
          if ($this->database_type == 'mysql') {
              $sql = "SHOW DATABASES";
                  } elseif ($this->database_type == 'mssql') {
                          $sql = "SELECT distinct(catalog_name) FROM INFORMATION_SCHEMA.SCHEMATA";
          } elseif ($this->database_type == 'pgsql') {
              $sql = "SELECT datname FROM pg_database";
              if ($exclude_system_databases) {
                  $sql .= " WHERE datname != 'postgres' AND datname !~ 'template[0-9]' ";
              }
              $sql .= "ORDER BY lower(datname)";
          }

          $result = $this->query($sql);
          if ($this->numRows($result)) {
              $keys_found = FALSE;
              while ($row = $this->getRow($result)) {
                  if (!$keys_found) {
                      $keys = array_keys($row);
                      $keys_found = TRUE;
                  }
                  $databases[] = $row[$keys[0]];
              }
          }

          if ($this->database_type == 'mysql' && $exclude_system_databases) {
              $databases = array_merge(array_diff($databases, array('information_schema', 'mysql', 'test')));
          }

          return $databases;
          }


          /**
           * Prepares data for database entry
           * @since v7.1.0
           *
           * @param mixed  $data  Data to prepare
           * @return mixed
           */
          public function prepareData($data)
          {
                  if (!is_string($data)) {
                          return $data;
                  }

                  switch ($this->database_type) {
                          case 'mysql':
                                  return mysqli_escape_string($data);
                                  break;
                          case 'pgsql':
                                  return pg_escape_string($data);
                                  break;
                  }

                  // couldn't prepare data specially for your database
                  return str_replace("'", "''", $data);
          }


      /**
           * Closes the database connection
           *
           * @since 3.0.0
           *
           * @param  void
           * @return void
           */
          public function __destruct()
          {
                  $this->printDebug('Total time spent on queries was ' . (number_format($this->debug_time, 5, '.', ',')) . ' seconds', TRUE);
          $func = $this->prefix . 'close';
                  @$func($this->connection);
          }

  }

  ?>
