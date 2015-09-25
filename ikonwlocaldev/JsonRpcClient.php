<?php

/**
 * JSON-RPC CLient class 
 */
class JsonRpcClient {

    protected $_requestId = 1;
    protected $_contextOptions;
    protected $_url;
    
    /**
     * Constructor. Takes the connection parameters
     * 
     * @param String $url
     */
    public function __construct($url, $options = array()) {
        $headers = array('Content-type: application/json');
        if (isset($options['headers'])) {
            $headers = array_merge($headers, $options['headers']);
        }
        $this->_contextOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => implode("\r\n", $headers) . "\r\n"
            )
        );
        
        $this->_url = $url;
    }
    
    /**
     * Performs a jsonRCP request and return result
     *
     * @param String $method
     * @param Array $params
     * @return mixed
     */
    public function __call($method, $params) {
        $currentId = $this->_requestId++;
        $request = array(
            'method' => $method,
            'params' => array_values($params),
            'id'     => $currentId
        );
        $request = json_encode($request);
        
        $this->_contextOptions['http']['content'] = $request;
        
        $response = file_get_contents($this->_url, false, stream_context_create($this->_contextOptions));
        $result = json_decode($response, false);
        
        if ($result->id != $currentId) {
            throw new Exception("Incorrect response id (request id: {$currentId}, response id: {$result->id})" . "\n\nResponse: " . $response);
        }
        if (isset($result->error) && $result->error) {
            throw new Exception("Request error: {$result->error->message}");
        }
        
        return $result->result;
    }
}