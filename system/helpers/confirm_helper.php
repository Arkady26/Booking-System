<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * confirm dialog helper
    * 
    * autoload helpers confirm, url 
    * example;
    * $attr = array( 'class' => 'delete' ) // just like Ci anchor();
    * $id = unique id to anchor
    * call this "confirm( 'item/delete' , 'Title' , $id ,$attr , array( ' dialog' => 'Confirm box text' ,' btrue' => 'true button text', bfalse => 'false button text'  ) );"
    * 
    * requiments:
    *     jQuery www.jquery.com
    *    plugin Impromptu   http://trentrichardson.com/Impromptu/
    *
    * @ access public
    * @ param string            //  url if confirm is true
    * @ param intger            // id
    * @ param string            // text to confirm box title
    * @ param arr[optional]         //  defaults array( ' dialog' => 'Confirm delete?' ,' btrue' => 'Ok', bfalse => Cancel'  )
    * @ return string            // return anchor
    **/
    function confirm( $uri , $title, $id , $attr , $attr2 = array() )
    {
        $dialog     = array_key_exists( 'dialog' ,$attr2 ) ?  $attr2['dialog'] : 'Confirm delete?';
        $but_true     = array_key_exists( 'btrue' ,$attr2 ) ?  $attr2['btrue'] : 'Ok';
        $but_false     = array_key_exists( 'bfalse', $attr2 ) ?  $attr2['bfalse'] : 'Cancel';
        $attr['id'] = $id;
        $attr['onclick'] = "$.prompt( '".$dialog."' ,{ callback: vhconfirm , buttons: { ".$but_true.": '".$attr['id']."' , ".$but_false.": false } }); return false;";
		
        return anchor( $uri , $title , $attr );
    }