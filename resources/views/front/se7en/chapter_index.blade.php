@extends('front.se7en.front_tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">



<div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height">
        
        <div class="widget-content">
          <div class="panel-group" id="accordion">
            @foreach($lists as $list)
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title">
                  <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse_{{ $list['list_id']}}">
                    <div class="caret pull-right"></div>
                    {{ $list['list_name'] }} </a>
                </div>
              </div>
              <div class="panel-collapse collapse" id="collapse_{{$list['list_id']}}">
                <div class="panel-body">
                  
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        @php $ct = 0; @endphp
                        @foreach($list['chapters'] as $chapter)
                        @php $ct++; @endphp
                        <td><a href="{{ URL('/'.$front.'/detail?chapter_id='.$chapter['id']) }}">{{ $chapter['name'] }}</a></td>
                        @if($ct % 3 == 0)
                          </tr><tr>
                        @endif
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
                  
                  

                  
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>


<div class="widget-content padded clearfix">
  <table class="table table-striped">
    <tbody>
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
    window.location.href = "{{ URL('/'.$front.'/chapter?volume_id='.$volume_id )}}&page="+num;
});

</script>
@endsection