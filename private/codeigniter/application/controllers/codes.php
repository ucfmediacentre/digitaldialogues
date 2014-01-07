<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codes extends CI_Controller {

	public function index()
	{
		$this->load->library('Shortcodes');
		$string="one [[two]] [[three]] [[four]] five"."<br><br>";
        $this->shortcodes->process_string($string);
		
		echo $string."<br><br>";
		
		echo "shortcodes = \n";
		//var_dump($shortcodes);
		echo '<pre>'.print_r($this->shortcodes, 1).'</pre>';
		echo "\n\n";
		
		$keys = array('internal', 'external', 'b', 'kjhjk');
		echo "keys = \n";
		var_dump($keys);
		echo "\n\n";
 
        $links = $this->shortcodes->return_shortcodes_by_key($keys);
		echo "links = \n";
		var_dump($links);
		echo "\n\n";
        //echo "internal_links[0]['shortcode'] =\n".$internal_links[0]['shortcode']->getValue()."\n\n";
 
        foreach($links as $link)
        {
            $this->shortcodes->replaceShortCodeWithHTML($link['index'], '<a href="' . $link['shortcode']->getValue() . '">' . $link['shortcode']->getValue() . '</a>');
			echo "link['shortcode']->getValue() =\n".$link['shortcode']->getValue()."\n\n";
        }
 
        echo $this->shortcodes->getAdaptedString();
	}
}

/* End of file codes.php */
/* Location: ./application/controllers/codes.php */

