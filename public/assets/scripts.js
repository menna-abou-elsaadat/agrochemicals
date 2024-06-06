
document.addEventListener('livewire:init', () => {
       Livewire.on('close_modal', (message) => {
          $(".modal").modal('hide');
        show_message(message);
    	});
       /////////////////users/////////////////
       Livewire.on('openEditUserModal', (message) => {
          $('#edit_user').modal('show')
       });
       Livewire.on('openViewUserModal', (message) => {
          $('#view_user').modal('show')
       });
       //////////////////////categories///////////////////////
       Livewire.on('openEditCategoryModal', (message) => {
          $('#edit_category').modal('show')
       });
       ///////////////////products//////////////////
       Livewire.on('openEditProductModal', (message) => {
          $('#edit_product').modal('show')
       });
       Livewire.on('openViewProductModal', (message) => {
          $('#view_product').modal('show')
       });

        //////////////////////shipping fees///////////////////////
       Livewire.on('openEditShippingFeesModal', (message) => {
          $('#edit_shipping_fees').modal('show')
       });

       //////////////////////company data///////////////////////
       Livewire.on('openEditCompanyDataModal', (message) => {
          $('#edit_company_data').modal('show')
       });

       //////////////////////advs data///////////////////////
       Livewire.on('openEditAdvModal', (message) => {
          $('#edit_adv').modal('show')
       });

       //////////////////////payment method data///////////////////////
       Livewire.on('openEditPaymentMethodModal', (message) => {
          $('#edit_payment_method').modal('show')
       });

       //////////////////////discount codes data///////////////////////
       Livewire.on('openEditDiscountCodesModal', (message) => {
          $('#edit_discount_code').modal('show')
       });

       //////////////////////contact data///////////////////////
       Livewire.on('openEditContactModal', (message) => {
          $('#edit_contact').modal('show')
       });

       //////////////////////dieses data///////////////////////
       Livewire.on('openEditDiesesModal', (message) => {
          $('#edit_dieses').modal('show')
       });

       //////////////////////order data///////////////////////
       Livewire.on('openEditOrderModal', (message) => {
          $('#edit_order').modal('show')
       });
       Livewire.on('openViewOrderModal', (message) => {
          $('#view_order').modal('show')
       });

       
       Livewire.on('passPageTitleToLayout', (pageTitle) => {
          $('.'+pageTitle[0]).addClass('active');
       });
       Livewire.on('clean_editor', () => {
          $('.editor').each(function(){
               $(this).find('.ql-editor').empty();
         })
       });

       Livewire.on('initQuillEditor', (id) => {
            setUpQuillEditor(id[0])
          });
       Livewire.on('initSecondQuillEditor', (id) => {
            setUpSecondQuillEditor(id[0])
          });
       
   });

$(document).on('click','.delete_object',function(){
	message = $(this).attr('data-message');
	function_name = $(this).attr('data-function')
	object_id = $(this).attr('data-object-id')
	Swal.fire({
	  title: message,
	  showDenyButton: true,
	  showCancelButton: false,
	  confirmButtonText: "الاستمرار",
	  denyButtonText: `الــغــاء`,
	  denyButtonColor:'green',
	  confirmButtonColor:'red',
	}).then((result) => {
	  if (result.isConfirmed) {
	    Livewire.dispatch(function_name,[object_id]);
	  } 
	});
})
$(document).ready(function() {
   $('.modal').modal({backdrop: 'static', keyboard: false})
   // setUpQuillEditor();
   
});

$(document).on('click','.add_editor_content_before_save',function(){
  $('.editor').each(function(){
      id  = $(this).attr('id');
      function_name = $(this).attr('function-name');
      function_param = $(this).attr('function-param');
      const quill = $('#'+id);
      content = quill.find('.ql-editor').html();
      Livewire.dispatch(function_name,[function_param,content]);

   })
  $(this).parent().find('.submit_button').click();
})
	


function show_message(message)
{
	Swal.fire({
		  title: '',
		  text: message,
		  icon: 'success',
		  showConfirmButton :false,
		  timer: 3000,
		});
}

function setUpQuillEditor(id)
{
   setTimeout( () =>
         {
           const toolbarOptions = [
              ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

              ['link', 'image', 'video'],
              // custom button values
              [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],    // superscript/subscript         // outdent/indent
              [{ 'direction': 'rtl' }],                         // text direction


              [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown


              [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
              [{ 'font': [] }],
              [{ 'align': [] }],


              ['clean']                                         // remove formatting button
            ];


            const quill = new Quill('#'+id, {
              modules: {
                toolbar: toolbarOptions
              },
              theme: 'snow'
            });
      
         }, 100 ); 
      
}