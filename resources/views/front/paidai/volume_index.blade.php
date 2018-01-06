@extends('front.paidai.front_tpl')

@section('content')
<div class="bbsdata_list">
	<!--列表开始-->
	@foreach($volumes as $volume)
	<dl>
		<dt>
										
			<a href="{{ URL('/'.$front.'/volume/'.$volume->id )}}" title="{{ $volume->name }}">{{ $volume->name }}</a>&nbsp;&nbsp;
			<p class="clear"></p>
		</dt>

	</dl>
	@endforeach
	<table>
		<tr>
          <td colspan="6" style="text-align:center" >
            <p  id="dynamic_pager_demo1" class="pagination"></p>
          </td>
        </tr>
    </table>
			<!--列表结束-->
    <div class="clear"></div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$('#dynamic_pager_demo1').bootpag({
	    total: {{ $total_page }},
	    page: {{ $start_page }},
	    maxVisible: 10
	}).on("page", function(event, num){
	    window.location.href = "{{ URL('/'.$front.'/volume?category_id='.$category_id )}}&page="+num;
	});
</script>

@endsection