<?php
/**
 * site specific functions
 *
 * All extra functions you write that are common to many pages throughout
 * the site should be kept here. Have common.conf.php include this page.
 */



/**
 * Automagically loads class definitions.
 * See: http://php.net/autoload
 *
 * @param string  $class_name  Name of class to load definition for
 * @return void
 */
spl_autoload_register(function ($class_name) {
  $class_paths = [
    $_SERVER['DOCUMENT_ROOT'] . "/library/classes/base",
    $_SERVER['DOCUMENT_ROOT'] . "/library/classes/local"
  ];

  foreach ($class_paths as $class_path) {
    $file_path = $class_path . "/" . $class_name . ".class.php";

    if (file_exists($file_path)) {
      require_once($file_path);
      return;
    }
  }

  die ('Object autoloader unable to include class ' . $file_path);

});

/**
 * Prints an order by table heading
 *
 * @param string order_by current_order_by
 * @param string field_name field name to order by
 * @param string display_name display name for the field
 * @return void
 */
function print_order_by($order_by, $field_name, $display_name) {
  $new_order_by = $field_name . '_asc';
  if ($order_by == $field_name . '_asc') {
    $new_order_by = $field_name . '_desc';
    $display_name = $display_name . '<span class="order_by_arrow">&darr;</span>';
  } else if ($order_by == $field_name . '_desc') {
    $display_name = $display_name . '<span class="order_by_arrow">&uarr;</span>';
  }

  parse_str($_SERVER['QUERY_STRING'], $query_array);
  unset($query_array['order_by']);

  $query_string = '?' . (($_SERVER['QUERY_STRING']) ? http_build_query($query_array, '', '&') . '&' : '') . "order_by=" . $new_order_by;

  echo '<a href="' . $_SERVER['PHP_SELF'] . $query_string . '">' . $display_name . '</a>';
}

/**
 * parses an order by value
 *
 * @param string order_by current_order_by
 * @param string transformed_order_by
 * @return void
 */
function parse_order_by($order_by) {
  if (substr($order_by, -4, 4) == '_asc') {
    return substr($order_by, 0, -4) . " ASC";
  } else if (substr($order_by, -5, 5) == '_desc') {
    return substr($order_by, 0, -5) . " DESC";
  }
}


/**
 * prints a label
 *
 * @param string for the id the label is for
 * @param string display_name the display text for the label
 * @return void
 */
function print_label($display_name, $for=NULL) {
  $for_attr = ($for) ? " for=\"${for}\"" : "";
  echo "<label${for_attr}>${display_name}</label>";
}


/**
 * prints a text input field
 *
 * @param string type
 * @param string name
 * @param string value
 * @param string id
 * @return void
 */
function print_input($type, $name, $value, $id=NULL, $maxlength=NULL) {
  $value = form_value($value);
  $maxlength_attr = ($maxlength) ? "maxlength=\"${maxlength}\" " : "";
  $id_attr = ($id) ? "id=\"${id}\" " : "";
  echo "<input type=\"${type}\" name=\"${name}\" value=\"${value}\" class=\"${type}_input\" ${id_attr}${maxlength_attr}/>";
}

/**
 * prints a text input field
 *
 * @param string name
 * @param string value
 * @param string id
 * @param string rows
 * @param string cols
 * @return void
 */
function print_textarea($name, $value, $id=NULL, $rows=NULL, $cols=NULL) {
  $value = form_value($value);
  $id_attr = ($id) ? " id=\"${id}\"" : "";
  $rows_attr = ($rows) ? " rows=\"${rows}\"" : "rows=\"10\"";
  $cols_attr = ($cols) ? " cols=\"${cols}\"" : "cols=\"40\"";
  echo "<textarea name=\"${name}\" class=\"${name}_textarea\" ${id_attr}${rows_attr}${cols_attr}>${value}</textarea>";
}

/**
 * prints an option for a select box
 *
 * @param string variable
 * @param string value
 * @return void
 */
function print_option($variable, $value, $display, $id=NULL)
{
  $display = html_value($display);
  $selected = ($variable == $value) ? " selected=\"selected\"" : '';
  $value = form_value($value);
  $id = ($id) ? "id=\"${id}\" " : '';
  echo "<option ${id}value=\"{$value}\"{$selected}>{$display}</option>\n";
}

/**
 * prints a select box
 *
 * @param string name
 * @param string value
 * @param array valid_values
 * @param string id
 * @param string display_values
 * @param bool add_all
 * @return void
 */
function print_select($name, $value, $valid_values, $id=NULL, $display_values=NULL, $add_all=NULL) {
  $id_attr = ($id) ? " id=\"${id}\"" : "";
  echo "<select name=\"${name}\"${id_attr}>";
  if ($add_all) {
    print_option($value, '', 'All');
  }
  foreach($valid_values as $key => $valid_value) {
    print_option($value, $valid_value, ($display_values) ? $display_values[$key] : wordify($valid_value));
  }
  echo "</select>";
}

