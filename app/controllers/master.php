<?php 

class Master extends Controller
{


    public function __construct(){
        return $this->index();
    }

    public function index(){

        $this->setRequest();

        if($this->getRequest() !== false){


            $data = $this->getRequest();
            $res = $this->verifyData();
            if($res !== true){
                $resp = new stdClass();
                $resp->code = '6016';
                $resp->message = 'missconfiguration';
                echo json_encode($resp);                 
            }
        }

    }

    private function verifyData()
    {
        $data = new stdClass();
        $data->api = 'verify';
        $data->action = 'Register';
        $data->params = $this->getRequest()->params;

        $res = json_decode(ApiModel::doAPI($data));

        foreach($res as $key=>$value)
        {
            if(empty($value)){
                return false;
            }
        }

        return true;
        
    }

}