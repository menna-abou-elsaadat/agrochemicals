<div>
    <div class="modal fade" id="view_user_{{$user->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بيانات العميل</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">الاسم بالكامل: {{$user->name}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">البريد الاكتروني: {{$user->email}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">رقم الهاتف: {{$user->phone_number}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">المنطقة: {{$user->region}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">العنوان: {{$user->address_1}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">عنوان اخر: {{$user->address_2}}</label>
                            </div>
                            <div class="col-12">
                                <label class="form-label">النقط: {{$user->points}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
            </div>
        </div>
    </div>
</div>