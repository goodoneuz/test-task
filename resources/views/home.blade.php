@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Список заказов<button class="btn btn-info float-right"  data-toggle="modal" data-target="#createModal">Создать заказ</button></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($orders as $order)
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="card-title" style="height: 50px"><a href="#">#{{$order->id}}</a> - {{ $order->service->name }}</h5>
                                        <p class="card-text" style="height: 100px;">{{ $order->description }}</p>
                                        <p>Date: <br>{{ $order->date }}</p>
                                        <p>Status: <span class="badge badge-warning" id="status-{{ $order->id }}">{{ $order->statusName() }}</span></p>
                                        <p>User: {{ $order->user->name }}</p>
                                        <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post">
                                            @method('delete')
                                            @csrf()
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                        @if(auth()->user()->getRole()->hasPermission('Moderate all orders'))
                                            <a href="#" class="btn btn-success status-changer" data-order-id="{{ $order->id }}" data-type="2">Accept</a>
                                            <a href="#" class="btn btn-warning status-changer" data-order-id="{{ $order->id }}" data-type="3">Reject</a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('order.store') }}" name="createOrder">
                @csrf()
                <div class="form-group">
                    <label for="exampleInputEmail1">Дата</label>
                    <input type="date" class="form-control" id="datetimepicker" name="date">
                    <input type="time" class="form-control" id="datetimepicker" name="time">
                </div>

                <div class="form-group">
                        <label for="exampleFormControlSelect1">Тип услуги</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="service_id">
                            <option value="" disabled>Выберите тип услуги</option>
                            @foreach (\App\Service::all() as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        </div>
                <div class="form-group">
                    <label for="exampleInputDesc">Комментарий</label>
                    <textarea name="description" id="exampleInputDesc" rows="5" class="form-control" name="description"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="document.forms['createOrder'].submit()">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.status-changer').click(function(event){
            const order_id = $(event.target).data('order-id');
            const type = $(event.target).data('type');
            var request = $.ajax({
                url: '/order/'+order_id+'/status/'+type,
                method: "GET",
            });
            request.done(function(res){
                console.log(res.result)
                $('#status-'+order_id).html(res.result);
            });
            request.fail(function(err){
                console.log(err)
            })
        });

    });
</script>
@endpush
