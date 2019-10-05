<?php
/**
 * Some of the following configuration options
 *
 */

 function get_current_chain() {
   $request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI' );

   $url = explode( '?', $request_uri, 2 );
   var_dump($request_uri);
   if ( strlen( $url[0] ) > 1 ) {
     $out = rtrim( $url[0], '/' );
   } else {
     $out = $url[0];
   }

   return $out;
 }


return [

  /*
   * The projecr path
   */
  "base_path" => "",

  /*
   * The directory which the generated critical-path CSS is stored.
   */
  "storage" => "",

  /*
   * The default chain to pharse.
   *
   */
  "chain" => get_current_chain();

  /*
   * The default callback file
   *
   */
  "call_back_file" => "index.css",

  /*
   * The extension files
   */
  "extension" => [
    ".php",
    ".html",
    ".jsp",
  ],

]
