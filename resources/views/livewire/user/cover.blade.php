<div>
  <div class="page-header pattern-bg">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-2">
          <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 mb-md-0 text-white fw-light">العملاء</h1>
            <div class="page-action">
              <!-- btn:: create new project -->
              <button class="btn d-none d-sm-inline-flex rounded-pill" data-bs-toggle="modal" data-bs-target="#create_user" type="button">
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white"></path>
            </svg>
            <span class="me-1 d-none d-lg-inline-block">انشاء عميل جديد</span>
            </button>
            <!-- btn:: download -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body page-layout-1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="tab-content mt-4 mb-4">
          <!-- Tab: My Contacts -->
          <div class="tab-pane fade active show" id="contact_all" role="tabpanel">
            <div class="card overflow-hidden">
              <div id="contact_list_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row dt-row">
                  <div class="col-sm-12">
                    <table id="contact_list" class="table align-middle mb-0 card-table nowrap dataTable no-footer dtr-inline" style="width: 1226px;">
                      <thead>
                        <tr>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 159px;">الاسم</th>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 159px;" aria-label="Email: activate to sort column ascending">البريد اللكتروني</th>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 159px;">رقم التليفون</th>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 138px;" aria-label="Social: activate to sort column ascending">المنطقة</th>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 50px;" aria-label="Action: activate to sort column ascending">النقط</th>
                          <th tabindex="0"rowspan="1" colspan="1" style="width: 159px;" aria-label="Action: activate to sort column ascending"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr class="odd" wire::key="{{$user->id}}">
                          <td style="width: 159px;" class='crop_string'>{{ str($user->name)->words(2)}}</td>
                          <td style="width: 159px;">{{$user->email}}</td>
                          <td style="width: 159px;">{{$user->phone_number}}</td>
                          <td style="width: 159px;">{{$user->region}}</td>
                          <td style="width: 50px;">{{$user->points}}</td>
                          <td style="width: 159px;">
                            <button data-bs-toggle="modal" data-bs-target="#view_user_{{$user->id}}" type="button" class="btn btn-link btn-sm color-400" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="عرض">عرض</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#edit_user_{{$user->id}}" class="btn btn-link btn-sm color-400" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="تعديل">تعديل</button>
                            <button type="button" class="btn btn-link btn-sm color-400 delete_object" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="حذف" data-object-id = "{{$user->id}}" data-message="سوف يتم حذف كل شىء متعلق بهذا العميل هل تريد الاستمرار؟" data-function="remove">حذف</button>
                          </td>
                          @livewire('User.EditUser',['user'=>$user],key('user-'.$user->id))
                          @include('livewire.user.data',['user'=>$user])
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div> <!-- Row end  -->
      <!-- popup: Add new contacts -->
      @livewire('User.UserForm')
      
    </div>
  </div>
</div>