$(document).ready(function() {

    livewire.on('close_modal', message => {

        $(".modal").modal('hide');
        show_message(message);
    })

    livewire.on('show_message', message => {

        show_message(message);
    })

    livewire.on('next_step', step_id => {

    var e = $('#'+step_id).attr('id');
    return $("a[href=\\#"+e+"]").tab("show");

    })

    $('.editor').each(function(){

    	id = $(this).attr('id');
    	var quill = new Quill('#'+id, {
    		theme: 'snow'
  		});
    })
    

    $('.file_uploader').each(function(){
    	model_name = $(this).attr('data-model-name');
    	id = $(this).attr('data-id');
    	model_column = $(this).attr('data-model-column');
    	$(this).FancyFileUpload({
		url: "/upload_file",
		params : {
			_token : $('#token').val(),
			'model_name' : model_name,
			'model_column' : model_column,
			'id' : id
		},
		'maxfilesize' : -1,
		added: function(e,data)
		{
			console.log(e);
			console.log(data);
		}

	});
    })
	
})
	


function show_message(message)
{
	Swal.fire({
		  title: '',
		  text: message,
		  icon: 'success',
		  showConfirmButton :false,
		  timer: 3000,
		})
}

$(document).on('click','#plus',function(){
	input = $(this).parent('.counter_container').find('input');
	input.val(input.val()*1 + 1);
	function_name = input.attr('function_name');
	livewire.emit(function_name, input.val()*1 + 1);
})
$(document).on('click','#minus',function(){
	input = $(this).parent('.counter_container').find('input');
	if (input.val() > 0) {
		input.val(input.val()*1 - 1);
		livewire.emit(function_name, input.val()*1 - 1)
	}
	
})

$(document).on('click','.previous',function(){

    var e = $(this).parents('.tab-pane').prev().attr('id');
    return $("a[href=\\#"+e+"]").tab("show");
})

$(document).on('click','.add_editor_content_before_save',function(){
	var quill = $('#'+$(this).attr('data-editor-id'));
	var delta = quill.find('.ql-editor').html();
	function_name = $(this).attr('data-function-name');
	console.log(function_name);
	livewire.emit(function_name, delta);
	$(this).parent().find('.'+$(this).attr('data-save-class')).click();
})


