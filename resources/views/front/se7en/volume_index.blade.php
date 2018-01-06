@extends('front.se7en.front_tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">

  <div class="widget-content padded clearfix">
    <table class="table table-striped">
      

    	<tbody>
    	@php $ct = 0 ;@endphp
    	<tr>

	      	@foreach($volumes as $volume)

			@php $ct++; @endphp
	      		
	      			<td>
	      				<a href="{{ URL('/'.$front.'/chapter?volume_id='.$volume->id )}}" title="{{ $volume->name }}">{{ $volume->name }}</a>
	      			</td>

	      		
	      		@if($ct %3 == 0)
	      		</tr><tr>
	      		@endif
	      		
	      	@endforeach
	    </tr>
        <tr>
          <td colspan="3" style="text-align:center" >
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
    window.location.href = "{{ URL('/'.$front.'/volume?category_id='.$category_id )}}&page="+num;
});

</script>
@endsection