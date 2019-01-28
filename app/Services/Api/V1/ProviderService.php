<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 21:44
 */

namespace Convenia\Services\Api\V1;

use Convenia\Models\V1\Provider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try {
            $data = $this->_providerModel->all();
            return returnJson(null, 200, 'api.index.success', $data);
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
            if ($entity = $this->_providerModel->create($data)) {
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
            if ($entity = $this->_providerModel->where('id', $id)->update($data)) {
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
}