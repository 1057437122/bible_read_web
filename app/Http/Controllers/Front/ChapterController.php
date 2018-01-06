<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChapterController extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->chapter_page=600;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $volume_id = isset($_GET['volume_id']) && !empty($_GET['volume_id']) ? $_GET['volume_id'] : '';
        if(!$volume_id){
            $first_volume = DB::table('volume')->select('id')->first();
            $volume_id = $first_volume->id;
        }

        $list_and_chapters = DB::table('list')
                        ->leftJoin('chapter','chapter.list_id','=','list.id')
                        ->select('list.id','list.name','chapter.name as chapter_name','chapter.id as chapter_id')
                        ->where('chapter.volume_id',$volume_id)
                        ->paginate($this->chapter_page);
        $lists = [];
        /*
        struct [
            ['list_name'=>$list_name,'chapters'=>[ 
                                    ['name'=>'chapter_name','id'=>'chapter_id'] , 
                                    ['name'=>'chapter_name','id'=>'chapter_id'] ,
                                    ... 
                                ],
            ],
            ['list_name'=>$list_name,'chapters'=>[...] ],
            ['list_name'=>$list_name,'chapters'=>[...] ],
        ]
        */
        $cur_list = ['list_name'=>'','chapters'=>[],'list_id'=>''];
        foreach($list_and_chapters as $item){


            
            if($item->name != $cur_list['list_name']){
                #push old cur_list and create new cur_list
                if($cur_list['list_name'] && $cur_list['chapters']){
                    array_push($lists, $cur_list);
                }
                $cur_list = ['list_name'=>$item->name,'chapters'=>[],'list_id'=>$item->id];

            }
            // mylog($cur_list);
            // mylog('item name:'.$item->name.' and curlistname:'.$cur_list['list_name']);

            $cur_chapter = ['name'=>$item->chapter_name,'id'=>$item->chapter_id];
            array_push($cur_list['chapters'], $cur_chapter);

        }
        array_push($lists, $cur_list); 
        $total_page = ceil($list_and_chapters->total()/$this->chapter_page);
        $start_page = isset($_GET['page']) ? $_GET['page'] : 1 ;

        return view('front.'.$this->theme.'.chapter_index',['lists'=>$lists,
                                                    'total_page'=>$total_page,
                                                    'start_page'=>$start_page,
                                                    'volume_id'=>$volume_id,
                                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
