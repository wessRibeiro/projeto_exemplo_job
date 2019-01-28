<?php

namespace Convenia\Http\Controllers\Api\V1;

use Convenia\Services\Api\V1\AuthService;
use Illuminate\Http\Request;
use Convenia\Http\Controllers\Controller;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class AuthController
 * @package Convenia\Http\Controllers\Api\V1
 */
class AuthController extends Controller
{

    /**
     * Created by Weslley Ribeiro.
     * @var AuthService
     */
    private $_service;
    /**
     * @var Request
     */
    private $_request;

    /**
     * Created by Weslley Ribeiro.
     * @var array
     */
    private $_only_request = ['email', 'password'];


    /**
     * AuthController constructor.
     * @param AuthService $service
     * @param Request $request
     */
    function __construct(AuthService $service, Request $request)
    {
        $this->_request = $request;
        $this->_service = $service;
    }


    /**
     * API Register
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:29
     * @return mixed
     */
    public function register(){
        try{
            $data = $this->_service->register($this->_request->all());
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    /**
     * API Login, on success return JWT Auth token
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 28/01/2019 02:33
     * @return mixed
     */
    public function login(){
        try{
            $data = $this->_service->login($this->_request->only($this->_only_request));
            return $data;
        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

}
