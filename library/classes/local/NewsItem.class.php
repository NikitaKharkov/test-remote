<?
/**    
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class NewsItem extends LoggedRecord
{
	/**
	 * Configures the class
	 * 
	 * @param  void
	 * @return void
	 */
	protected function configure() 
	{
		$this->field_options['title']['xhtml'] = TRUE;
		$this->field_options['content']['xhtml'] = TRUE;
		$this->field_options['display_date']['date_created'] = TRUE;
		$this->field_options['last_updated']['date_updated'] = TRUE;
		$this->field_options['url']['link'] = TRUE;
		
		$this->validation_rules[] = array('one_or_more' => array('content', 'url', 'file'));
	}
	
	/**
	 * Returns the edit page string
	 *
	 * @param void
	 * @return string
	 */
	public function getEditPage() {
		return "/admin/news.php?news_item_id={$this->getPrimaryKey()}&amp;page_function=edit";
	}
	
}
?>