<div>
    <div class="modal fade" id="edit_order" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الطلب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if($order)
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">حالة الدفع</label>
                                <select class="form-select" wire:model="payment_status">
                                    <option value="لم يتم الدفع" @if($order->payment_status == 'لم يتم الدفع') selected @endif)>لم يتم الدفع</option>
                                    <option value="تم الدفع" @if($order->payment_status == 'تم الدفع') selected @endif)>تم الدفع</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">حالة الطلب</label>
                                <select class="form-select" wire:model="order_status">
                                    <option value="معلق" @if($order->order_status == 'معلق') selected @endif)>معلق</option>
                                    <option value="منتهي" @if($order->order_status == 'منتهي') selected @endif)>منتهي</option>
                                    <option value="ملغي" @if($order->order_status == 'ملغي') selected @endif)>ملغي</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">الفاتورة </label>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="ff_fileupload_wrap" @click="$refs.orderFileInput.click()">
                                    </div>
                                    <input x-ref="orderFileInput" type="file" wire:model="uploaded_file" class="hidden" accept=".jpg, .png, .jpeg, .gif">
                                    <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @if ($order_file)
                                <div class="img_uplo">
                                    @if($order_file['type'] == 'image')
                                    <img class="photo_uplo" src="{{ $order_file['file']->temporaryUrl() }}" width="150">
                                    @endif
                                    {{$order_file['file']->getCLientOriginalName()}}
                                </div>
                                @elseif($order && $order->file)
                                    @if($order->file->type == 'image')
                                    <img class="photo_uplo" src="{{url('uploads/'.$order->file->uuid.'/'.$order->file->name)}}" width="150">
                                    @endif
                                    {{$order->file->name}}
                                @endif
                            </div>
                            @error('uploaded_file') <span class="text-danger float_right">{{ $message }} </span> @enderror
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل الطلب</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
                 @endif
            </div>
        </div>
    </div>
</div>