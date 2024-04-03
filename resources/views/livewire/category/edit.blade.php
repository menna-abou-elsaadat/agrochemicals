<div>
    <div class="modal fade" id="edit_category" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل تصنيف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">الاسم التصنيف</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="الاسم التصنيف">
                                @error('name') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">صورة التصنيف</label>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="ff_fileupload_wrap" @click="$refs.categoryFileInput.click()">
                                    </div>
                                    <input x-ref="categoryFileInput" type="file" wire:model="uploaded_file" class="hidden" accept=".jpg, .png, .jpeg, .gif">
                                    <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @if($category_file)
                                    <div class="img_uplo">
                                        @if($category_file['type'] == 'image')
                                        <img class="photo_uplo" src="{{ $category_file['file']->temporaryUrl() }}" width="150">
                                        @endif  
                                        {{$category_file['file']->getCLientOriginalName()}}
                                    </div>
                                @elseif ($category&&$category->file)
                                    <div class="img_uplo">
                                        @if($category->file->type == 'image')
                                        <img class="photo_uplo" src="{{url('uploads/'.$category->file->uuid.'/'.$category->file->name)}}" width="150">
                                        @endif  
                                        {{$category->file->name}}
                                    </div>
                                @endif
                            </div>
                            @error('uploaded_file') <span class="text-danger float_right">{{ $message }} </span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تعديل التصنيف</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>