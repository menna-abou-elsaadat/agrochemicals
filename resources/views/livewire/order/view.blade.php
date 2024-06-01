<div>
    <div class="modal fade" id="view_order" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">عرض الطلب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if($order)
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">اسم المستخدم: </label>
                                {{$order->user->name}}
                            </div>
                            <div class="col-12">
                                <label class="form-label">العنوان: </label>
                                {{$order->shipping_address}} {{$order->shipping_governorate}}
                            </div>
                            <div class="col-12">
                                <label class="form-label">تليفون: </label>
                                {{$order->phone}}
                            </div>
                            <div class="col-4">
                                <label class="form-label">السعر الكلى: </label>
                                {{$order->total_price}}
                            </div>
                            <div class="col-4">
                                <label class="form-label">مصاريف الشحن: </label>
                                {{$order->shipping_fees}}
                            </div>
                            <div class="col-4">
                                <label class="form-check-label">الخصم: </label>
                                    {{$order->discount}}
                            </div>
                            
                            <div class="col-4">
                                <label class="form-label">السعر النهائي: </label>
                                {{$order->final_price}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">طريقة الدفع: </label>
                                {{$order->payment_type}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">حالة الدفع: </label>
                                {{$order->payment_status}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">حالة الطلب: </label>
                                {{$order->order_status}}
                            </div>
                            <label class="form-label">الاصناف: </label>
                            <table>
                                <tr>
                                    <th>الاسم</th>
                                    <th>السعر</th>
                                    <th>العدد</th>
                                </tr>
                                @foreach($order->products as $order_product)
                                    <tr>
                                        <td>{{$order_product->product->name}}</td>
                                        <td>{{$order_product->price}}</td>
                                        <td>{{$order_product->count}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="col-12">
                                <label class="form-label">الفاتورة : </label>
                                @if($order && $order->file)
                                @if($order->file->type == 'image')
                                <img class="photo_uplo" src="{{url('uploads/'.$order->file->uuid.'/'.$order->file->name)}}" width="150">
                                @endif
                                {{$order->file->name}}
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>