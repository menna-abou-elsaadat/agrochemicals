
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
 
       Livewire.on('passPageTitleToLayout', (pageTitle) => {
          $('.'+pageTitle[0]).addClass('active');
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

   //  $('.file_uploader').each(function(){
   //  	model_name = $(this).attr('data-model-name');
   //  	id = $(this).attr('data-id');
   //  	model_column = $(this).attr('data-model-column');
   //  	$(this).FancyFileUpload({
	// 	url: "/upload_file",
	// 	params : {
	// 		_token : $('#token').val(),
	// 		'model_name' : model_name,
	// 		'model_column' : model_column,
	// 		'id' : id
	// 	},
	// 	'maxfilesize' : -1,
	// 	added: function(e,data)
	// 	{
	// 		console.log(e);
	// 		console.log(data);
	// 	}

	// });
   //  });
	
});

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