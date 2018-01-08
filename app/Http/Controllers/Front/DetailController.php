<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DetailController extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->detail_page = 600;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = isset($_GET['chapter_id']) && !empty($_GET['chapter_id']) ? $_GET['chapter_id'] : '';
        if(!$id){
            $first_chapter = DB::table('chapter')->select('id')->first();
            $id = $first_chapter->id;
        }


        $details = DB::table('detail')->where('chapter_id',$id)->paginate($this->detail_page);
        $colspan = 4;
        if(count($details) == 1){
            $colspan = 1;
        }
        $total_page = ceil($details->total()/$this->detail_page);
        $start_page = isset($_GET['page']) ? $_GET['page'] : 1 ;


        return view('front.'.$this->theme.'.detail_index',['details'=>$details,
                                                    'total_page'=>$total_page,
                                                    'start_page'=>$start_page,
                                                    'chapter_id'=>$id,
                                                    'colspan'=>$colspan,
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
    public function search(){
        $search_item = isset($_GET['search_item']) && !empty($_GET['search_item']) ? $_GET['search_item'] : '';
        if($search_item){
            // $items = DB::table('detail')->where([['content','like','%'.$search_item.'%' ] ] )->paginate($this->detail_page);
            //select substring(content,instr(content,'起初'),6) from detail where content like '%起初%' limit 0,10;
            $details = DB::table('detail')
                    ->leftJoin('chapter','chapter.id','=','detail.chapter_id')
                    ->leftJoin('volume','volume.id','=','chapter.volume_id')
                    ->select(DB::raw('substring(detail.content,instr(detail.content,"'.$search_item.'"),20) as content'),'volume.name','chapter.id as chapter_id','detail.id')
                    // ->select('detail.content','volume.name')
                    ->where([['detail.content','like','%'.$search_item.'%']])
                    ->paginate($this->detail_page);
            mylog($details);

            if(!$details){
                return view('front'.$this->theme.'.show_info_page',['multiline'=>False,'data'=>'没有找到该内容']);
            }
            $total_page = ceil($details->total()/$this->detail_page);
            $start_page = isset($_GET['page']) ? $_GET['page'] : 1 ;
            $colspan = 2;


            return view('front.'.$this->theme.'.detail_search_index',['details'=>$details,
                                                    'total_page'=>$total_page,
                                                    'start_page'=>$start_page,
                                                    'colspan'=>$colspan,
                                                    'search_item'=>$search_item,
                                                    ]);
        }else{
            return view('front'.$this->theme.'.show_info_page',['multiline'=>False,'data'=>'没有该内容']);
        }
    }
}
