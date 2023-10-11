<?php
/**
 * Paginator - Paginates multiple results
 *                                                
 * @copyright 2002-2006 iMarc LLC <info@imarc.net>
 *
 * @version 4.0.1
 *
 * @author  Dave Tufts [dt] <dave@imarc.net>
 * @author  Fred LeBlanc [fl] <fred@imarc.net>
 * @author  William Bond [wb] <will@imarc.net>
 * @author  Craig Ruksznis [cr] <craigruk@imarc.net>
 *
 * @requires PHP 5.0+
 *
 * @changes 4.0.1  Fixed reference issue to preg_match_all on line 535 [cr, 2007-08-22]
 * @changes 4.0.0  Added default conf entries to class, changed conf loading to a manual method call [wb, 2007-05-30]
 * @changes 3.3.2  Fixed more strict error reporting issues [wb, 2006-11-30]
 * @changes 3.3.1  Fixed some strict error reporting issues [wb, 2006-10-11]
 * @changes 3.3.0  Added getItemsPerPage() since that may be a default value from within the paginator [fl, 2006-09-20]
 * @changes 3.2.0  Fixed bug where Prev/Next text from conf file would not be used for disabled links and added conf entries for css classes and link separator [wb, 2006-09-18]
 * @changes 3.1.0  Change constructor parameter order, added items_per_page to constructor, and changed the default base_link to the current_url with page in the querystring [wb, 2006-09-15]
 * @changes 3.0.0  complete recoded and restructured class, breaks all backwards compatibility [fl, 2006-09-11]
 * @changes 2.1.0  added methods getCurrentPage(), getLastPage(), getResultsPerPage), getBaseQuerystring() and added prefix_text option to conf [wb, 2006-03-17]
 * @changes 2.0.1  updated version number to correct version, fixed code standards issues [wb, 2006-02-06]
 * @changes 2.0.0  updated class to comply with new code standards [fl, 2006-01-09]
 * @changes 1.2.0  added set_rewritten(), altered make_link() to handle mod rewrite [fl, 2006-01-06]
 * @changes 1.1.3  make_link() now allows 'page' to be only query-string variable [fl, 2005-12-30]
 * @changes 1.1.2  make_link() now allows 'page' to be only query-string variable [fl, 2005-12-30]
 * @changes 1.1.1  Fixed missing scope keyword for xhtml_query() [fl, 2005-12-19]
 * @changes 1.1.0  Added paginator.conf.php (for templates) [fl, 2005-12-15]
 */
class Paginator
{
	/**
	 * Version number:  major.minor.bug-fix
	 *
	 * @var string
	 */
	protected $version = '4.0.0';

	/**
	 * Error message
	 *
	 * @var string
	 */
	protected $error;

	/**
	 * Warning messages
	 *
	 * @var array
	 */
	protected $warnings;

	/**
	 * Items to show per page
	 *
	 * @var int
	 */
	protected $items_per_page;

	/**
	 * Base link to use for linking
	 *
	 * @var string
	 */
	protected $base_link;

	/**
	 * Array of calculations made by the class, used in displaying to template
	 *
	 * @var array
	 */
	protected $calculation_cache;

	
	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 *
	 * @param integer $total_items     Total number of items in result set
	 * @param integer $current_page    Page currently being displayed, defaults to 1
	 * @param integer $items_per_page  Number of items to display per page, defaults to 10
	 * @return void
	 */
	public function __construct($total_items, $current_page=1, $items_per_page=10)
	{
		// convert passed parameters to ints
		settype($current_page,   'int');
		settype($total_items,    'int');
        settype($items_per_age,  'int');

		// if no items, do not print anything, stop class
		if ($total_items < 1) {
			return; /*** AHHHH ***/
		}

		// set variables and defaults
		$this->items_per_page     = $items_per_page;
		$this->total_items        = $total_items;
		$this->current_page       = $this->makeVariable('current_page', array('current_page' => $current_page));
		$this->calculation_cache  = array();
        
        // Set up the default base_link
        if ($_SERVER['QUERY_STRING']) {
            $qs = preg_replace('/&(?!(#\d+|[a-z]+);)/i', '&amp;', $_SERVER['QUERY_STRING']);
            if (preg_match('/\bpage=\d+/', $_SERVER['QUERY_STRING'])) {
                $this->base_link = $_SERVER['PHP_SELF'] . '?' . preg_replace('/\bpage=\d+/', 'page=[%page%]', $qs);    
            } else {
                $this->base_link = $_SERVER['PHP_SELF'] . '?' . $qs . '&amp;page=[%page%]';
            }
        } else {
            $this->base_link = $_SERVER['PHP_SELF'] . '?page=[%page%]';
        }

		$this->error              = '';
		$this->warnings           = array();

		/* template variables */
		$this->template_vars                                 = array();
		$this->template_vars['pages_omitted']                = '...';
		$this->template_vars['next_link_text']               = 'Next';
		$this->template_vars['previous_link_text']           = 'Previous';
        $this->template_vars['link_separator']               = ' ';
        $this->template_vars['page_direct_class']            = 'page_direct';
        $this->template_vars['page_highlighted_class']       = 'page_highlighted';
        $this->template_vars['page_relative_class']          = 'page_relative';
        $this->template_vars['page_relative_disabled_class'] = 'page_relative_disabled';

		/* templates */
		$this->templates                = array();
		$this->templates['page_walker'] = 'Pages: [%previous_page_link%] [%surrounding_pages padding="4"%] [%next_page_link%]';
	}


