<?php
/**
 * searchExcerpt plugin for Craft CMS
 *
 * searchExcerpt Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    Jörg Gudehus
 * @copyright Copyright (c) 2017 Jörg Gudehus
 * @link      http://joerggudehus.de
 * @package   SearchExcerpt
 * @since     1
 */

namespace Craft;

class SearchExcerptVariable
{
    /**
     * Whatever you want to output to a Twig template can go into a Variable method. You can have as many variable
     * functions as you want.  From any Twig template, call it like this:
     *
     *     {{ craft.searchExcerpt.exampleVariable }}
     *
     * Or, if your variable requires input from Twig:
     *
     *     {{ craft.searchExcerpt.exampleVariable(twigValue) }}
     */
    public function from($text, $term, $padding=20, $class='highlight')
    {        
    	$start = max(0, strpos($text, $term) - $padding);
    	$end = min(strlen($text), $start + strlen($term) + $padding);
    	
    	$excerpt = substr($text, $start, $padding * 2 + strlen($term));

    	if ($start != 0)
    		$excerpt = '… ' . preg_replace('/^\S*\s/', '', $excerpt);
    	
    	if ($end != strlen($text))
    		$excerpt = preg_replace('/\s\S*$/', '', $excerpt) . ' …';
    	
    	
    	$excerpt = str_replace($term, "<span class='" . $class . "'>" . $term . "</span>", $excerpt);

		return new \Twig_Markup($excerpt, craft()->templates->getTwig()->getCharset());
    }
    
}