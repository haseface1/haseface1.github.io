<?php class Session {

  public static function init() {
   session_start(); 
      
  }
  public static function destroy() {
   session_destroy();
  }
}
