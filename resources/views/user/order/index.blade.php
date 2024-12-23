@extends('user.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4"  dir="rtl" style="direction: rtl;text-align:center">
     <div class="row">
         <div class="col-md-12">
            @include('user.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3" dir="rtl">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('user.order_lists') }}</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($orders) > 0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('user.sn') }}</th>
              <th>{{ __('user.order_no') }}</th>
              <th>{{ __('user.name') }}</th>
              <th>{{ __('user.email') }}</th>
              <th>{{ __('user.quantity') }}</th>
              <th>{{ __('user.charge') }}</th>
              <th>{{ __('user.total_amount') }}</th>
              <th>{{ __('user.status') }}</th>
              <th>{{ __('user.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->shipping->price ?? ''}}</td>
                    <td>${{number_format($order->total_amount, 2)}}</td>
                    <td>
                        @if($order->status == 'new')
                          <span class="badge badge-primary">{{ __('user.new') }}</span>
                        @elseif($order->status == 'process')
                          <span class="badge badge-warning">{{ __('user.process') }}</span>
                        @elseif($order->status == 'delivered')
                          <span class="badge badge-success">{{ __('user.delivered') }}</span>
                        @else
                          <span class="badge badge-danger">{{ __('user.cancelled') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user.order.show', $order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="{{ __('user.view') }}" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="{{route('user.order.delete', [$order->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="{{ __('user.delete') }}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$orders->links()}}</span>
        @else
          <h6 class="text-center">{{ __('user.no_orders_found') }} {{ __('user.please_order_products') }}</h6>
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
                    "targets":[8]
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
                    title: "{{ __('user.are_you_sure') }}",
                    text: "{{ __('user.once_deleted') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("{{ __('user.your_data_is_safe') }}");
                    }
                });
          })
      })
  </script>
@endpush