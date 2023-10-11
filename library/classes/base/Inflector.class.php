<?php
/**
 * Inflector - Handles pluralization, singularization and capitalization of words/phrases 
 *        
 * Copyright 2006, iMarc <info@imarc.net>
 * 
 * @version  1.3.0
 *
 * @author   William Bond [wb] <will@imarc.net>
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 *
 * @requires pspell extension
 *  
 * @changes  1.3.0  Added addCustomRule() [wb, 2007-07-15]
 * @changes  1.2.2  Fixed the word "timesheets" [wb, 2007-06-26]
 * @changes  1.2.1  Fixed the word "slideshow" [wb, 2007-04-23]
 * @changes  1.2.0  Added pluralizeByCount() [wb, 2007-04-04]
 * @changes  1.1.3  Fixed the word "blog" and made pspell integration optional [wb, 2007-02-26]
 * @changes  1.1.2  Fixed a few more inflection issues, had to add pspell reliance [wb, 2007-02-07]
 * @changes  1.1.1  Fixed inflection of "data" [wb, 2007-01-31]
 * @changes  1.1.0  Fixed inflection of non-lowercase nouns and some code standards violations [wb, 2006-12-15]
 * @changes  1.0.5  Fixed saves -> save [wb, 2006-11-22]
 * @changes  1.0.4  Merged process rule into main rules [wb, 2006-11-20]
 * @changes  1.0.3  Fixed issue with process -> processes [jt, 2006-11-17]
 * @changes  1.0.2  Fixed an issue with singularize for tives -> tive [wb, 2006-09-06]
 * @changes  1.0.1  Fixed singularizeNoun() method to work properly [wb, 2006-07-31]
 * @changes  1.0.0  First major version [wb, 2006-07-19]
 * @changes  0.1.0  Initial implementation [wb, 2006-07-10]
 */
class Inflector
{

	/**
	 * Current file version
	 * 
	 * @var array
	 */
	private $version = '1.3.0';
	
	/**
	 * Error message
	 * 
	 * @var string
	 */
	private $error;
    
    /**
	 * A cache of singlar => plural nouns already processed
	 * 
	 * @var array
	 */
    private $cache = array();
    
    /**
	 * General singular to plural and plural to singular rules
	 * 
	 * @var array
	 */
    private $rules = array('stp' => array('/([ml])ouse$/'      => '\1ice',
                                          '/tooth$/'           => 'teeth',
                                          '/goose$/'           => 'geese',
                                          '/foot$/'            => 'feet',
                                          '/man$/'             => 'men',
                                          '/((?![aeiou]).)y$/' => '\1ies',
                                          '/((?!oo).{2})f$/'   => '\1ves',
                                          '/fe$/'              => 'ves',
                                          '/us$/'              => 'i',
                                          '/(sh|ch)$/'         => '\1es',
                                          '/(x|s)is$/'         => '\1es',
                                          '/(x|s)$/'           => '\1es',
                                          '/([^o])o$/'         => '\1oes',
                                          '/(.*)$/'            => '\1s'),
                           'pts' => array('/([ml])ice$/'           => '\1ouse',
                                          '/teeth$/'               => 'tooth',
                                          '/geese$/'               => 'goose',
                                          '/feet$/'                => 'foot',
                                          '/men$/'                 => 'man',
                                          '/((?![aeiou]).)ies$/'   => '\1y',
                                          '/([lr])ves$/'           => '\1f',
                                          '/((?!(sa|f|ti)).{2})ves$/' => '\1fe',
                                          '/i$/'                   => 'us',
                                          '/(sh|ch)es$/'           => '\1',
                                          '/(x|[aeiou]s)es$/'    => '\1is',
                                          '/(x|[Aeious]s)es$/'    => '\1',
                                          '/oes$/'                 => 'o',
                                          '/s$/'                   => ''
                                          ));

            
    /**
	 * Irregular nouns that aren't handled by any regular rule or special rule
	 * 
	 * @var array
	 */  
    private $irregular = array('common'   => array('child'     => 'children',
												   'person'    => 'people',
                                                   'quiz'      => 'quizzes'),
                               'uncommon' => array('beef'      => 'beefs',
                                                   'ephemeris' => 'ephemerides',
                                                   'ganglion'  => 'ganglions',
                                                   'genus'     => 'genera',
                                                   'mongoose'  => 'mongooses',
                                                   'mythos'    => 'mythoi',
                                                   'ox'        => 'oxen',
                                                   'soliloquy' => 'soliloquies',
                                                   'trilby'    => 'trilbys',
                                                   'graffito'  => 'graffiti'));

