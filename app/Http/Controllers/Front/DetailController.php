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
        $info = DB::table('chapter')
                ->leftJoin('list','list.id','=','chapter.list_id')
                ->leftJoin('volume','volume.id','=','chapter.volume_id')
                ->leftJoin('category','category.id','=','volume.category_id')
                ->select('volume.name as vname','list.name as lname','chapter.name as cname','volume.id as vid','category.id as cat_id')
                ->where('chapter.id',$id)
                ->first();


        $details = DB::table('detail')->where('chapter_id',$id)->paginate($this->detail_page);

        $menu_items = [];
        #we need to judge whether the chapter belong to bible translation  which section_num is not null ,previous chapter_id is less than current id  -- 
        $cur_section = $details[0]->section_num;
        $prev_chapter = DB::table('chapter')->select('id','name')->where('id','<=',function($query) use ($id,$cur_section){
                                                                        $query
                                                                        ->select('chapter_id')
                                                                        ->from('detail');
                                                                        if($cur_section)
                                                                            $query->whereNotNull('section_num');
                                                                        else
                                                                            $query->whereNull('section_num');

                                                                        $query
                                                                        ->where('chapter_id','<',$id)
                                                                        ->orderBy('id','desc')
                                                                        ->first();
                                                                    })
                                                                    ->orderBy('id','desc')
                                                                    ->first();

        // $prev_chapter_id = $id - 1;
        // $prev_chapter = DB::table('chapter')->select('id','name')->where('id',$prev_chapter_id)->first();
        if($prev_chapter){
            $prev_arr = ['url'=>URL('/'.$this->front.'/detail?chapter_id='.$prev_chapter->id),'name'=>'上一章','info'=>$prev_chapter->name];
            array_push($menu_items, $prev_arr);
        }
        
        $next_chapter = DB::table('chapter')->select('id','name')->where('id','>=',function($query) use ($id,$cur_section){
                                                                        $query
                                                                        ->select('chapter_id')
                                                                        ->from('detail');
                                                                        if($cur_section)
                                                                            $query->whereNotNull('section_num');
                                                                        else
                                                                            $query->whereNull('section_num');
                                                                        $query
                                                                        ->where('chapter_id','>',$id)
                                                                        ->orderBy('id','asc')
                                                                        ->first();
                                                                    })
                                                                    ->orderBy('id','asc')
                                                                    ->first();
        if($next_chapter){
            $next_arr = ['url'=>URL('/'.$this->front.'/detail?chapter_id='.$next_chapter->id),'name'=>'下一章','info'=>$next_chapter->name];
            array_push($menu_items, $next_arr);
        }
        if($menu_items)
            $show_menu = 1;
        
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
                                                    'info'=>$info,
                                                    'show_menu'=>$show_menu,
                                                    'menu_items'=>$menu_items,
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
