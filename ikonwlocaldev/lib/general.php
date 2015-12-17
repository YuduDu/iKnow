<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 12/16/15
 * Time: 2:59 PM
 */

function check_attribute($attributes,$location){
    switch($location){
        case "post":{
            foreach($attributes as $attribute){
                if(isset($_POST[$attribute])&&$_POST[$attribute]!=null){
                    continue;
                }
                else return false;
            }
            return true;
            break;
        }
        case "session":{
            foreach($attributes as $attribute){
                if(isset($_SESSION[$attribute])&&$_SESSION[$attribute]!=null){
                    continue;
                }
                else return false;
            }
            return true;
            break;
        }
        default: return false;
        break;


    }

}

