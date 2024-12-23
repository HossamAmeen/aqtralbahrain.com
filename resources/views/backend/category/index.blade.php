@extends('backend.layouts.master')

@section('main-content')
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        @include('backend.layouts.notification')
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('admin.category_lists') }}</h6>
      <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" title="{{ __('admin.add_category') }}">
        <i class="fas fa-plus"></i> {{ __('admin.add_category') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($categories) > 0)
          <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>{{ __('admin.s_n') }}</th>
                <th>{{ __('admin.title') }}</th>
                <th>{{ __('admin.slug') }}</th>
                <th>{{ __('admin.is_parent') }}</th>
                <th>{{ __('admin.parent_category') }}</th>
                <th>{{ __('admin.photo') }}</th>
                <th>{{ __('admin.status') }}</th>
                <th>{{ __('admin.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->title }}</td>
                  <td>{{ $category->slug }}</td>
                  <td>{{ $category->is_parent == 1 ? __('admin.yes') : __('admin.no') }}</td>
                  <td>{{ $category->parent_info->title ?? '' }}</td>
                  <td>
                    <img src="{{ $category->photo ?? asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid" style="max-width:80px" alt="{{ __('admin.category_image') }}">
                  </td>
                  <td>
                    <span class="badge {{ $category->status == 'active' ? 'badge-success' : 'badge-warning' }}">
                      {{ __($category->status) }}
                    </span>
                  </td>
                  <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{ $category->id }}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('admin.delete') }}">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <span style="float:right">{{ $categories->links() }}</span>
        @else
          <h6 class="text-center">{{ __('admin.no_categories') }}</h6>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
    div.dataTables_wrapper div.dataTables_paginate{
      display: none;
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
          "targets": [3, 4, 5, 6] // Make columns non-orderable
        }
      ]
    });

    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.dltBtn').click(function(e){
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
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
            swal("{{ __('admin.data_safe') }}");
          }
        });
      });
    });
  </script>
@endpush
