@extends('backend.layouts.master')
@section('title', __('admin.banner_page_title'))
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('admin.banners_list') }}</h6>
      <a href="{{route('banner.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_banner_tooltip') }}"><i class="fas fa-plus"></i> {{ __('admin.add_banner') }}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($banners) > 0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
        
         
              <th>{{ __('admin.photo') }}</th>
              <th>{{ __('admin.status') }}</th>
              <th>{{ __('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($banners as $banner)   
                <tr>
               
                    <td>
                        @if($banner->photo)
                            <img src="{{$banner->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$banner->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                        @endif
                    </td>
                    <td>
                        @if($banner->status == 'active')
                            <span class="badge badge-success">{{$banner->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$banner->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('banner.edit', $banner->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('banner.destroy', [$banner->id])}}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$banner->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.delete') }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$banners->links()}}</span>
        @else
          <h6 class="text-center">{{ __('admin.no_banners_found') }}</h6>
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
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(3.2);
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
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
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
                    text: "{{ __('admin.delete_warning') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("{{ __('admin.your_data_is_safe') }}");
                    }
                });
          })
      })
  </script>
@endpush
