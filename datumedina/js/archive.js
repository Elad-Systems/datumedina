jQuery(function($){
	$('#fold').on('hidden.bs.collapse', function () {
	 $('#archive_read_more').html(archiveparam.archivemore)

	})
	$('#fold').on('shown.bs.collapse	', function () {
	 $('#archive_read_more').html(archiveparam.archiveless)
	})
});