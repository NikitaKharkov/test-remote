<?php
/**
 * Template - Web site template class
 *
 * Copyright 2007, iMarc <info@imarc.net>
 *
 * @version   6.2.1
 *
 * @author    Dave Tufts      [dt] <dave@imarc.net>
 * @author    William Bond    [wb] <will@imarc.net>
 * @author    Fred LeBlanc    [fl] <fred@imarc.net>
 * @author    Patrick McPhail [pm] <patrick@imarc.net>
 *
 * @requires  PHP 5.0 or higher
 *
 * @usage     see http://wiki.imarc.net/wikka/TemplateClass for examples
 *
 * @changes   6.2.1  Clean up comments to meet code standards [wb, 2007-07-12]
 * @changes   6.2.0  Added addJavascriptInclude() and
 JavascriptIncludes() for easier template adjustments [fl, 2007-07-12]
 * @changes   6.1.0  Added addStylesheet() and printStylesheets() for easier template adjustments [fl, 2007-07-09]
 * @changes   6.0.1  Fixed bug that allowed trailing slashes on setTemplatePath() [dt, 2007-06-24]
 * @changes   6.0.0  Changed constructor, template_path now the only argument and it's required [dt, 2007-05-23]
 * @changes   5.1.1  printHeader() and printFooter() no longer output PHP warnings if the header and footer are not present [wb, 2006-09-26]
 * @changes   5.1.0  added setHtmlTitle(), setStyle() and setTemplatePath() methods. html_title now optional in constructor [pm, 2006-08-15]
 * @changes   5.0.2  changed all of the include statements so they show error on included files [wb, 2006-03-17]
 * @changes   5.0.1  updated printHeader() and printFooter() to output XHTML 1.0 strict html if no file are provided [wb, 2006-01-31]
 * @changes   5.0.0  removed elements from constructor, now must be set by setData(), added getHtmlTitle [dt, 2006-01-11]
 * @changes   4.0.0  changed class to reflect new iMarc code standards, not backwards compatible [fl, 2006-01-08]
 * @changes   3.1.3  changed class to reflect iMarc code standards, added missing comments, refined comments [wb, 2006-01-05]
 * @changes   3.1.2  fixed bug in print_column() [fl, 2006-01-05]
 * @changes   3.1.1  fixed bug in setColumn() [fl, 2006-01-05]
 * @changes   3.1.0  added is_column_set(), count_columns() and get_columns() [fl, 2006-01-05]
 * @changes   3.0.0  updated class to PHP5, multiple methods removed, not backwards compatible [wb, 2005-12-14]
 * @changes   2.6.1  added isset() check to get_data to quell error notices
 * @changes   2.6.0  added get_data() method to get variables set by setData()
 * @changes   2.5.0  added get_version() method
 * @changes   2.4.0  added set_path() method to override default template_path
 * @changes   2.3.0  fixed bug with $this->template_data in template() method
 * @changes   2.2.0  added set_data() method to set $template_data class variable
 * @changes   2.1.0  removed default breaks between multiple columns
 * @changes   2.0.0  updated comments for phpdoc
 * @changes   1.9.0  fixed spelling error in template variable
 * @changes   1.8.0  added class public variable $template_data for passing any user defined info to the class
 * @changes   1.7.0  initialized private variables (compatibale with PHP error notices)
 * @changes   1.6.0  removed 'file_exists' checks in set_column()
 */
class Template
{

	/**
	 * Current version of class
	 *
	 * @var string
	 */
	private $version = '6.2.0';

	/**
	 * Absolute filesystem location of template directory
	 *
	 * @var string
	 */
	private $template_path;

	/**
	 * Text to be displayed in HTML title tag
	 *
	 * @var string
	 */
	private $html_title;

	/**
	 * Style to use for template
	 *
	 * @var string
	 */
	private $style;

	/**
	 * Associative array of column names and arrays of files to include in that column
	 *
	 * @var array
	 */
	private $columns;

	/**
	 * Generic user data storage
	 *
	 * @var array
	 */
	private $data;

	/**
	 * List of Stylesheets
	 *
	 * @var array
	 */
	private $stylesheets;