    /**
	 * Nouns that have the same singular and plural forms
	 * 
	 * @var array
	 */            
    private $uninflected = array('common'   => array('chassis',
                                                     'equipment',
                                                     'information',
                                                     'news',
                                                     'multimedia'),
                                 'uncommon' => array('bison',
                                                     'bream',
                                                     'breeches',
                                                     'britches',
                                                     'carp',
                                                     'clippers',
                                                     'cod',
                                                     'contretemps',
                                                     'corps',
                                                     'debris',
                                                     'diabetes',
                                                     'djinn',
                                                     'eland',
                                                     'elk',
                                                     'fish',
                                                     'flounder',
                                                     'gallows',
                                                     'headquarters',
                                                     'herpes',
                                                     'high-jinks',
                                                     'homework',
                                                     'innings',
                                                     'jackanapes',
                                                     'mackerel',
                                                     'measles',
                                                     'mews',
                                                     'mumps',
                                                     'pincers',
                                                     'pliers',
                                                     'proceedings',
                                                     'rabies',
                                                     'rice',
                                                     'salmon',
                                                     'scissors',
                                                     'sea-bass',
                                                     'series',
                                                     'shears',
                                                     'sheep',
                                                     'species',
                                                     'swine',
                                                     'trout',
                                                     'tuna',
                                                     'whiting',
                                                     'wildebeest'));

    /**
	 * A special rule handling a -> ae (singular -> plural)
	 * 
	 * @var array
	 */
    private $a_to_ae = array('common'   => array(),
                             'uncommon' => array('alg',
                                                 'alumn',
                                                 'vertebr'),
                             'singular' => 'a',
                             'plural'   => 'ae');    

    /**
	 * A special rule handling ex -> ices (singular -> plural)
	 * 
	 * @var array
	 */
    private $ex_to_ices = array('common'   => array(),
                                'uncommon' => array('cod',
                                                    'mur',
                                                    'sil'),
                                'singular' => 'ex',
                                'plural'   => 'ices');

    /**
	 * A special rule handling is -> ises (singular -> plural)
	 * 
	 * @var array
	 */
    private $is_to_ises = array('common'   => array(),
                                'uncommon' => array('ir',
                                                    'clitor'),
                                'singular' => 'is',
                                'plural'   => 'ises');

    /**
	 * A special rule handling o -> os (singular -> plural)
	 * 
	 * @var array
	 */
    private $o_to_os = array('common'   => array('phot',
                                                 'zer',
                                                 'log',
    											 'pian'),
                             'uncommon' => array('albin',
                                                 'alt',
                                                 'archipelag',
                                                 'armadill',
                                                 'bass',
                                                 'buffal',
                                                 'cant',
                                                 'carg',
                                                 'command',
                                                 'contralt',
                                                 'crescend',
                                                 'ditt',
                                                 'dynam',
                                                 'embry',
                                                 'fiasc',
                                                 'generalissim',
                                                 'ghett',
                                                 'guan',
                                                 'hal',
                                                 'infern',
                                                 'jumb',
                                                 'ling',
                                                 'lumbag',
                                                 'magnet',
                                                 'manifest',
                                                 'medic',
                                                 'mosquit',
                                                 'mott',
                                                 'n',
                                                 'octav',
                                                 'pr',
                                                 'quart',
                                                 'rhin',
                                                 'sol',
                                                 'sopran',
                                                 'styl',
                                                 'temp',
                                                 'tornad',
                                                 'volcan'),
                             'singular' => 'o',
                             'plural'   => 'os'); 
    