	/**
	 * Loads configuration file, overwrites defaults as necessary and sets new values
	 *
	 * @since  3.0.0
	 *
	 * @param string $config_file  The configuration file to load
	 * @return void
	 */
	public function loadConfiguration($config_file)
	{
		if ($config_file && file_exists($config_file)) {
			include($config_file);

			// load template vars
			if (@sizeof($paginator_template_vars)) {
				foreach($paginator_template_vars as $key => $value) {
					$this->template_vars[$key] = $value;
				}
			}

			// get paginator templates
			if (@sizeof($paginator_templates)) {
				foreach($paginator_templates as $template => $structure) {
					$this->templates[$template] = $structure;
				}
			}
		}
	}


	/**
	 * Contains all of the formulas for making calculations into variables
	 *
	 * @since  3.0.0
	 *
	 * @param string  $function  Calculation function to perform
	 * @param mixed   $arg       Optional arguments (specific to each function)
	 * @return mixed
	 */
	private function makeVariable($function)
	{
		if (isset($this->calculation_cache[$function])) {
			return $this->calculation_cache[$function];
		} else {
			switch ($function) {

				/* returns the total number of pages */
				case 'number_of_pages':
					$result = ceil($this->total_items / $this->items_per_page);
					break;

				/* returns total number of items in result set (as passed in) */
				case 'number_of_items':
					$result = $this->total_items;
					break;

				/* returns the number of items being displayed per page */
				case 'items_per_page':
					$result = $this->items_per_page;
					break;

				/* returns an 's' to pluralize 'items' or 'results' when needed */
				case 'item_plural':
					$total_items = $this->makeVariable('number_of_items');
					$result      = ($total_items == 1) ? '' : 's';
					break;

				/* returns an 's' to pluralize 'pages' when needed */
				case 'page_plural':
					$total_pages = $this->makeVariable('number_of_pages');
					$result      = ($total_pages == 1) ? '' : 's';
					break;

				/* returns the first page of the result set */
				case 'first_page':
					$result = 1;
					break;

				/* returns a link to the last page of the result set */
				case 'first_page_link':
					$first_page  = $this->makeVariable('first_page');
					$result      = $this->makeLink($first_page, $first_page, $this->template_vars['page_direct_class']);
					break;

				/* returns a link to the last page of the result set */
				case 'last_page_link':
					$last_page  = $this->makeVariable('number_of_pages');
					$result     = $this->makeLink($last_page, $last_page, $this->template_vars['page_direct_class']);
					break;

				/* returns a validated value for current page */
				/* params: (int $current_page) */
				case 'current_page':
					$last_page  = $this->makeVariable('number_of_pages');
					$all_args   = func_get_args();
					$args       = array_pop($all_args);

					$page       = $args['current_page'];

					if ($page > $last_page) {
						$result = $last_page;
					} elseif ($page < 1) {
						$result = 1;
					} else {
						$result = $page;
					}
					break;

				/* returns a link to the current page */
				case 'current_page_link':
					$all_args   = func_get_args();
					$args       = array_pop($all_args);
					$highlight  = (isset($args['highlight'])) ? (bool) $args['highlight'] : FALSE;
					$class      = ($highlight) ? $this->template_vars['page_highlighted_class'] : $this->template_vars['page_direct_class'];

					$current_page = $this->makeVariable('current_page', array('current_page' => $this->current_page));
					$result = $this->makeLink($current_page, $current_page, $class);
					break;

				/* returns the number of the next page */
				case 'next_page':
					$current_page = $this->makeVariable('current_page', array('current_page' => $this->current_page));
					$last_page    = $this->makeVariable('number_of_pages');

					if ($current_page < $last_page) {
						$next_page = $current_page + 1;
						$result    = (int) $next_page;
					} else {
						$result = '';
					}
					break;

				/* returns link to next page or disabled text */
				case 'next_link':
					$next_page = $this->makeVariable('next_page');

					if (is_int($next_page)) {
						$result = $this->makeLink($next_page, $this->template_vars['next_link_text'], $this->template_vars['page_relative_class']);
						break;
					} else {
						$result = '<span class="' . $this->template_vars['page_relative_disabled_class'] . '">' . $this->template_vars['next_link_text'] . '</span>';
					}
					break;

				/* returns the number of the previous page */
				case 'previous_page':
					$current_page = $this->makeVariable('current_page', array('current_page' => $this->current_page));

					if ($current_page > 1) {
						$previous_page = $current_page - 1;
						$result        = (int) $previous_page;
					} else {
						$result = '';
					}
					break;

				/* returns link to previous page or disabled text */
				case 'previous_link':
					$previous_page = $this->makeVariable('previous_page');

					if (is_int($previous_page)) {
						$result = $this->makeLink($previous_page, $this->template_vars['previous_link_text'], $this->template_vars['page_relative_class']);
					} else {
						$result = '<span class="' . $this->template_vars['page_relative_disabled_class'] . '">' . $this->template_vars['previous_link_text'] . '</span>';
					}
					break;

				/* returns the number of the first result on this page relative to the total result set */
				case 'first_item':
					$current_page   = $this->makeVariable('current_page', array('current_page' => $this->current_page));
					$items_per_page = $this->makeVariable('items_per_page');
					$result         = (($current_page - 1) * $items_per_page) + 1;
					break;

				/* returns the number of the last result on this page relative to the total result set */
				case 'last_item':
					$current_page   = $this->makeVariable('current_page', array('current_page' => $this->current_page));
					$items_per_page = $this->makeVariable('items_per_page');
					$total_items    = $this->makeVariable('number_of_items');
					$last_item      = $current_page * $items_per_page;
					$result         = ($last_item > $total_items) ? $total_items : $last_item;
					break;

				/* returns a set of next pages */
				case 'next_pages':
					$all_args   = func_get_args();
					$args       = array_pop($all_args);
					$pages      = (isset($args['pages'])) ? (int) $args['pages']  : 4;

					$page_pointer    = $this->makeVariable('current_page', array('current_page' => $this->current_page)) + 1;
					$total_pages     = $this->makeVariable('number_of_pages');
					$pages_available = $total_pages - $page_pointer;

					$limit           = ($pages_available > $pages) ? $pages : $pages_available;
					$output          = array();

					for ($i = 0; $i < $limit; ++$i) {
						array_push($output, $this->makeLink($page_pointer, $page_pointer, $this->template_vars['page_direct_class']));
						++$page_pointer;
					}

					$result = join($this->template_vars['link_separator'], $output);
					break;

				/* returns a set of previous pages */
				case 'previous_pages':
					$all_args   = func_get_args();
					$args       = array_pop($all_args);
					$pages      = (isset($args['pages'])) ? (int) $args['pages']  : 4;

					$page_pointer    = $this->makeVariable('current_page', array('current_page' => $this->current_page)) - 1;
					$pages_available = $page_pointer;

					$limit           = ($pages_available > $pages) ? $pages : $pages_available;
					$page_pointer    = $page_pointer - ($limit - 1);
					$output          = array();

					for ($i = 0; $i < $limit; ++$i) {
						array_push($output, $this->makeLink($page_pointer, $page_pointer, $this->template_vars['page_direct_class']));
						++$page_pointer;
					}

					$result = join($this->template_vars['link_separator'], $output);
					break;

				/* returns a contextual set of pages based around current page */
				case 'surrounding_pages':
					$all_args   = func_get_args();
					$args       = array_pop($all_args);
					$padding    = (isset($args['padding'])) ? (int) $args['padding']  : 5;
					$splurge    = (isset($args['splurge'])) ? (bool) $args['splurge'] : TRUE;
					$ends       = (isset($args['ends']))    ? (bool) $args['ends']    : TRUE;

					$total_pages   = $this->makeVariable('number_of_pages');
					$current_page  = $this->makeVariable('current_page', array('current_page' => $this->current_page));

					// determine left and right limits
					$available_left   = ($current_page - 1 > $padding)            ? $padding : $current_page - 1;
					$available_right  = ($total_pages - $current_page > $padding) ? $padding : $total_pages - $current_page;

					// adjust numbers for left and right
					if ($available_left != $padding) {
						$available_left  += $padding - $available_left;
					}
					if ($available_right != $padding) {
						$available_right += $padding - $available_right;
					}

					// maximum number of pages left to be prints
					$pages_to_print = $padding * 2 + 1;

					if ($current_page - $available_left < 1) {
						// start page would be less than 1
						$start_left   = 1;

						// we might need/want to add in the leftover spots on
						// the left to the right... i'm not sure yet.
					} else {
						// start page ok
						$start_left   = $current_page - $available_left;
					}

					// splurge! if low page is 2 or top page is $max - 1, add on that last page
					if ($splurge) {
						if ($start_left + $pages_to_print == $total_pages) {
							++$pages_to_print;
						}
						if ($start_left - 1 == 1) {
							$start_left = 1;
							++$pages_to_print;
						}
					}

					$output = array();
					$page   = $start_left;

					for ($i = 0; $i < $pages_to_print; ++$i) {
						if ($page <= $total_pages && $page >= 1) {
							if ($page != $current_page) {
								// print normal link
								array_push($output, $this->makeLink($page, $page, $this->template_vars['page_direct_class']));
							} else {
								// print highlighted link
								array_push($output, $this->makeLink($page, $page, $this->template_vars['page_highlighted_class']));
							}
							++$page;
						}
					}

					if ($ends && $start_left >= 3) {
						array_unshift($output, $this->makeLink(1, 1, $this->template_vars['page_direct_class']));

						if ($start_left > 1) {
							array_unshift($output, $this->template_vars['pages_omitted']);
							$temp      = $output[1];
							$output[1] = $output[0];
							$output[0] = $temp;
						}
					}

					if ($ends && ($page - 1) < ($total_pages - 1)) {
						array_push($output, $this->makeLink($total_pages, $total_pages, $this->template_vars['page_direct_class']));

						if ($page <= $total_pages) {
							array_push($output, $this->template_vars['pages_omitted']);
							$last_item = @sizeof($output) - 1;

							$temp  = $output[$last_item];
							$output[$last_item] = $output[$last_item - 1];
							$output[$last_item - 1] = $temp;
						}
					}

					$result = join($this->template_vars['link_separator'], $output);
					break;
					
				/* on unknown calculation, returns empty string */
				default:
					return '';
			}

			/* cache for later */
			$this->calculation_cache[$function] = $result;
			return $result;
		}
	}


