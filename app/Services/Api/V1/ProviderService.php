<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 21:44
 */

namespace Convenia\Services\Api\V1;

use Convenia\Models\V1\Provider;
use JWTAuth;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class ProviderService
 * @package Convenia\Services\Api\V1
 */
class ProviderService
{
    /**
     * Created by Weslley Ribeiro.
     * @var Provider
     */
    protected $_providerModel;

    /**
     * ProviderService constructor.
     * @param Provider $providerModel
     */
    public function __construct(Provider $providerModel)
    {
        $this->_providerModel = $providerModel;
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:50
     * @return mixed
     */
    public function index()
    {
        $data = [];
        $data['monthlies_total'] = 0;
        foreach($this->_providerModel->all() as $provider){
            $data[$provider->id]= $provider->toArray();
            $data[$provider->id]['monthlies'] = $provider->monthlies()->get();
            foreach ($data[$provider->id]['monthlies'] as $monthly)
            $data['monthlies_total'] += $monthly->monthly;
        }

        return returnJson(null, 200, 'api.index.success', $data);
        try {
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.index.error');
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:50
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        try {
            //get user logged
            $user = JWTAuth::user();
            $data['users_id'] = $user['id'];

            $rules = [
                'name'      => 'required|max:255',
                'email'     => 'required|max:100|email',
                'monthly'   => 'required|numeric',
            ];

            $validate_return = self::validateRequest($data, $rules);
            if ($validate_return === true) {

                if ($entity = $this->_providerModel->create($data)) {
                    return returnJson(null, 201, 'api.store.success');
                }

            } else {
                throw new \Exception($validate_return['errors']);
            }

            return returnJson(null, 400, 'api.show.error');

        } catch (JWTException $ex){
            return returnJson($ex, 401);

        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:50
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $entity = $this->_providerModel->withTrashed()->findOrFail($id);
            if (null === $entity) {
                return returnJson(null, 400, 'api.show.error');
            }
            return returnJson(null, 200, 'api.show.success', $entity);
        } catch (ModelNotFoundException $ex) {
            return returnJson(null, 400, 'api.show.error');
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.show.error');
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:50
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        try {
            $rules = [
                'name'      => 'required|max:255',
                'email'     => 'required|max:100|email',
                'monthly'   => 'required|numeric',
            ];

            $validate_return = self::validateRequest($data, $rules);
            if ($validate_return === true) {
                if ($entity = $this->_providerModel->where('id', $id)->update($data)) {
                    return returnJson(null, 200, 'api.update.success');
                }

            } else {
                throw new \Exception($validate_return['errors']);
            }

            return returnJson(null, 400, 'api.update.error');
        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 23:50
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            if ($this->_providerModel->destroy($id)) {
                return returnJson(null, 200, 'api.destroy.success');
            } else {
                return returnJson(null, 400, 'api.destroy.error');
            }
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.destroy.error');
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