    /**
	 * A special rule handling on -> a (singular -> plural)
	 * 
	 * @var array
	 */
    private $on_to_a = array('common'   => array(),
                             'uncommon' => array('phenomen',
                                                 'criteri',
                                                 'automat',
                                                 'polyhedr',
                                                 'protozo',
                                                 'apheli'),
                             'singular' => 'on',
                             'plural'   => 'a');
    
    /**
	 * A special rule handling um -> a (singular -> plural)
	 * 
	 * @var array
	 */
    private $um_to_a = array('common'   => array(),
                             'uncommon' => array('agend',
                                                 'bacteri',
                                                 'candelabr',
                                                 'dat',
                                                 'desiderat',
                                                 'errat',
                                                 'extrem',
                                                 'ov',
                                                 'strat'),
                             'singular' => 'um',
                             'plural'   => 'a');

    /**
	 * A special rule handling us -> uses (singular -> plural)
	 * 
	 * @var array
	 */
    private $us_to_uses = array('common'   => array('b',
                                                    'stat'),
                                'uncommon' => array('apparat',
                                                    'cant',
                                                    'coit',
                                                    'corp',
                                                    'foc',
                                                    'fung',
                                                    'geni',
                                                    'hiat',
                                                    'impet',
                                                    'incub',
                                                    'nex',
                                                    'nimb',
                                                    'nucleol',
                                                    'octop',
                                                    'op',
                                                    'plex',
                                                    'prospect',
                                                    'radi',
                                                    'sin',
                                                    'styl',
                                                    'succub',
                                                    'tor',
                                                    'umbilic',
                                                    'uter'),
                                'singular' => 'us',
                                'plural'   => 'uses');

    /**
	 * A special rule handling (blank) -> i (singular -> plural)
	 * 
	 * @var array
	 */
    private $to_i = array('common'   => array(),
                          'uncommon' => array('afreet',
                                              'afrit',
                                              'efreet'),
                          'singular' => '',
                          'plural'   => 'i');

    /**
	 * A special rule handling (blank) -> im (singular -> plural)
	 * 
	 * @var array
	 */
    private $to_im = array('common'   => array(),
                           'uncommon' => array('goy',
                                               'seraph'),
                           'singular' => '',
                           'plural'   => 'im');
        
