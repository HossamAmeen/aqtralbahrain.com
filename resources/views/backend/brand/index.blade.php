@extends('backend.layouts.master')

@section('title', __('admin.brand_page'))

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('admin.brand_list') }}</h6>
      <a href="{{ route('brand.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_brand') }}">
        <i class="fas fa-plus"></i> {{ __('admin.add_brand') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($brands) > 0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('admin.sn') }}</th>
              <th>{{ __('admin.title') }}</th>
              <th>{{ __('admin.slug') }}</th>
              <th>{{ __('admin.status') }}</th>
              <th>{{ __('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($brands as $brand)   
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->title }}</td>
                    <td>{{ $brand->slug }}</td>
                    <td>
                        @if($brand->status == 'active')
                            <span class="badge badge-success">{{ __('admin.status_active') }}</span>
                        @else
                            <span class="badge badge-warning">{{ __('admin.status_inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}" data-placement="bottom">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('brand.destroy', $brand->id) }}">
                          @csrf 
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{ $brand->id }} style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.delete') }}">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{ $brands->links() }}</span>
        @else
          <h6 class="text-center">{{ __('admin.no_brands_found') }}</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate {
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
  <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
  <script>
      $('#banner-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [3, 4]
                }
            ]
        });

        // Sweet alert
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                e.preventDefault();
                swal({
                    title: "{{ __('admin.are_you_sure') }}",
                    text: "{{ __('admin.delete_confirmation') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("{{ __('admin.data_safe') }}");
                    }
                });
            });
        });
  </script>
@endpush