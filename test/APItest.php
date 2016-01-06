<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;


class iKnowAPITest extends PHPUnit_Framework_TestCase
{
    //public $client;   
    protected $client; 
    //set up api URL
    protected $APIServerlink = array(
        "SMS" => "http://gene.rnet.missouri.edu/iKnow/Testing/SMS.php",
        "signup" => "http://gene.rnet.missouri.edu/iKnow/Testing/signup.php",
        "resetpassword" => "http://gene.rnet.missouri.edu/iKnow/Testing/resetpassword.php",
        "login" => "http://gene.rnet.missouri.edu/iKnow/Testing/login2.php",
        "makeorder" => "http://gene.rnet.missouri.edu/iKnow/Testing/makeorder.php",
        "orderdetail" => "http://gene.rnet.missouri.edu/iKnow/Testing/orderdetail.php",
        "makecomment" => "http://gene.rnet.missouri.edu/iKnow/Testing/comment.php",
        "list" => "http://gene.rnet.missouri.edu/iKnow/Testing/list2.php",
        'massagistdetail' => "http://gene.rnet.missouri.edu/iKnow/Testing/massagistdetail.php",
        "morecomment" => "http://gene.rnet.missouri.edu/iKnow/Testing/morecomment.php"
    );

    protected $APIlocallink = array(
        "list" => "http://localhost:8888/iKnow/ikonwlocaldev/list.php",
        'massagistdetail' => "http://localhost:8888/iKnow/ikonwlocaldev/massagistdetail.php",
        "morecomment" => "http://localhost:8888/iKnow/ikonwlocaldev/morecomment.php"

        );

    protected $APIlink;

    protected function setup(){
        //echo "\nCreate Client...\n";
         $this->client = new Client();
         $this->APIlink = $this->APIServerlink;
    }

    
    public function testSignup(){
        echo "\ntest Signup function...\n";
        echo "call SMS api sending massage to phone 13068776038...\n";
        $response = $this->client->request(
            'POST',
            $this->APIlink['SMS'],
            [
                'form_params' => [
                    'phone'=>'13068776038',
                    'client'=>'customer'
                    ]
            ]
        );

        echo "Status: ".$response->getStatusCode()."\n";

        $results =json_decode($response->getBody(true));
        //var_dump($results);
        $this->assertObjectHasAttribute("RespCode",$results);
        $this->assertObjectHasAttribute("RespContent",$results);
    }

}