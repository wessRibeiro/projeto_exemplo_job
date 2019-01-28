<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 21:36
 */

namespace Convenia\Services\Api\V1;

use Convenia\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class UserService
 */
class UserService
{
    /**
     * Created by Weslley Ribeiro.
     * @var User
     */
    protected $_userModel;

    /**
     * UserService constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->_userModel = $userModel;
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 21:42
     * @return mixed
     */
    public function index()
    {
        try {
            $data = $this->_userModel->all();
            return returnJson(null, 200, 'api.index.success', $data);
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.index.error');
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 21:42
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        try {
            if ($entity = $this->_userModel->create($data)) {
                return returnJson(null, 201, 'api.store.success');
            }

            return returnJson(null, 400, 'api.store.error');
        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 21:42
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $entity = $this->_userModel->withTrashed()->findOrFail($id);
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
     * Date 27/01/2019 21:42
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        try {
            if ($entity = $this->_userModel->where('id', $id)->update($data)) {
                return returnJson(null, 200, 'api.update.success');
            }

            return returnJson(null, 400, 'api.update.error');
        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 27/01/2019 21:42
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            if ($this->_userModel->destroy($id)) {
                return returnJson(null, 200, 'api.destroy.success');
            } else {
                return returnJson(null, 400, 'api.destroy.error');
            }
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.destroy.error');
        }
    }
    
}