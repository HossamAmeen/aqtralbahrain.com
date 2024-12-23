@extends('backend.layouts.master')
@section('title', __('admin.e_shop_comment_page'))
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('admin.comment_lists') }}</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($comments)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('admin.sn') }}</th>
              <th>{{ __('admin.author') }}</th>
              <th>{{ __('admin.post_title') }}</th>
              <th>{{ __('admin.message') }}</th>
              <th>{{ __('admin.date') }}</th>
              <th>{{ __('admin.status') }}</th>
              <th>{{ __('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->user_info['name']}}</td>
                    <td>{{$comment->post->title}}</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->created_at->format('M d D, Y g: i a')}}</td>
                    <td>
                        @if($comment->status=='active')
                          <span class="badge badge-success">{{$comment->status}}</span>
                        @else
                          <span class="badge badge-warning">{{$comment->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('comment.edit',$comment->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('comment.destroy',[$comment->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$comment->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.delete') }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$comments->links()}}</span>
        @else
          <h6 class="text-center">{{ __('admin.no_comments_found') }}</h6>
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
              e.preventDefault();
              swal({
                    title: "{{ __('admin.are_you_sure') }}",
                    text: "{{ __('admin.once_deleted') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("{{ __('admin.data_safe') }}");
                    }
                });
          })
      })
  </script>
@endpush