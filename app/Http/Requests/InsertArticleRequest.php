<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertArticleRequest extends Request
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
        'title' => 'required',
        'content' => 'required',
        'descr' => 'required',
        'cate_id' => 'numeric',
    ];
}
    public function messages(){
    return [
        'title.required' => '标题不能为空',
        'content.required' => '内容不能为空',
        'descr.required' => '描述不能为空',
        'cate_id.numeric' =>'文章分类参数有误',
    ];
}
}
