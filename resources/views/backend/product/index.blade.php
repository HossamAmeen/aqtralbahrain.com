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
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('admin.product_lists') }}</h6>
      <a href="{{route('product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_product') }}"><i class="fas fa-plus"></i> {{ __('admin.add_product') }}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($products) > 0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('admin.sn') }}</th>
              <th>{{ __('admin.title') }}</th>
              <th>{{ __('admin.category') }}</th>
              <th>{{ __('admin.is_featured') }}</th>
              <th>{{ __('admin.price') }}</th>
              <th>{{ __('admin.discount') }}</th>
              <th>{{ __('admin.size') }}</th>
              <th>{{ __('admin.condition') }}</th>
              <th>{{ __('admin.brand') }}</th>
              <th>{{ __('admin.stock') }}</th>
              <th>{{ __('admin.photo') }}</th>
              <th>{{ __('admin.status') }}</th>
              <th>{{ __('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              @php
              $sub_cat_info = DB::table('categories')->select('title')->where('id', $product->child_cat_id)->get();
              $brands = DB::table('brands')->select('title')->where('id', $product->brand_id)->get();
              @endphp
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->cat_info['title']}}
                      <sub>
                          {{$product->sub_cat_info->title ?? ''}}
                      </sub>
                    </td>
                    <td>{{ $product->is_featured == 1 ? __('admin.yes') : __('admin.no') }}</td>
                    <td>Rs. {{$product->price}} /-</td>
                    <td> {{$product->discount}}% {{ __('admin.off') }}</td>
                    <td>{{$product->size}}</td>
                    <td>{{$product->condition}}</td>
                    <td> {{ ucfirst(@$product->brand->title) }}</td>
                    <td>
                      @if($product->stock > 0)
                      <span class="badge badge-primary">{{$product->stock}}</span>
                      @else
                      <span class="badge badge-danger">{{$product->stock}}</span>
                      @endif
                    </td>
                    <td>
                        @if($product->photo)
                            @php
                              $photo = explode(',', $product->photo);
                            @endphp
                            <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        @endif
                    </td>
                    <td>
                        @if($product->status == 'active')
                            <span class="badge badge-success">{{$product->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$product->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('admin.edit') }}" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('product.destroy', [$product->id])}}">
                      @csrf
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.delete') }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$products->links()}}</span>
        @else
          <h6 class="text-center">{{ __('admin.no_products_found') }}</h6>
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
        transform: scale(5);
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

      $('#product-dataTable').DataTable({
        "scrollX": false,
        "columnDefs": [
            {
                "orderable": false,
                "targets": [10, 11, 12]
            }
        ]
      });

      // Sweet alert

      function deleteData(id) {
        // This function could be extended to handle custom deletions
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
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
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