	/**
	 * Constructor;
	 * 
	 * @access public
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return void
	 */
	public function __construct() 
	{
		$this->error     = '';
	}
	
	
	/**
	 * Returns version number
	 * 
	 * @access public
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return string $version 
	 */
	public function getVersion() 
	{
        return $this->version;
	}
	
	
	/**
	 * Returns error message
	 * 
	 * @access public
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return mixed  False if no error, error string otherwise 
	 */
	public function getError() 
	{
        return (empty($this->error)) ? FALSE : $this->error;
	}
    
    
    /**
	 * Resets the error message
	 * 
	 * @access public
	 * @since 1.0.0
	 * 
	 * @param  void
	 * @return void 
	 */
	public function resetError() 
	{
        $this->error = '';
	}
    
    
    /**
	 * Adds a custom singular <-> plural rule
	 * 
	 * @since 1.3.0
	 * 
	 * @param  string $singular  The singular version of the noun
	 * @param  string $plural    The plural version of the nou
	 * @return void 
	 */
	public function addCustomRule($singular, $plural) 
	{
        $this->cache[$singular] = $plural;
	}
    
    
    /**
	 * Pluralizes a singular noun if number of items = 0, or > 1
	 * 
	 * @access public
	 * @since 1.2.0
	 * 
	 * @param  string $noun    The noun to pluralize
	 * @param  integer $count  If the count is 0 or > 1, the noun will be pluralized
	 * @return string  The proper form of the noun 
	 */
	public function pluralizeByCount($noun, $count) 
	{
        if ($count == 1) {
        	return $noun;	
		} else {
			return $this->pluralizeNoun($noun);	
		}
	}
    
    
    /**
     * Returns the plural form of a singular noun, uses anglicized form over classical form
     * 
     * @access public
     * @since  0.1.0
     * 
     * @param  string  $noun              The noun to pluralize
     * @param  boolean $include_uncommon  If set to true, will check for a bunch of irregular pluralization rules (mostly animal names, scientific terms, medical terms and music stuff)
     * @return string  The pluralized noun
     */
    public function pluralizeNoun($noun, $include_uncommon=FALSE)
    {    
	    // All processing should be done in lower case
	    $original_noun = $noun;
	    $noun = strtolower($noun);
	    
        // Check the cache
        if (isset($this->cache[$noun])) {
            return $this->fixCase($original_noun, $this->cache[$noun]);    
        }
        
        // Check for uninflected nouns
        if (in_array($noun, $this->uninflected['common']) || ($include_uncommon && in_array($noun, $this->uninflected['uncommon']))) {
            $this->cache[$noun] = $noun;
            return $this->fixCase($original_noun, $noun);    
        }
        
        // Check for irregular nouns
        if (isset($this->irregular['common'][$noun])) {
            $this->cache[$noun] = $this->irregular['common'][$noun];
            return $this->fixCase($original_noun, $this->irregular['common'][$noun]);    
        }          
        if ($include_uncommon && isset($this->irregular['uncommon'][$noun])) {
            $this->cache[$noun] = $this->irregular['uncommon'][$noun];
            return $this->fixCase($original_noun, $this->irregular['uncommon'][$noun]);    
        }
        
        // Check the special rules
        $special_rules = array('a_to_ae', 'ex_to_ices', 'is_to_ises', 'o_to_os', 'um_to_a', 'us_to_uses', 'to_i', 'to_im', 'on_to_a');
        foreach ($special_rules as $special_rule) {
            $temp = $this->checkSpecialRule($noun, $this->$special_rule, 'stp', $include_uncommon);
            if ($temp && $temp != $noun) {
                $this->cache[$noun] = $temp;
                return $this->fixCase($original_noun, $temp);   
            }
        }    
        
        // Check the general rules
        foreach ($this->rules['stp'] as $from_regex => $to_regex) {
            $temp = preg_replace($from_regex . 'i', $to_regex, $noun, 1);
            if ($temp != $noun) {
                $this->cache[$noun] = $temp;
                return $this->fixCase($original_noun, $temp);
            }                 
        }
        
        $this->cache[$noun] = $noun;
        return $this->fixCase($original_noun, $noun);
        
    }
    
    
    /**
     * Returns the singular form of a plural noun, uses anglicized form over classical form
     * 
     * @access public
     * @since  0.1.0
     * 
     * @param  string  $noun              The noun to singularize
     * @param  boolean $include_uncommon  If set to true, will check for a bunch of irregular pluralization rules (mostly animal names, scientific terms, medical terms and music stuff)
     * @return string  The singularized noun
     */
    public function singularizeNoun($noun, $include_uncommon=FALSE)
    {    
        // All processing should be done in lower case
	    $original_noun = $noun;
	    $noun = strtolower($noun);
        
        // Check the cache
        if (array_search($noun, $this->cache) !== FALSE) {
            return $this->fixCase($original_noun, array_search($noun, $this->cache));    
        }
        
        // Check for uninflected nouns
        if (in_array($noun, $this->uninflected['common']) || ($include_uncommon && in_array($noun, $this->uninflected['uncommon']))) {
            $this->cache[$noun] = $noun;
            return $this->fixCase($original_noun, $noun);    
        }
        
        // Check for irregular nouns
        $flipped['common'] = array_flip($this->irregular['common']);
        if (isset($flipped['common'][$noun])) {
            $this->cache[$flipped['common'][$noun]] = $noun;
            return $this->fixCase($original_noun, $flipped['common'][$noun]);    
        }          
        if ($include_uncommon) {
            $flipped['uncommon'] = array_flip($this->irregular['uncommon']);
            if (isset($flipped['uncommon'][$noun])) {
                $this->cache[$flipped['uncommon'][$noun]] = $noun;
                return $this->fixCase($original_noun, $flipped['uncommon'][$noun]); 
            }   
        }
        
        // Check the special rules
        $special_rules = array('a_to_ae', 'ex_to_ices', 'is_to_ises', 'o_to_os', 'um_to_a', 'us_to_uses', 'to_i', 'to_im', 'on_to_a');
        foreach ($special_rules as $special_rule) {
            $temp = $this->checkSpecialRule($noun, $this->$special_rule, 'pts', $include_uncommon);
            if ($temp && $temp != $noun) {
                $this->cache[$temp] = $noun;
                return $this->fixCase($original_noun, $temp);   
            }
        }    
        
        // Check the general rules, this is kind of messy because we need to singularize, then pluralize again to make sure it is the right form
        $total_rules = sizeof($this->rules['pts']);
        $stp_keys = array_keys($this->rules['stp']);
        $pts_keys = array_keys($this->rules['pts']);
        
        $pspell_exists = FALSE;
        if (function_exists('pspell_config_create')) {
	        $pspell_config = pspell_config_create("en");
			$pspell_link   = pspell_new_config($pspell_config);
			pspell_add_to_personal($pspell_link, 'blog');
			pspell_add_to_personal($pspell_link, 'slideshow');
            pspell_add_to_personal($pspell_link, 'timesheet'); 
			$pspell_exists = TRUE;
		}
        
        for ($i=0; $i < $total_rules; $i++) {
            // Try to singularize
            $from_regex = $pts_keys[$i];
            $to_regex   = $this->rules['pts'][$pts_keys[$i]];
            $temp = preg_replace($from_regex . 'i', $to_regex, $noun, 1);
            if ($temp != $noun && (!$pspell_exists || ($pspell_exists && pspell_check($pspell_link, $temp)))) {
                // Make sure when we pluralize the singular form we get the same noun we started with
                $from_regex2 = $stp_keys[$i];
                $to_regex2   = $this->rules['stp'][$stp_keys[$i]];
                $temp2 = preg_replace($from_regex2 . 'i', $to_regex2, $temp, 1);
                if ($temp2 == $noun) {
                    $this->cache[$temp] = $noun;
                    return $this->fixCase($original_noun, $temp);   
                }
            }                
        }
        
        $this->cache[$noun] = $noun;
        return $this->fixCase($original_noun, $noun);
        
    }
    
    
    /**
	 * Checks a special rule for irregular nouns
	 * 
	 * @access private
	 * @since 1.0.0
	 * 
	 * @param  string  $noun              The noun to check
     * @param  array   $rule_array        The special rule to check
     * @param  string  $type              'stp' for singular to plural, 'pts' for plural to singular
     * @param  boolean $include_uncommon  If set to true, will check the uncommon branch of the special rule
	 * @return mixed  FALSE if no match, (string) new form of noun if found
	 */
	private function checkSpecialRule($noun, $rule_array, $type, $include_uncommon=FALSE) 
	{
        // Determine the checking parameters
        if ($type == 'stp') {
            $from = $rule_array['singular'];
            $to   = $rule_array['plural'];    
        } elseif ($type == 'pts') {
            $from = $rule_array['plural'];
            $to   = $rule_array['singular'];    
        }
        
        // Check the common nouns
        foreach ($rule_array['common'] as $noun_root) {
            if ($noun_root . $from == $noun) {
                return $noun_root . $to;
            }    
        }
        
        // Check the uncommon nouns
        if ($include_uncommon) {
            foreach ($rule_array['uncommon'] as $noun_root) {
                if ($noun_root . $from == $noun) {
                    return $noun_root . $to;
                }    
            }    
        }
        
        return FALSE;
	}
	
	
	/**
	 * Fixes capitalization on inflected nouns - only works will all lowercase, all uppercase and ucwords capitalizations
	 * 
	 * @access private
	 * @since 1.1.0
	 * 
	 * @param  string $original_noun  The noun to check case on
     * @param  string $new_noun      The noun to fix case of
	 * @return string  The new noun with the case of the old noun
	 */
	private function fixCase($original_noun, $new_noun) 
	{
        if (strtolower($original_noun) == $original_noun) {
       		return $new_noun; 	
		}
		
		if (strtoupper($original_noun) == $original_noun) {
			return strtoupper($new_noun);	
		}
		
		if (ucwords($original_noun) == $original_noun) {
			return ucwords($new_noun);		
		}
		
		return $new_noun;
	}

}
?>
