<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 21:44
 */

class ProviderService
{
    protected $_userModel;

    public function __construct(User $userModel)
    {
        $this->_userModel = $userModel;
    }

    public function index()
    {
        try {
            $data = $this->_userModel->all();
            return returnJson(null, 200, 'api.index.success', $data);
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.index.error');
        }
    }

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