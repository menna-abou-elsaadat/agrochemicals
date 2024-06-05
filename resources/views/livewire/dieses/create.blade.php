<div>
    <div class="modal fade" id="create_dieses" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">انشاء معدل استخدام جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">المحصول</label>
                                <input type="text" class="form-control" wire:model="crop" placeholder="المحصول">
                                @error('crop') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">المرض او الغرض</label>
                                <div wire:init="initQuillEditor('dieses')" wire:ignore>
                                    <div class="editor" id="dieses" function-name = "updateValueContent" function-param="dieses">   
                                    </div>
                                </div>
                            <input type="text" class="form-control hidden" wire:model="dieses">
                                @error('dieses') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">معدل الاستخدام</label>
                                <div wire:init="initQuillEditor('hse_precuations')" wire:ignore>
                                    <div class="editor" id="hse_precuations" function-name = "updateValueContent" function-param="hse_precuations">
                                        
                                    </div>
                                </div>
                                <input type="text" class="form-control hidden" wire:model="hse_precuations">
                                @error('hse_precuations') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">فترة ما قبل الحصاد PHI</label>
                                <input type="text" class="form-control" wire:model="phi" placeholder="فترة ما قبل الحصاد">
                                @error('phi') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a  class="btn btn-primary add_editor_content_before_save">تسجيل</a>
                        <button type="submit" class="btn btn-primary hidden submit_button">تسجيل</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>