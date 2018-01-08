@extends('front.se7en.front_tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">

  <div class="widget-content padded clearfix">
    <table class="table table-striped">
      

    	<tbody>
    	
	      	@foreach($details as $detail)
          <tr>
            <td>{{ $detail->name }}</td>
            <td><a href="{{ URL('/'.$front.'/detail?chapter_id='.$detail->chapter_id) }}#detail_{{$detail->id}}">...{{ $detail->content }}...</a></td>
          </tr>
          
          @endforeach
	         <tr>
            <td colspan="{{ $colspan }}" style="text-align:center" >
              <p  id="dynamic_pager_demo1" class="pagination"></p>
            </td>
          </tr>
        
        
      </tbody>
    </table>
  </div>
</div>
</div>
<!-- end Striped Table -->
</div><!--row-->

@endsection
@section('scripts')
<script>
$('#').addClass('current');
</script>
<script>

$('#dynamic_pager_demo1').bootpag({
    total: {{ $total_page }},
    page: {{ $start_page }},
    maxVisible: 10
}).on("page", function(event, num){
    window.location.href = "{{ URL('/'.$front.'/detail/search?search_item='.$search_item )}}&page="+num;
});

</script>
@endsection