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
    protected $APIlink = array(
        "list" => "http://gene.rnet.missouri.edu/iKnow/list.php",
        'massagistdetail' => "http://gene.rnet.missouri.edu/iKnow/massagistdetail.php",
        "morecomment" => "http://gene.rnet.missouri.edu/iKnow/morecomment.php"
    );

    /*protected $APIlink = array(
        "list" => "http://localhost:8888/iKnow/ikonwlocaldev/list.php",
        'massagistdetail' => "http://localhost:8888/iKnow/ikonwlocaldev/massagistdetail.php",
        "morecomment" => "http://localhost:8888/iKnow/ikonwlocaldev/morecomment.php"

        );*/

    protected function setup(){
        //echo "\nCreate Client...\n";
        echo "API Address:\n";
        echo $this->APIlink['list'];
        //var_dump($APIlink);
         $this->client = new Client();
    }

/*-------------------------- Testing : 获取列表信息；
    1 推荐服务列表
    2 推荐技师列表
    3 技师列表
    4 用户订单列表
    5 新闻列表
    6 服务列表 - 全部服务；-单个目录下的全部服务
    7 推荐新闻列表（首页）
    8 单个技师下的全部服务
*/
    
    public function testRecommand_service_API()
    {
        echo "\ntest Recommand_service_API .... \n";

        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_recommand_service']]);
        echo "Status: ".$response->getStatusCode()."\n";

        $results =json_decode($response->getBody(true));

        foreach ($results as $result) {
            # code...
            $this->assertObjectHasAttribute('serviceid', $result);
            $this->assertObjectHasAttribute('shopname', $result);
            $this->assertObjectHasAttribute('servicename', $result);
            $this->assertObjectHasAttribute('price', $result);
            $this->assertObjectHasAttribute('pic', $result);
            $this->assertObjectHasAttribute('latitude',$result);
            $this->assertObjectHasAttribute('longtitude',$result);
        }

        echo "Response attributes check PASS.\n\n";

        
    }
}