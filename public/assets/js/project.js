$(document).ready(function() {
    $(".project_type").select2({
        tags: true,
        dropdownParent: $("#create_project"),
        placeholder: 'اختر او اضف نوع المشروع',
    });

    $(".add_agent_select").select2({
        tags: true,
        dropdownParent: $("#Create_Group"),
        placeholder: 'اختر او اضف نوع المشروع',
    });

})

$(document).on('change','.project_type', function(e) {
    livewire.emit('selectedProjectType', e.target.value)
});

$(document).on('change','.add_agent_select', function(e) {
    // $('.agent_count').val($(this).find(':selected').attr('data-count'));
    livewire.emit('selectedAgentId', e.target.value)
});





