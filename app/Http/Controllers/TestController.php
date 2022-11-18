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
                $output =  DB::table('tests')->insert($datasave);
            }

        $output="";
        $data = Test::get();
        foreach ($data as $key => $item) {
            $output.='<tr>'.
                '<td>'.$item->title.'</td>'.
                '<td>'.$item->value.'</td>'.
                '<td><a href="javascript:void(0)" class="btn btn-info dltBtn" data-id="'.$item->id.'">Delete</a></td>'.
                '</tr>';
        }
//        return Response($output);
        return response()->json($output);
    }
    public function testSearch(Request $request){
        if ($request->ajax()){
            $output="";
            $data = Test::where('title', 'LIKE', "%$request->search%")->orWhere('value', 'LIKE', "%$request->search%")->get();
            foreach ($data as $key => $item) {
                $output.='<tr>'.
                    '<td>'.$item->title.'</td>'.
                    '<td>'.$item->value.'</td>'.
                    '<td><a href="javascript:void(0)" class="btn btn-info dltBtn" data-id="'.$item->id.'">Delete</a></td>'.
                    '</tr>';
            }
//            return Response($output);
            return response()->json($output);
        }
    }

    public function testDelete(Request $request){
        if ($request->ajax()){
            $output="";
            $dlt = Test::where('id',$request->value)->delete();
            $data = Test::get();
            if($dlt){
                foreach ($data as $key => $item) {
                    $output.='<tr>'.
                        '<td>'.$item->title.'</td>'.
                        '<td>'.$item->value.'</td>'.
                        '<td><a href="javascript:void(0)" class="btn btn-info dltBtn" data-id="'.$item->id.'">Delete</a></td>'.
                        '</tr>';
                }
//                return Response($output);
                return response()->json($output);
            }
        }
    }
}
