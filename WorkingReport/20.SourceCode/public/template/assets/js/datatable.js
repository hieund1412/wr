$('#user-table').DataTable({
    // Config mặc định của dataTable
    responsive: true,
    "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
    "oLanguage": {
        "oPaginate": {
            "sPrevious": "<",
            "sNext": ">"
        },
        "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
        "sInfoEmpty": "0 có kết quả",
        "sLengthMenu": "_MENU_",
        "sSearch": ""
    }
    //Hàm init complete thêm form lọc trạng thái.
});