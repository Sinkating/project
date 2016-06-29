<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertFriendlinkRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

    return [
        //验证规则
        'name' => 'required',
        'url' => 'required',
        'icon' => 'image',
        'sort' => 'required',
    ];
}
    public function messages(){
    return [
        
        'name.required' =>'名字不能为空',
        'url.required' =>'链接不能为空',
        'icon.image'  =>'图标有误',
        'sort.numeric'  =>'序号有误',
        
    ];
}
}
