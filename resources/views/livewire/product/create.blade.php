<div>
    <div class="modal fade" id="create_product" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">انشاء صنف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">التصنيف</label>
                                <select class="form-select" wire:model="category_id">
                                    <option selected>اختر تصنيف</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">الاسم الصنف</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="الاسم الصنف">
                                @error('name') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">الاسم الفرعي</label>
                                <input type="text" class="form-control" wire:model="secondary_name" placeholder="الاسم الفرعي">
                            </div>
                            <div class="col-4">
                                <label class="form-label">سعر البيع</label>
                                <input type="number" class="form-control" wire:model="price" placeholder="سعر البيع">
                            </div>
                            <div class="col-4">
                                <label class="form-label">التكلفة</label>
                                <input type="number" class="form-control" wire:model="cost" placeholder="التكلفة">
                            </div>
                            <div class="col-4">
                                <label class="form-label">الخصم</label>
                                <input type="number" class="form-control" wire:model="discount" placeholder="الخصم">
                            </div>
                            <div class="col-12">
                                <label class="form-check-label">منتج مميز</label>
                                <select class="form-select" wire:model="special">
                                    <option value="0" @if($special == 0) selected @endif>لا</option>
                                    <option value="1" @if($special == 1) selected @endif>نعم</option>
                                </select>
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label">المخزون</label>
                                <input type="number" class="form-control" wire:model="stock" placeholder="المخزون">
                            </div>
                            <div class="col-6">
                                <label class="form-label">بلد المنشا</label>
                                <input type="text" class="form-control" wire:model="origin_country" placeholder="بلد المنشا">
                            </div>
                            <div class="col-12">
                                <label class="form-label">المادة الفعالة</label>
                                <input type="text" class="form-control" wire:model="active_material" placeholder="المادة الفعالة">
                            </div>
                            <div class="col-12">
                                <label class="form-label">التعريف</label>
                                <div wire:init="initQuillEditor('description')" wire:ignore>
                                    <div class="editor" id="description" function-name = "updateValueContent" function-param="description">
                                        
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="description">
                            </div>
                            <div class="col-12">
                                <label class="form-label">خصائص و مميزات</label>
                                <div wire:init="initQuillEditor('properties')" wire:ignore>
                                    <div class="editor" id="properties" function-name = "updateValueContent" function-param="properties">
                                        
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="properties">
                            </div>
                            <div class="col-12">
                                <label class="form-label">توصيات و معدلات</label>
                                <div wire:init="initQuillEditor('recommended_doses')" wire:ignore>
                                    <div class="editor" id="recommended_doses" function-name = "updateValueContent" function-param="recommended_doses">
                                        
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="recommended_doses">
                            </div>
                            <div class="col-12">
                                <label class="form-label">احتيطات الامان</label>
                                <div wire:init="initQuillEditor('hse_precuations')" wire:ignore>
                                    <div class="editor" id="hse_precuations" function-name = "updateValueContent" function-param="hse_precuations">
                                        
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="hse_precuations">
                            </div>
                            <div class="col-12">
                                <label class="form-label">معلومات اخري</label>
                                    <div wire:init="initQuillEditor('other_data')" wire:ignore>
                                        <div class="editor" id="other_data" function-name = "updateValueContent" function-param="other_data">
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="other_data">
                            </div>
                            <div class="col-12">
                                <label class="form-label">صورة </label>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="ff_fileupload_wrap" @click="$refs.productFileInput.click()">
                                    </div>
                                    <input x-ref="productFileInput" type="file" wire:model="uploaded_file" class="hidden" accept=".jpg, .png, .jpeg, .gif">
                                    <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @if ($product_file)
                                <div class="img_uplo">
                                    @if($product_file['type'] == 'image')
                                    <img class="photo_uplo" src="{{ $product_file['file']->temporaryUrl() }}" width="150">
                                    @endif
                                    {{$product_file['file']->getCLientOriginalName()}}
                                </div>
                                @endif
                            </div>
                            @error('uploaded_file') <span class="text-danger float_right">{{ $message }} </span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-primary add_editor_content_before_save">تسجيل الصنف</a>
                    <button type="submit" class="btn btn-primary hidden submit_button">تسجيل الصنف</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>