/**
 * prints an input with a label
 *
 * @param string type
 * @param string name
 * @param string value
 * @param string display_name
 * @return void
 */
function print_labeled_input($type, $name, $value, $display_name) {
  print_label($display_name, $name . '_input');
  print_input($type, $name, $value, $name . '_input', 255);
}

/**
 * prints a textarea with a label
 *
 * @param string name
 * @param string value
 * @param string display_name
 * @return void
 */
function print_labeled_textarea($name, $value, $display_name) {
  print_label($display_name, $name . '_textarea');
  print_textarea($name, $value, $name . '_textarea');
}

/**
 * prints a select box with a label
 *
 * @param string name
 * @param string value
 * @param array valid_values
 * @param string display_name
 * @param string add_all
 * @return void
 */
function print_labeled_select($name, $value, $valid_values, $display_name, $add_all=NULL) {
  print_label($display_name, $name . '_select');
  print_select($name, $value, $valid_values, $name . '_select', NULL, $add_all);
}

/**
206   * Returns the string converted from lowercase with _s to word uppercase with spaces, also run through htmlentities
207   *
208   * @param  string string  The string to convert
209   * @return string  The converted string
210   */
function wordify($string) {
  return preg_replace_callback(
      '/([^\w\']id($|[^\w\'])|(^|[^\w\'])[\w\'])/',
      function ($m) { return strtoupper($m[1]);  },
      str_replace('_', ' ', $string));
}


/**
 * Function to add TinyMCE rich text editor to a page.
 *
 * @since 3.7.0
 *
 * @param  mixed  $ids        The ids of the text areas to be replaced with the editor
 * @param  string $css_files  The web path to a css file, array of css files, or comma seperated list of css files to use for the content in the editor
 * @param  string $js_dirs    The web path to the javascript dir
 * @return void
 */
