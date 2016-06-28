<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsertGoodsRequest extends Request
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
        'price' => 'numeric',
        'store' => 'numeric',
        'company' => 'required',
        'catesid' => 'required',
        'descr' => 'required',
        'pic' =>'image',
    ];
}
    public function messages(){
    return [
        
        'name.required' =>'商品名称不能为空',
        'price.numeric' =>'商品价格有误',
        'store.numeric'  =>'库存量有误',
        'company.required'  =>'生产厂家不能为空',
        'catesid.required' =>'商品类别有误',
        'descr.required' => '商品描述不能为空',
        'pic.image' => '图片类型不合法',
    ];
}
}
