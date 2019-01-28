<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 28/01/2019 00:28
 */

namespace Convenia\Services\Api\V1;

use Convenia\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class AuthService
 * @package Convenia\Services\Api\V1
 */
class AuthService
{
    /**
     * Created by Weslley Ribeiro.
     * @var User
     */
    protected $_userModel;

    /**
     * AuthService constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->_userModel = $userModel;
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 28/01/2019 02:08
     * @param $credentials
     * @return mixed
     */
    public function register($credentials){
        try {
            $rules = [
                'password'  => 'required|max:255',
                'email'     => 'required|email|max:255|unique:users'
            ];

            $validate_return = self::validateRequest($credentials, $rules);
            if ($validate_return === true) {
                $credentials['password'] = Hash::make($credentials['password']);
                if($entity = $this->_userModel->create($credentials)){
                    return returnJson(null, 201, 'api.store.success');
                }
            }else{
                throw new \Exception($validate_return['errors']);
            }

            return returnJson(null, 400, 'api.store.error');

        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }


    /**
     *
     * API Login, on success return JWT Auth token
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 28/01/2019 02:40
     * @param $credentials
     * @return mixed
     */
    public function login($credentials)
    {
        try {
            $rules = [
                'password'  => 'required|max:255',
                'email'     => 'required|email|max:255'
            ];

            $validate_return = self::validateRequest($credentials, $rules);
            if ($validate_return === true) {
                // attempt to verify the credentials and create a token for the user
                if ($token = JWTAuth::attempt($credentials)) {
                    return returnJson(null, 200, 'api.show.success',['token' => $token ]);
                }

            } else {
                throw new \Exception($validate_return['errors']);
            }

            return returnJson(null, 400, 'api.show.error');

        } catch (JWTException $ex){
            return returnJson($ex, 401);

        }catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 28/01/2019 02:08
     * @param $data
     * @return array|bool
     */
    private function validateRequest($data, $rules){

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $menssage = '';
            foreach($validator->errors()->all() as $m){
                $menssage .= $m."<br>";
            }
            return ['success' => false, 'errors'=> $menssage];
        }

        return true;
    }
}