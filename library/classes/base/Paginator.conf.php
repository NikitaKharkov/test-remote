<?php
/**
 * Paginator Conf
 *
 * @requires Paginator.class.php v3.0.0+
 */

/* --------------------------------------------------------------------- */
/* variable values
/* --------------------------------------------------------------------- */
$paginator_template_vars = array(
	'pages_omitted'                => '...',  // prints when pages are omitted, used by [%surrounding_pages%]
	'next_link_text'               => 'Next',
	'previous_link_text'           => 'Previous',
    'link_separator'               => ' ',
    'page_direct_class'            => 'page_direct',
    'page_highlighted_class'       => 'page_highlighted',
    'page_relative_class'          => 'page_relative',
    'page_relative_disabled_class' => 'page_relative_disabled'
	);

/* --------------------------------------------------------------------- */
/* templates
/*
/* Create as many templates as you'd like, you can call each on your
/* page by using ->printTemplte('template_name'). Templates can be made
/* with the following variables:
/*
/*  [%first_result%]       - Number of first result on page
/*  [%last_result%]        - Number of last result on page
/*  [%total_results%]      - Total number of results found
/*  [%results_per_page%]   - Number of results to be printed per page
/*
/*  [%first_page%]         - Number of first page of results
/*  [%last_page%]          - Number of last page of results
/*  [%current_page%]       - Validated page you're currently viewing
/*  [%total_pages%]        - Total number of pages
/*  [%next_page%]          - Number of next page (or empty string if none)
/*  [%previous_page%]      - Number of previous page (or empty string if none)
/*
/*  [%page_plural%]        - Returns 's' if multiple pages
/*  [%result_plural%]      - Returns 's' if more than one result listed

/*  [%first_page_link%]    - Prints a link to the first page
/*  [%last_page_link%]     - Prints a link to the last page
/*  [%current_page_link%]  - Prints a link to the current page
/*  [%next_page_link%]     - Prints a link to next page (as set in template_vars above)
/*  [%previous_page_link%] - Prints a link to previous page (as set in template_vars above)
/*
/*  [%next_pages%]         - Prints links to the next pages
/*                           Attributes: pages (int) - max number of pages to print
/*  [%previous_pages%]     - Prints links to the previous pages
/*                           Attributes: pages (int) - max number of pages to print
/*  [%surrounding_pages%]  - Prints links to current page and pages around current page
/*                           Attributes: padding (int)  - pages on each side of current page
/*                                       splurge (bool) - prints one extra page on each end when useful
/*                                       ends    (bool) - prints first and last page always
/* --------------------------------------------------------------------- */
$paginator_templates = array(
	'page_walker' => 'Pages: [%previous_page_link%] [%surrounding_pages padding="4"%] [%next_page_link%]',
	);
?>
