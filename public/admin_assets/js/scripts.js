let config = {
	ordering: false,
	language: {
		url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/ru.json'
	}
};

$(document).ready(function() {
	$('#datatable').DataTable(config);

	$(document).ready(function() {
		$('.datatable').DataTable(config);
	});

});


//flash messages
$('div.alert').not('.alert-danger').not('.alert-info').delay(3000).fadeOut(350);


//ajax setup
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

//destroy form modal
function destroy(formID, id) {
	Swal.fire({
		title: 'Вы уверены?',
		text: "Это действие нельзя будет отменить!",
		icon: 'error',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Да удалить!',
		cancelButtonText: 'Отмена'
	}).then((result) => {
		if (result.isConfirmed) {
			let form = document.querySelector(formID + id);
			form.submit();
		}
	})
}
