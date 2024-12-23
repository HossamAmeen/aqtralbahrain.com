@extends('user.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4"  dir="rtl" style="direction: rtl;text-align:center"> 
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3" >
      <h6 class="m-0 font-weight-bold text-primary float-left">قائمة المراجعات</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($reviews) > 0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('user.sn') }}</th>
              <th>{{ __('user.review_by') }}</th>
              <th>{{ __('user.product_title') }}</th>
              <th>{{ __('user.review') }}</th>
              <th>{{ __('user.rate') }}</th>
              <th>{{ __('user.date') }}</th>
              <th>{{ __('user.status') }}</th>
              <th>{{ __('user.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{$review->id}}</td>
                    <td>{{$review->user_info['name']}}</td>
                    <td>{{$review->product->title}}</td>
                    <td>{{$review->review}}</td>
                    <td>
                     <ul style="list-style:none" class="d-flex">
                          @for($i=1; $i<=5;$i++)
                          @if($review->rate >=$i)
                            <li style="float:left;color:#F7941D;"><i class="fa fa-star"></i></li>
                          @else
                            <li style="float:left;color:#F7941D;"><i class="far fa-star"></i></li>
                          @endif
                        @endfor
                     </ul>
                    </td>
                    <td>{{$review->created_at->format('M d D, Y g: i a')}}</td>
                    <td>
                        @if($review->status == 'active')
                          <span class="badge badge-success">{{ __('user.active') }}</span>
                        @else
                          <span class="badge badge-warning">{{ __('user.inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user.productreview.edit',$review->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('user.edit') }}" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('user.productreview.delete',[$review->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$review->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('user.delete') }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$reviews->links()}}</span>
        @else
          <h6 class="text-center">{{ __('user.no_reviews_found') }}</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[5,6]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "{{ __('user.are_you_sure') }}",
                    text: "{{ __('user.delete_warning') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("{{ __('user.safe') }}");
                    }
                });
          })
      })
  </script>
@endpush