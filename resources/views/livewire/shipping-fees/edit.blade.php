<div>
    <div class="modal fade" id="edit_shipping_fees" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل شحن </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">المحافظة</label>
                                <input type="text" class="form-control" wire:model="governorate" placeholder="المحافظة">
                                @error('governorate') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">التكلفة</label>
                                <input type="text" class="form-control" wire:model="shipping_cost" placeholder="التكلفة">
                                @error('shipping_cost') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">الحد الادنى للحصول على شحن مجاني</label>
                                <input type="text" class="form-control" wire:model="min_free_shipping_cost" placeholder="الحد الادنى للحصول على شحن مجاني">
                                @error('min_free_shipping_cost') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل شحن </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>