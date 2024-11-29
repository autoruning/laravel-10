<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Post;
use hg\apidoc\annotation as Apidoc;

/**
 * @Apidoc\Title("示例")
 */
#[Prefix('api/v1')]
class TestController extends Controller
{
    
    /**
     * @Apidoc\Title("演示")
     * @Apidoc\Tag("示例")
     * @Apidoc\Method ("POST")
     * @Apidoc\Url ("/api/v1/test")
     * @Apidoc\Query("name", type="string",require=true, desc="姓名",mock="@name") 
     */
    #[Post('test')]
    public function actionTest(Request $request)
    { 
        $name = $request->input('name'); 
        $err = $this->validate($request, [
            'name' => 'required|min:2',
        ]); 
        if($err){
            return $err;
        }
        return $this->success('请求成功',['name'=>$name,]);
    }
}