	/**
	 * Maps template variables to calculations
	 *
	 * @since  3.0.0
	 *
	 * @param string  $variable  Variable to convert
	 * @return string
	 */
	private function getFunctionName($variable)
	{
		$map = array (

			/* communication */
			'first_result'        => 'first_item',
			'last_result'         => 'last_item',
			'total_results'       => 'number_of_items',
			'results_per_page'    => 'items_per_page',

			'first_page'          => 'first_page',
			'last_page'           => 'number_of_pages',
			'current_page'        => 'current_page',
			'total_pages'         => 'number_of_pages',
			'next_page'           => 'next_page',
			'previous_page'       => 'previous_page',

			'page_plural'         => 'page_plural',
			'result_plural'       => 'item_plural',

			/* interaction */
			'first_page_link'     => 'first_page_link',
			'last_page_link'      => 'last_page_link',
			'current_page_link'   => 'current_page_link',
			'next_page_link'      => 'next_link',
			'previous_page_link'  => 'previous_link',

			/* interactive bunches */
			'next_pages'          => 'next_pages',
			'previous_pages'      => 'previous_pages',
			'surrounding_pages'   => 'surrounding_pages'

		);

		if (isset($map[$variable])) {
			return $map[$variable];
		} else {
			array_push($this->warnings, 'Invalid variable <em>' . $variable . '</em> specified.');
			return '';
		}
	}


