<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**=========================================================================
 * 
 * PHP-uglify		0.1.0
 * -----------------------------------------------------------------------------
 * # Description:   A codeigniter library to minify Javascript and CSS files and
 *                  also concat them into one file. This class is just a wrapper
 *                  around Matthias mullie's minify class, with some minor
 *                  optimizations to make it work on CodeIgniter.
 * 
 * -----------------------------------------------------------------------------
 * # Usage			$this->load->library(ugly/ugly);
 *					
 *					// minifying single string of code
 *                  // or single file
 *                  $result = $this->ugly->css("code goes here");
 *                  $result = $this->ugly->js("code goes here")
 *                  $result = $this->ugly->js("path/to/file")
 *                  
 *                  // minifying multiple strings or files
 *                  $this->ugly->group_start("js");
 *                  // or $this->ugly->group_start("js");
 *                  $this->ugly->group_add("path/to/file");
 *                  $this->ugly->group_add("some code as string");
 *                  $result = $this->ugly->group_end();
 *                  
 * -----------------------------------------------------------------------------
 * # Author:		Alex Corvi	<alex@arrayy.com>
 *					As a part of a CRM project written in PHP/Codeigniter.
 * -----------------------------------------------------------------------------
 * # Licence:		The MIT License (MIT)
 *					Copyright (c) <2016> <Alex Corvi>
 *					------------------------------------------------------------
 *					Permission is hereby granted, free of charge, to any person
 *					obtaining a copy of this software and associated
 *					documentation files (the "Software"), to deal in the
 *					Software without restriction, including without limitation
 *					the rights to use, copy, modify, merge, publish, distribute,
 *					sublicense, and/or sell copies of the Software, and to
 *					permit persons to whom the Software is furnished to do so,
 *					subject to the following conditions:
 * 
 *						1.	The above copyright notice and this permission
 *							notice shall be included in all copies or
 *							substantial portions of the Software.
 *						2.	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
 *							OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
 *							LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *							FITNESS FOR A PARTICULAR PURPOSE AND
 *							NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *							COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES
 *							OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 *							CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF
 *							OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 *							OTHER DEALINGS IN THE SOFTWARE.
 * 
 * -----------------------------------------------------------------------------
 * 
**/


use MatthiasMullie\Minify;
class Ugly {
    
    protected $strings;
    protected $type;
    
	public function __construct(){
	    
        require_once APPPATH.'libraries/ugly/inc/minify/src/Minify.php';
        require_once APPPATH.'libraries/ugly/inc/minify/src/CSS.php';
        require_once APPPATH.'libraries/ugly/inc/minify/src/JS.php';
        require_once APPPATH.'libraries/ugly/inc/minify/src/Exception.php';
        require_once APPPATH.'libraries/ugly/inc/path-converter/Converter.php';
        
        $this->strings = array();
        $this->type = "";
	}
	
	
	
	
	/**=========================================================================
	 * 
	 * UGLY -> CSS
	 * -------------------------------------------------------------------------
	 * # Description:   For css code minification.
	 * -------------------------------------------------------------------------
	 * # params:        $code	<string>	filename/string of code
	 * -------------------------------------------------------------------------
	 * # return:		minified code 
	 * -------------------------------------------------------------------------
	 * 
	**/

	public function css($code) {
		$minifier = new Minify\CSS($code);
		return $minifier->minify();
	}
	
	
	
	
	
	/**=========================================================================
	 * 
	 * UGLY -> JS
	 * -------------------------------------------------------------------------
	 * # Description:   for JS code minification.
	 * -------------------------------------------------------------------------
	 * # params:        $code	<string>	filename/string of code
	 * -------------------------------------------------------------------------
	 * # return:		minified code 
	 * -------------------------------------------------------------------------
	 * 
	**/
	
	public function js($code){
		$minifier = new Minify\JS($code);
		return $minifier->minify();
	}






    /**=========================================================================
     * 
     * UGLY ->  GROUP START
     * -------------------------------------------------------------------------
     * # Description:   Initialize a group minification.
     * -------------------------------------------------------------------------
     * # params:        $res    <NULL>      Not passing any resources initially
     *                  --------------------------------------------------------
     *                          <string>    Passing one file/string initially
     *                  --------------------------------------------------------
     *                          <array>     Passing a group of files/strings
     *                                      initially
     * -------------------------------------------------------------------------
	 * # return:		VOID 
     * -------------------------------------------------------------------------
    **/
    
    public function group_start($type="js",$res=NULL) {
        
        $this->type = $type;
        
        if(is_array($res)) foreach ($res_arr as $value) {array_push($this->strings,$value);}
        if(is_string($res)) array_push($this->strings,$res);
        
    }
    
    
    
    
    
    
    
    
    /**=========================================================================
     * 
     * UGLY ->  GROUP ADD
     * -------------------------------------------------------------------------
     * # Description:   Adds new resource(s).
     * -------------------------------------------------------------------------
     * # params:        $res    <NULL>      Not passing any resources 
     *                  --------------------------------------------------------
     *                          <string>    Passing one file/string
     *                  --------------------------------------------------------
     *                          <array>     Passing a group of files/strings
     * -------------------------------------------------------------------------                 
	 * # return:		VOID
     * -------------------------------------------------------------------------
    **/
    
    
    public function group_add($res=NULL) {
        
        if(is_array($res)) foreach ($res as $value) {array_push($this->strings,$value);}
        if(is_string($res)) array_push($this->strings,$res);
        
    }
    
    
    
    
    /**=========================================================================
     * 
     * UGLY ->  GROUP ADD
     * -------------------------------------------------------------------------
     * # Description:   Adds new resource(s).
     * -------------------------------------------------------------------------
     * # params:        VOID
     * -------------------------------------------------------------------------
	 * # return:		minified code
     * -------------------------------------------------------------------------
    **/
    
    public function group_end() {
        
        if($this->type === "css") $minifier = new Minify\CSS("");
        if($this->type === "js") $minifier = new Minify\JS("");
        
        foreach ($this->strings as $value) {
            $minifier->add($value);
        }
        
        // empty the array
        $this->strings = array();
        
        return $minifier->minify();
        
    }

}