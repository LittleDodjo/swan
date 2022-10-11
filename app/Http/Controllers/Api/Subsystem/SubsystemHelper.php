<?php
/*
 * Copyright (c) 2022. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Http\Controllers\Api\Subsystem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait SubsystemHelper
{


    /**
     * @var string
     */
    protected $postKey = 'doc_id';
    /**
     * @var string
     */
    protected $postDataKey = 'data';

    /**
     * @param string $model
     * @param string $action
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function subsystemAccess(string $model, string $action){
        $user = Auth::user();
        if($user == null){
            return  response()->json([
                'message' => "Ошибка авторизации",
            ], 401);
        }
        if($user->can($action, $model)) return true;
        else{
            return response()->json(['message' => 'Действие недоступно'], 403);
        }
    }

    /**
     * @param string $model
     * @param $id
     * @return mixed
     */
    public function subjectExists(string $model, $id){
        return  $model::where('id', $id)->exists();
    }

    /**
     * @param string $model
     * @param Request $request
     * @return bool
     */
    public function validateSubject(string $model, Request $request){
        $id = $request->all();
        $validator = Validator::make($id,
            [$this->postKey => 'bail|required|numeric|min:0']);
        if ($validator->fails()) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param string $model
     * @param Request $request
     * @param $key
     * @return bool
     */
    public function checkValidateAndExists(string $model, Request $request){
        if(!array_key_exists($this->postKey, $request->all())) return false;
        return ($this->subjectExists($model, $request->all()[$this->postKey]) &&
                $this->validateSubject($model, $request));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getKey(Request $request){
        return $request->all()[$this->postKey];
    }

    /**
     * @param Request $request
     * @param $model
     * @param string $historyModel
     * @return array|false
     */
    public function updateSubject(Request $request, $model, string $historyModel){
        if(!array_key_exists($this->postDataKey, $request->all())) return false;
        $data = $request->all()[$this->postDataKey];
        if(!count($data)) return false;
        $history = [];
        foreach($data as $key => $value){
            $model->$key = $value;
            $history[$key] = $value;
        }
        $model->save();
        $history = $this->updateHistory($historyModel, $model->id, $history);
        return  ['model' => $model, 'history' => $history,];
    }

    /**
     * @param $model
     * @param string $historyModel
     * @return mixed
     */
    public function deleteSubject($model, string $historyModel){
        $this->updateHistory($historyModel, $model->id, ['delete']);
        $model->delete();
        return $model->id;
    }

    /**
     * @param string $history
     * @param $id
     * @param $historyData
     * @return mixed
     */
    private function updateHistory(string $history, $id, $historyData){
        $user = Auth::user();
        $model = new $history();
        $model->user_id = $user->id;
        $model->document_id = $id;
        $model->actions = json_encode($historyData);
        $model->save();
        return $model;
    }
}