	/**
	 * Prints a template
	 *
	 * @since  3.0.0
	 *
	 * @param string  $template  Template (as set in conf file) to print
	 * @return void
	 */
	public function printTemplate($template)
	{
		/* check that template exists */
		if (!isset($this->templates[$template])) {
			$this->error = 'Invalid template <em>' . $template . '</em> specified.';
			return FALSE;
		}

		$display = $this->templates[$template];

		/* get tags */
		$tags = array();
		preg_match_all("/\[\%([a-zA-Z0-9_]+)((?:[\s]+[a-zA-Z_]+=\"[a-zA-Z0-9]+\")*)\%\]*/i", $this->templates[$template], $tags);
		$tag_count = @sizeof($tags[0]);

		/* replaces tags with appropriate calculations */
		if ($tag_count > 0) {
			for ($i = 0; $i < $tag_count; ++$i) {
				$tag          = trim($tags[0][$i]);
				$variable     = trim($tags[1][$i]);
				$attributes   = trim($tags[2][$i]);
				$calculation  = $this->getFunctionName($variable);
                
				/* check for cached calculation results */
				if (!$this->isCached($calculation)) {
					$parameters = array();
                    
                    if (strlen($attributes) > 0) {
						$attribute_array = split(' ', trim($attributes));

						/* make sub-array of options */
						if (@sizeof($attribute_array)) {

							for ($j = 0; $j < sizeof($attribute_array); ++$j) {
								$attribute_array[$j]   = str_replace('"', '', $attribute_array[$j]);
								$pair                  = split('=', trim($attribute_array[$j]));
								$parameters[$pair[0]]  = $pair[1];
							}
						}
					}

					$this->makeVariable($calculation, $parameters);
				}

				/* replace tag with value */
				$display = str_replace(trim($tag), $this->calculation_cache[$calculation], $display);
			}
		}

		echo $display;
	}


