<div>
    <div class="modal fade" id="edit_user" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل عميل </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-2" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">الاسم بالكامل</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="الاسم بالكامل">
                                @error('name') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">البريد الاكتروني</label>
                                <input type="text" class="form-control" wire:model="email" placeholder="example:name@gmail.com">
                                @error('email') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">كلمة المرور</label>
                                <input type="text" class="form-control" wire:model="password" placeholder="كلمة المرور">
                                @error('password') <span class="text-danger float_right">{{ $message }} </span> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label">رقم الهاتف</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" wire:model="phone_number" placeholder="رقم الهاتف">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">المنطقة</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model="region" placeholder="المنطقة">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">العنوان</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model="address_1" placeholder="العنوان">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">عنوان اخر</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model="address_2" placeholder="عنوان اخر">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">النقط</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" wire:model="points" placeholder="النقط">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل العميل</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>