	/**
	 * List of Javascript Includes
	 *
	 * @var array
	 */
	private $javascript_includes;


	/**
	 * Class constructor, sets variables
	 *
	 * @since 1.0.0
	 *
	 * @param  string $template_path  Absolute filesystem path for the template directory
	 * @return object
	 */
	public function __construct($template_path)
	{
		if (func_num_args() > 1) { /* added during the jump from 5.x to 6.0 */
			die(
				'The ' . __CLASS__ . ' class constructor, version ' .
				$this->getVersion() . ', accepts a single argument for
				$template_path. Other items are now set with setStyle()
				and setHtmlTitle()'
			);
		}
		$this->setTemplatePath($template_path);
		$this->setHtmlTitle($_SERVER['HTTP_HOST']);
		$this->data                 = array();
		$this->columns              = array();
		$this->stylesheets          = array();
		$this->javascript_includes  = array();
	}

    /**
	 * Sets name of template folder (path from the base, $this->template_path). This folder must contain header.php and footer.php
	 *
	 * @since 5.1.0
	 *
	 * @param  string $style  Directory containing the relevant header and footer
	 * @return void
	 */
	public function setStyle($style)
	{
		$this->style = $style;
	}

    /**
	 * Sets the path to the sites template pages
	 *
	 * @since  5.1.0
	 *
	 * @param  string $template_path  The directory containing the template subdirectories
	 * @return void
	 */
	public function setTemplatePath($template_path)
	{
		$this->template_path = preg_replace("|/$|", "", $template_path); // remove trailing slash from path
	}

    /**
	 * Returns the version of the class
	 *
	 * @since 2.5.0
	 *
	 * @param  void
	 * @return string  The current class version
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * Sets element in data store array
	 *
	 * @since 2.2.0
	 *
	 * @param  mixed $key    The key for the data
	 * @param  mixed $value  The data to store
	 * @return void
	 */
	public function setData($key, $value)
	{
		$this->data[$key] = $value;
	}

	/**
	 * Gets specific element from data store array
	 *
	 * @since 2.6.0
	 *
	 * @param  mixed  $key  The key to get the data for
	 * @return mixed
	 */
	public function getData($key)
	{
		return (array_key_exists($key, $this->data)) ? $this->data[$key] : NULL;
	}

	/**
	 * Sets HTML title to private variable
	 *
	 * @since  5.1.0
	 *
	 * @param  string $title  The new html title
	 * @return string
	 */
	public function setHtmlTitle($title)
	{
		$this->html_title = $title;
	}

	/**
	 * Gets HTML title from private variable
	 *
	 * @since  5.0.0
	 *
	 * @param  void
	 * @return string  The html title
	 */
	public function getHtmlTitle()
	{
		return $this->html_title;
	}

	/**
	 * Sets all column include files as a class variable to be included in the header/footer
	 *
	 * @since 1.0.0
	 *
	 * @param  string $side   The name of column to store
	 * @param  string $files  Comma separated list of file names to include
	 * @return void
	 */
	public function setColumn($side, $files)
	{
		$files      = str_replace(' ', '', $files); // strip slashes
		$file_array = explode(',', $files);         // comma separated string
		$tmp_array  = array();

		foreach ($file_array as $key => $val) {
			if (strlen($val)) {
				$file_to_include = $this->template_path . '/columns/' . $val;
				if ($file_to_include) {
					$tmp_array[] = $file_to_include;
				}
			}
		}

		$this->columns[$side] = $tmp_array;
	}

	/**
	 * Gets a list of columns
	 *
	 * @since 3.1.0
	 *
	 * @param  void
	 * @return array   The columns that have been set
	 */
	public function getColumns()
	{
		return $this->columns;
	}

	/**
	 * Gets number of columns
	 *
	 * @since 3.1.0
	 *
	 * @param  void
	 * @return integer  The number of columns that have been set
	 */
	public function countColumns()
	{
		return sizeof($this->columns);
	}

	/**
	 * Check if a specific column is set
	 *
	 * @since 3.1.0
	 *
	 * @param  string $column_name  Name of column to check
	 * @return bool  If the specified column is set
	 */
	public function isColumnSet($column_name)
	{
		if (!is_string($column_name)) {
			return FALSE;
		}
		return array_key_exists($column_name, $this->columns);
	}

