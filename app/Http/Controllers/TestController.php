<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(){
        $test =Test::get();
        return view('test.test',compact('test'));
    }
    public function testStore(Request $request){
            $title = $request->title;
            $value = $request->value;

            for ($i=0 ; $i < count($title); $i++){
                $datasave = [
                    'title' => $title[$i],
                    'value' => $value[$i],
                ];
                DB::table('tests')->insert($datasave);
            }
        return redirect()->back();
    }
    public function testSearch(Request $request){
        if ($request->ajax()){
            $output="";
            $data = Test::where('title', 'LIKE', "%$request->search%")->orWhere('value', 'LIKE', "%$request->search%")->get();
//            return view('test.search',compact('data'));
            foreach ($data as $key => $item) {
                $output.='<tr>'.
                    '<td>'.$item->title.'</td>'.
                    '<td>'.$item->value.'</td>'.
                    '<td><button class="btn btn-info">Delete</button></td>'.
                    '</tr>';
            }
            return Response($output);
        }
    }
}