	/**
	 * Returns boolean whether given calculation is cached
	 *
	 * @since  3.0.0
	 *
	 * @param string  $calculation  Calculation to check for in cache
	 * @return bool
	 */
	private function isCached($calculation)
	{
		if (isset($this->calculation_cache[$calculation])) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	
	/**
	 * Gives the database starting row to use with limit/dataseek
	 *
	 * @since  2.0.0
	 *
	 * @return int
	 */
	public function getDatabaseStart()
	{
		return $this->makeVariable('first_item') - 1;
	}
	
	
	/**
	 * Returns the number of items per page
	 *
	 * @since  3.3.0
	 *
	 * @return int
	 */
	public function getItemsPerPage()
	{
		return $this->makeVariable('items_per_page');
	}


	/**
	 * Returns error message
	 *
	 * @since  3.0.0
	 *
	 * @return string
	 */
	public function getErrors()
	{
		return $this->error;
	}


	/**
	 * Returns warning array
	 *
	 * @since  3.0.0
	 *
	 * @return array
	 */
	public function getWarnings()
	{
		return $this->warnings;
	}


	/**
	 * Sets the number of items to show per page
	 *
	 * @since  3.0.0
	 *
	 * @param int  $items_per_page  Number of items to show per page
	 * @return void
	 */
	public function setItemsPerPage($items_per_page)
	{
		settype($items_per_page, 'int');
		$this->items_per_page = $items_per_page;
	}


	/**
	 * Sets base link, use [%page%] where page number should go
	 *
	 * @since  2.0.0
	 *
	 * @param string  $base_link  New base link to use
	 * @return void
	 */
	public function setBaseLink($base_link)
	{
		settype($base_link, 'string');
		$this->base_link = $base_link;
	}


	/**
	 * Makes a link out of page number and base_link
	 *
	 * @since  3.0.0
	 *
	 * @param int     $page       Page number to use in link
	 * @param string  $link_text  Text to be linked
	 * @param string  $class      CSS class for surrounding <span> tag
	 * @return string
	 */
	private function makeLink($page, $link_text, $class='')
	{
		settype($page,      'int');
		settype($link_text, 'string');

		$link = '<a href="' . str_replace('[%page%]', $page, $this->base_link) . '">' . $link_text . '</a>';

		/* add CSS class */
		if (!empty($class)) {
			$link = $this->wrapText($link, $class);
		}

		return $link;
	}


	/**
	 * Wraps text in a span, giving it a class
	 *
	 * @since  3.0.0
	 *
	 * @param string  $text  Text to wrap
	 * @param string  $class  CSS class to use in <span> wrapper
	 * @return string
	 */
	private function wrapText($text, $class)
	{
		return '<span class="' . $class . '">' . $text . '</span>';
	}


    /**
	 * Returns the version of the class
	 *
	 * @since  2.0.0
	 *
	 * @return string
	 */
	public function getVersion()
	{
		return $this->version;
	}
}
?>