function local_rich_text_editor($ids, $css_files='', $js_dir='/js/rich_text_editor/')
{
  if (empty($ids)) {
    die('Please specify one or more textareas to replace with the rich text editor');
  } elseif (is_array($ids)) {
    $ids = implode(',', $ids);
  } else {
    $ids = str_replace(' ', '', $ids);
  }

  // Make sure we have an array of css files
  if (empty($css_files)) {
    die('There are no valid css files specified for the rich text editor. The second parameter of rich_text_editor() must contain a list if css files to use.');
  } elseif (!is_array($css_files) && strpos($css_files, ',') !== FALSE) {
    $css_files = explode(',', $css_files);
  } elseif (!is_array($css_files)) {
    $css_files = array($css_files);
  }

  // Check each css file and then set it to run through the css proxy script
  $new_css_files = array();
  foreach ($css_files as $css_file) {
    $css_path = $_SERVER['DOCUMENT_ROOT'] . $css_file;
    if (file_exists($css_path) && !is_dir($css_path) && is_readable($css_path)) {
      $new_css_files[] = $js_dir . 'css_proxy.php?file=' . urlencode($css_file);
    }
  }
  if (empty($new_css_files)) {
    die('There are no valid css files specified for the rich text editor');
  }
  $css_files = join(',', $new_css_files);

  //
  if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $js_dir) || !is_dir($_SERVER['DOCUMENT_ROOT'] . $js_dir) || !file_exists($_SERVER['DOCUMENT_ROOT'] . $js_dir . 'tiny_mce_gzip.php')) {
    die('The rich text editor javascript could not be found');
  }

  add_to_head('<script type="text/javascript" src="' . $js_dir . 'tiny_mce_gzip.php"></script>', TRUE, FALSE);

  $init_block = <<<DATA
     <script type="text/javascript">
     <!--
     tinyMCE.init({
             mode : "exact",
         elements : "$ids",
             theme : "advanced",
             entity_encoding : "numeric",
             theme_advanced_toolbar_location : "top",
             theme_advanced_toolbar_align : "left",
             theme_advanced_buttons1 : "spellchecker,separator,cut,copy,paste,separator,undo,redo,separator,link,unlink,anchor,image,table,separator,code,help",
             theme_advanced_buttons2 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,separator,bullist,numlist,seperator,outdent,indent,seperator,sup,separator,forecolor,formatselect",
             theme_advanced_buttons3 : "",
             plugins : "imagemanager,inlinepopups,contextmenu,spellchecker,table,advlink,media",
             inline_styles : true,
             convert_fonts_to_spans : true,
             convert_urls : false,
             fix_list_elements : true,
             fix_table_elements : true,
             content_css : "$css_files",
             extended_valid_elements : 'iframe[name|src|framespacing|border|frameborder|scrolling|title|height|width]',
             valid_elements : ""
     +"a[accesskey|charset|class|coords|dir<ltr?rtl|href|hreflang|id|lang|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rel|rev|shape<circle?default?poly?rect|style|tabindex|target|title|type],"
     +"abbr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"acronym[class|dir<ltr?rtl|id|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"address[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"area[accesskey|alt|class|coords|dir<ltr?rtl|href|id|lang|nohref<nohref|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|shape<circle?default?poly?rect|style|tabindex|title|target],"
     +"big[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"blockquote[dir|style|cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"br[class|id|style|title],"
     +"caption[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"cite[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"code[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"col[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title|valign<baseline?bottom?middle?top|width],"
     +"colgroup[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|span|style|title|valign<baseline?bottom?middle?top|width],"
     +"dd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"del[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"dfn[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"div[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"dl[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"dt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"em/i[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"fieldset[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h1[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h2[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h3[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h4[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h5[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"h6[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"hr[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"img[align<top?bottom?middle?left?right|alt|class|dir<ltr?rtl|height|id|ismap<ismap|lang|longdesc|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|src|style|title|usemap|width],"
     +"ins[cite|class|datetime|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"kbd[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"label[accesskey|class|dir<ltr?rtl|for|id|lang|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"legend[align<bottom?left?right?top|accesskey|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"li[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type|value],"
     +"map[class|dir<ltr?rtl|id|lang|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"menu[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"ol[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|start|style|title|type],"
     +"optgroup[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"option[class|dir<ltr?rtl|disabled<disabled|id|label|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|selected<selected|style|title|value],"
     +"p[align<center?justify?left?right|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"pre/listing/plaintext/xmp[align|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|width],"
     +"q[cite|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"samp[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"script[charset|defer|language|src|type],"
     +"select[class|dir<ltr?rtl|disabled<disabled|id|lang|multiple<multiple|name|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|size|style|tabindex|title],"
     +"small[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"span[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"strong/b[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"style[dir<ltr?rtl|lang|media|title|type],"
     +"sub[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"sup[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"table[border|cellpadding|cellspacing|class|dir<ltr?rtl|frame|height|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rules|style|summary|title|width],"
     +"tbody[align<center?char?justify?left?right|char|class|charoff|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
     +"td[abbr|align<center?char?justify?left?right|axis|char|charoff|class|colspan|dir<ltr?rtl|headers|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup|style|title|valign<baseline?bottom?middle?top],"
     +"tfoot[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
     +"th[abbr|align<center?char?justify?left?right|axis|char|charoff|class|colspan|dir<ltr?rtl|headers|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rowspan|scope<col?colgroup?row?rowgroup|style|title|valign<baseline?bottom?middle?top],"
     +"thead[align<center?char?justify?left?right|char|charoff|class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
     +"tr[abbr|align<center?char?justify?left?right|char|charoff|class|rowspan|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|valign<baseline?bottom?middle?top],"
     +"tt[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"u[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title],"
     +"ul[class|compact<compact|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title|type],"
     +"var[class|dir<ltr?rtl|id|lang|onclick|ondblclick|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|style|title]"
     });
     //-->
     </script>
DATA;

  add_to_head($init_block, TRUE, FALSE);
}

/**
 * Used as a spell checker for database searches.  Find an alternate spelling suggestion for $search_string
 *
 * @param  string The search string
 * @param  string The dictionary file
 * @return boolean
 */
function correct_spelling($search_string, $personal_dictionary='') {

  $search_string = strtolower($search_string);

  // Create a copy of the search string to store spelling suggestions in
  $new_search_string = $search_string;

  // Get a list of search words from the search terms to find mispelled words
  // Create an array to hold the parsed search terms.
  $search_words = array();
  $search_words = preg_split('/\s+/', $search_string, -1, PREG_SPLIT_NO_EMPTY);

  // Create a pspell object and then load our custom dictionary file
  $config_handle = pspell_config_create('en');

  // Use siftbox.epnet.com's personal dictionary, if available
  if (strlen($personal_dictionary)) {
    if (file_exists($personal_dictionary)) {
      pspell_config_personal($config_handle, $personal_dictionary);
    }
  }
  pspell_config_mode($config_handle, PSPELL_NORMAL);

  // Create a speller object to handle spell checking and suggestions
  $speller = pspell_new_config($config_handle);

  // Loop through each search word and make a spelling suggestion if it is not spelled right
  foreach($search_words as $temp_item) {
    if (!pspell_check($speller, $temp_item)) {

      // Get a list of suggestions for the current word
      $suggestions = pspell_suggest($speller, $temp_item);
      // If the difference is more than the case, add the suggestion
      if($temp_item != strtolower($suggestions[0])) {
        $new_search_string = str_replace($temp_item,$suggestions[0],$new_search_string);
      }
    }
  }

  // If we did end up giving some suggestions, return the suggested changes
  if($new_search_string != $search_string) {
    return $new_search_string;
  }

  // Otherwise report that we didn't find any problems
  return false;
}
