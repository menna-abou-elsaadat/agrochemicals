<div>
    <div class="modal fade" id="edit_adv" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل اعلان </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">النص</label>
                                <div>
                                    <div class="editor" id="text{{$id}}" function-name = "updateValueContent" function-param="text">
                                        <?php echo $text ?>
                                    </div>
                                </div>
                                 <input type="text" class="form-control hidden" wire:model="text">
                                @error('text') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">صورة</label>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <div class="ff_fileupload_wrap" @click="$refs.advFileInput.click()">
                                    </div>
                                    <input x-ref="advFileInput" type="file" wire:model="uploaded_file" class="hidden" accept=".jpg, .png, .jpeg, .gif">
                                    <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                @if ($adv_file)
                                    <div class="img_uplo">
                                        @if($adv_file['type'] == 'image')
                                        <img class="photo_uplo" src="{{ $adv_file['file']->temporaryUrl() }}" width="150">
                                        @endif  
                                        {{$adv_file['file']->getCLientOriginalName()}}
                                    </div>
                                @elseif ($adv&&$adv->file)
                                    <div class="img_uplo">
                                        @if($adv->file->type == 'image')
                                        <img class="photo_uplo" src="{{url('uploads/'.$adv->file->uuid.'/'.$adv->file->name)}}" width="150">
                                        @endif  
                                        {{$adv->file->name}}
                                    </div>
                                @endif
                            </div>
                            @error('uploaded_file') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            @error('adv_file') <span class="text-danger float_right">{{ $message }} </span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-primary add_editor_content_before_save">تعديل الاعلان</a>
                    <button type="submit" class="btn btn-primary hidden submit_button">تعديل الاعلان</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>