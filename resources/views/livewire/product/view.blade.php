<div>
    <div class="modal fade" id="view_product" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">عرض صنف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if($product)
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">التصنيف: </label>
                                {{$product->category->name}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">الاسم الصنف: </label>
                                {{$product->name}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">الاسم الفرعي: </label>
                                {{$product->secondary_name}}
                            </div>
                            <div class="col-4">
                                <label class="form-label">سعر البيع: </label>
                                {{$product->price}}
                            </div>
                            <div class="col-4">
                                <label class="form-label">التكلفة: </label>
                                {{$product->cost}}
                            </div>
                            <div class="col-4">
                                <label class="form-label">الخصم: </label>
                                {{$product->discount}}
                            </div>
                            <div class="col-12">
                                <label class="form-check-label">منتج مميز: </label>
                                @if($product->special) نعم @else لا @endif
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label">المخزون: </label>
                                {{$product->stock}}
                            </div>
                            <div class="col-6">
                                <label class="form-label">بلد المنشا: </label>
                                {{$product->origin_country}}
                            </div>
                            <div class="col-12">
                                <label class="form-label">المادة الفعالة: </label>
                                {{$product->active_material}}
                            </div>
                            <div class="col-12">
                                <label class="form-label">التعريف: </label>
                                <?php echo $product->description ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">خصائص و مميزات: </label>
                                <?php echo $product->properties ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">توصيات و معدلات: </label>
                                <?php echo $product->recommended_doses ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">احتيطات الامان: </label>
                                <?php echo $product->hse_precuations ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">معلومات اخري: </label>
                                <?php echo $product->other_data ?>
                            </div>
                            <div class="col-12">
                                <label class="form-label">صورة : </label>
                                @if($product && $product->file)
                                @if($product->file->type == 'image')
                                <img class="photo_uplo" src="{{url('uploads/'.$product->file->uuid.'/'.$product->file->name)}}" width="150">
                                @endif
                                {{$product->file->name}}
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