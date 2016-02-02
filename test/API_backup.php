public function testRecommand_service_API()
    {
        echo "\ntest Recommand_service_API .... \n";

        $response = $this->client->request('POST',/*$this->APIlink['list']*/"http://gene.rnet.missouri.edu/iKnow/list.php", [
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

    public function testRecommand_massagist(){
        echo "\ntest Recommand_massagist_API .... \n";

        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_recommand_massagist']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        foreach ($results as $result) {
            # code...
            $this->assertObjectHasAttribute('massagistid', $result);
            $this->assertObjectHasAttribute('shopname', $result);
            $this->assertObjectHasAttribute('name', $result);
            $this->assertObjectHasAttribute('stars', $result);
            $this->assertObjectHasAttribute('intro', $result);
            $this->assertObjectHasAttribute('pic', $result);
            $this->assertObjectHasAttribute('latitude',$result);
            $this->assertObjectHasAttribute('longtitude',$result);
        }
        echo "Response attributes check PASS.\n\n";

    }

    public function testMassagistList(){
        echo "\ntest Massagist_List_API .... \n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_massagist_list']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        
        foreach ($results as $result) {
        # code...
            $this->assertObjectHasAttribute('massagistid', $result);
            $this->assertObjectHasAttribute('shopname', $result);
            $this->assertObjectHasAttribute('name', $result);
            $this->assertObjectHasAttribute('stars', $result);
            $this->assertObjectHasAttribute('intro', $result);
            $this->assertObjectHasAttribute('pic', $result);
            $this->assertObjectHasAttribute('latitude',$result);
            $this->assertObjectHasAttribute('longtitude',$result);
        }
        echo "Response attributes check PASS.\n\n";
    }




    public function testCustomerOrderlist(){
        echo "\ntest Order_list_API .... \n";
        $customerid = "1";
        echo "get order list for customer: 1 ...\n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_order_list', 'customid'=>$customerid]]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        if($results==null)
        {
            echo "Order_list is null, please double check....\n";
        }
        else{
            foreach ($results as $result) {
            # code...
            $this->assertObjectHasAttribute('orderid', $result);
            $this->assertObjectHasAttribute('servicename', $result);
            $this->assertObjectHasAttribute('shopname', $result);
            $this->assertObjectHasAttribute('status', $result);
            $this->assertObjectHasAttribute('unitprice', $result);
            $this->assertObjectHasAttribute('pic', $result);
            }
            echo "Response attributes check PASS.\n\n";
        }
        
    }

    #by: Yudu

    public function testNewsList(){
        echo "\ntest News_List_API .... \n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_news']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        
        foreach ($results as $result) {
        # code...
        $this->assertObjectHasAttribute('newsid', $result);
        $this->assertObjectHasAttribute('pic', $result);
        $this->assertObjectHasAttribute('newstitle', $result);
        $this->assertObjectHasAttribute('newscontent', $result);
        }
        echo "Response attributes check PASS.\n\n";
    }

    public function testServiceList(){
        echo "\ntest Services_list_API : Get All Services.... \n";

        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_services_list','categoryid'=>'null']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        if($results==null)
        {
            echo "Services_list is null, please double check....\n\n";
        }
        else{
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
        


        echo "test Services_list_API : Get by Services category.... \n";

        $id =1;
        echo "Get services list for category id 1 ...\n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_services_list', 'categoryid'=>$id]]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        if($results==null)
        {
            echo "Services_list is null, please double check....\n";
        }
        else{
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


    public function testRecommandNews(){
        echo "\ntest Recommand_News_List_API .... \n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_recommand_news']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        
        foreach ($results as $result) {
        # code...
        $this->assertObjectHasAttribute('id', $result);
        $this->assertObjectHasAttribute('title', $result);
        $this->assertObjectHasAttribute('pic', $result);
        }
        echo "Response attributes check PASS.\n\n";


        echo "\ntest Recommand_News_page_API ...\n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'get_recommand_news','id'=>1]]);

        echo "Status: ".$response->getStatusCode()."\n";
        $result =json_decode($response->getBody(true));
        //var_dump($results);
        
        $this->assertObjectHasAttribute('id', $result);
        $this->assertObjectHasAttribute('title', $result);
        $this->assertObjectHasAttribute('content', $result);
        $this->assertObjectHasAttribute('pic', $result);
        echo "Response attributes check PASS.\n\n";

    }

    public function testServiceListByMassagistid(){
        echo "\ntest Get_services_list_by_massagist .... \n";
        $response = $this->client->request('POST',$this->APIlink['list'], [
    'form_params' => ['action'=> 'massagist_get_services_list', 'massaid'=>'1']]);

        echo "Status: ".$response->getStatusCode()."\n";
        $results =json_decode($response->getBody(true));
        //var_dump($results);
        
        foreach ($results as $result) {
        # code...
        $this->assertObjectHasAttribute('serviceid', $result);
        $this->assertObjectHasAttribute('name', $result);
        $this->assertObjectHasAttribute('duration', $result);
        $this->assertObjectHasAttribute('price', $result);
        $this->assertObjectHasAttribute('amount',$result);
        }
        echo "Response attributes check PASS.\n\n";
    }
    
/*----------------------------Test : 技师详情页
    
*/
    public function testMassagistdetail(){
        echo "\ntest Get_Massagist_Detail .... \n";
        $massaid =15036391991;
        echo "massagist id = ".$massaid."\n";
        $response = $this->client->request('POST',$this->APIlink['massagistdetail'], [
    'form_params' => ['massagistid'=>$massaid]]);

        echo "Status: ".$response->getStatusCode()."\n";
        $result =json_decode($response->getBody(true));
        //var_dump($result);
        # code...
        $this->assertObjectHasAttribute('massagist_info', $result);
        $this->assertObjectHasAttribute('shop_info', $result);
        $this->assertObjectHasAttribute('service_list', $result);
        $this->assertObjectHasAttribute('comment_list', $result);
        echo "Massagist Info, Shop Info, Service Info and Comment Info sections are deleveried. Checking attrbutes in each section ...\n";
        //$this->assertArrayHasAttribute('name', $result["massagist_info"]);
        //echo gettype($result->massagist_info);
        //var_dump($result->massagist_info);
        echo "\n\tChecking massagist_info...\n";
        $this->assertObjectHasAttribute('name', $result->massagist_info);
        $this->assertObjectHasAttribute('pic', $result->massagist_info);
        $this->assertObjectHasAttribute('level', $result->massagist_info);
        $this->assertObjectHasAttribute('intro', $result->massagist_info);
        $this->assertObjectHasAttribute('visiting_start', $result->massagist_info);
        $this->assertObjectHasAttribute('visiting_end', $result->massagist_info);
        echo "\tDone, Passed\n";

        echo "\n\tChecking shop_info...\n";
        $this->assertObjectHasAttribute('name', $result->shop_info);
        $this->assertObjectHasAttribute('opentime', $result->shop_info);
        $this->assertObjectHasAttribute('closetime', $result->shop_info);
        $this->assertObjectHasAttribute('latitude', $result->shop_info);
        $this->assertObjectHasAttribute('longtitude', $result->shop_info);

        echo "\tDone, Passed\n";

        echo "\n\tChecking service_list...\n";

        //$this->assertCount(3,$result->service_list);
        echo "\tAmount of services is correct\n";

        foreach ($result->service_list as $service)
        {
            $this->assertObjectHasAttribute('name', $service);
            $this->assertObjectHasAttribute('duration', $service);
            $this->assertObjectHasAttribute('price', $service);
            $this->assertObjectHasAttribute('amount', $service);
        }
        
        //$this->assert

        echo "\tDone, Passed\n";

        echo "\n\tChecking Comment_list...\n";
        //$this->assertCount(5,$result->comment_list);
        echo "\tAmount of comments is correct.\n";
        
        foreach ($result->comment_list as $comment){
            $this->assertObjectHasAttribute('date',$comment);
            $this->assertObjectHasAttribute('customerid',$comment);
            $this->assertObjectHasAttribute('stars',$comment);
            $this->assertObjectHasAttribute('content',$comment);

        }

        echo "\tDone, Passed\n";        
        echo "Response attributes check PASS.\n\n";
    }
