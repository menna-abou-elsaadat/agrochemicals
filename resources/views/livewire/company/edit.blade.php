<div>
    <div class="modal fade" id="edit_company_data" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل معلومة عن الشركة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">الاسم</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="الاسم">
                                @error('name') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">التفاصيل</label>
                                <div>
                                    <div class="editor" id="value{{$id}}" function-name = "updateEditValueContent"><?php echo $value ?></div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="value">
                                @error('value') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-primary add_editor_content_before_save">تعديل معلمة عن الشركة</a>
                        <button type="submit" class="btn btn-primary hidden submit_button">تعديل معلمة عن الشركة</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>