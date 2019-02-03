<?php

namespace Convenia\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Convenia\Http\Controllers\Controller;
use Convenia\Services\Api\V1\ProviderService;


/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class ProviderController
 * @package Convenia\Http\Controllers\Api\V1
 */
class ProviderController extends Controller
{

    /**
     * Created by Weslley Ribeiro.
     * @var ProviderService
     */
    protected $_service;

    /**
     * Created by Weslley Ribeiro.
     * @var Request
     */
    protected $_request;

    /**
     * ProviderController constructor.
     * @param ProviderService $service
     * @param Request $request
     */
    function __construct(ProviderService $service, Request $request)
    {
        $this->_request = $request;
        $this->_service = $service;
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 20:20
     * @return mixed
     */
    public function index(){
        try{
            $data = $this->_service->index();
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 20:20
     * @return mixed
     */
    public function store(){
        try{
            $data = $this->_service->store($this->_request->all());
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 20:20
     * @param $id
     * @return mixed
     */
    public function show($id){
        try{
            $data = $this->_service->show($id);
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 20:20
     * @param $id
     * @return mixed
     */
    public function update($id){
        try{
            $data = $this->_service->update($id, $this->_request->all());
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 20:20
     * @param $id
     * @return mixed
     */
    public function destroy($id){
        try{
            $data = $this->_service->destroy($id);
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }
}