	/**
	 * Includes the header file based on the constructor's $style
	 *
	 * @since 1.0.0
	 *
	 * @param  void
	 * @return void
	 */
	public function printHeader()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/header.php')) {
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
			echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
			echo '<head><title>' . $this->html_title . "</title></head>\n";
			echo '<body>';
		} else {
            include($this->template_path . '/' . $this->style . '/header.php');
        }
	}

  public function printHeaderMT()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/header-mt.php')) {
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
			echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
			echo '<head><title>' . $this->html_title . "</title></head>\n";
			echo '<body>';
		} else {
            include($this->template_path . '/' . $this->style . '/header-mt.php');
        }
	}

	public function printHeaderSF()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/header-sf.php')) {
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
			echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
			echo '<head><title>' . $this->html_title . "</title></head>\n";
			echo '<body>';
		} else {
						include($this->template_path . '/' . $this->style . '/header-sf.php');
				}
	}

	/**
	 * Includes the footer file based on the constructor's $style
	 *
	 * @since 1.0.0
	 *
	 * @param  void
	 * @return void
	 */
	public function printFooter()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/footer.php')) {
			echo "</body>\n";
			echo "</html>\n";
		} else {
            include($this->template_path . '/' . $this->style . '/footer.php');
        }
	}

  public function printFooterMT()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/footer-mt.php')) {
			echo "</body>\n";
			echo "</html>\n";
		} else {
            include($this->template_path . '/' . $this->style . '/footer-mt.php');
        }
	}

	public function printFooterSF()
	{
		if (!file_exists($this->template_path . '/' . $this->style . '/footer-sf.php')) {
			echo "</body>\n";
			echo "</html>\n";
		} else {
						include($this->template_path . '/' . $this->style . '/footer-sf.php');
				}
	}

	/**
	 * Prints the list of files created by $this->set_column
	 *
	 * This method can be called from inside the header/footer files
	 *
	 * @since 1.0.0
	 *
	 * @param  string $side  The column to print
	 * @return void
	 */
	public function printColumn($side)
	{
		if (array_key_exists($side, $this->columns)) {
			if ($col = $this->columns[$side]) {
				reset($col);
				foreach($col as $current_file) {
					include($current_file);
					echo "\n";
				}
			}
		}
	}


	/**
	 * Adds a stylesheet to the list of stylesheets to be printed for this page
	 *
	 * @since 6.1.0
	 *
	 * @param  string  $file   Stylesheet file
	 * @param  string  $media  Media type for stylesheet
	 * @return void
	 */
	public function addStylesheet($file, $media='all')
	{
		// check that file exists
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
			return;
		}

		$stylesheet = array(
			'file'  => $file,
			'media' => $media
			);

		array_push($this->stylesheets, $stylesheet);
	}


	/**
	 * Prints a list of stylesheets in the order in which they were added to the list
	 *
	 * @since 6.1.0
	 *
	 * @param  void
	 * @return void
	 */
	public function printStylesheets()
	{
		if (!sizeof($this->stylesheets)) {
			return;
		}

		foreach ($this->stylesheets as $stylesheet) {
			echo '<link href="' . $stylesheet['file'] . '" type="text/css" rel="stylesheet" media="' . $stylesheet['media'] . '" />';
		}
	}


	/**
	 * Adds a file to the list of Javascript includes to be printed for this page
	 *
	 * @since 6.2.0
	 *
	 * @param  string $file   Javascript include file
	 * @param  string $media  Media type
	 * @return void
	 */
	public function addJavascriptInclude($file, $media='all')
	{
		// check that file exists
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
			return;
		}

		array_push($this->javascript_includes, $file);
	}


	/**
	 * Prints a list of javascript includes in the order in which they were added to the list
	 *
	 * @since 6.2.0
	 *
	 * @param  void
	 * @return void
	 */
	public function printJavascriptIncludes()
	{
		if (!sizeof($this->javascript_includes)) {
			return;
		}

		foreach ($this->javascript_includes as $include) {
			echo '<script type="text/javascript" src="' . $include . '"></script>';
		}
	}

}
?>
