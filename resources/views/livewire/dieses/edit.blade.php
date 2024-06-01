<div>
    <div class="modal fade" id="edit_dieses" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل معدل استخدام </h5>
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
                                <textarea class="form-control" placeholder="المرض او الغرض" style="height: 100px" wire:model="dieses"></textarea>
                                @error('dieses') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">معدل الاستخدام</label>
                                <textarea class="form-control" placeholder="معدل الاستخدام" style="height: 100px" wire:model="hse_precuations"></textarea>
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
                        <button type="submit" class="btn btn-primary">تعديل</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>