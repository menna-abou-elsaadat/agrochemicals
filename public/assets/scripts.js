
document.addEventListener('livewire:init', () => {
       Livewire.on('close_modal', (message) => {
          $(".modal").modal('hide');
        show_message(message);
    	});
       Livewire.on('openEditUserModal', (message) => {
          $('#edit_user').modal('show')
       });
       Livewire.on('openViewUserModal', (message) => {
          $('#view_user').modal('show')
       });
      });


$(document).on('click','.delete_object',function(){
	message = $(this).attr('data-message');
	function_name = $(this).attr('data-function')
	object_id = $(this).attr('data-object-id')
	Swal.fire({
	  title: message,
	  showDenyButton: true,
	  showCancelButton: true,
	  confirmButtonText: "الاستمرار",
	  denyButtonText: `الغاء`
	}).then((result) => {
	  if (result.isConfirmed) {
	    Livewire.dispatch(function_name,[object_id]);
	  } 
	});
})
$(document).ready(function() {

    // $('.file_uploader').each(function(){
    // 	model_name = $(this).attr('data-model-name');
    // 	id = $(this).attr('data-id');
    // 	model_column = $(this).attr('data-model-column');
    // 	$(this).FancyFileUpload({
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
    // });
	
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