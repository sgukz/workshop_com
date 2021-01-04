$("#check-search-report").click(function (e) {
  let selectedDept = $("#department").children("option:selected").val().trim();
  let base_url = "../controllers/reports/ReportController.php";
  Swal.fire({
    title: '<div class="lds-dual-ring"></div>',
    html: '<strong class="text-primary">กำลังประมวลผล...</strong>',
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
  setTimeout(() => {
    $("#show-data-report").DataTable({
      language: {
        info: "แสดงทั้งหมด _TOTAL_ เร็คคอร์ด",
        emptyTable: "ไม่มีข้อมูล...",
        loadingRecords: "กำลังโหลด...",
        processing: "กำลังประมวลผล...",
        infoEmpty: "แสดง 0 เร็คคอร์ด",
      },
      processing: true,
      serverSide: true,
      searching: false,
      info: true,
      paging: false,
      ordering: false,
      destroy: true,
      ajax: {
        url: base_url,
        type: "POST",
        data: {
          dep_id: selectedDept,
        },
      },
      columns: [{ data: "order" }, { data: "dep_name" }, { data: "count_com" }, { data: "count_printer" }],
      columnDefs: [
        {
          targets: [0, 2, 3],
          className: "dt-body-center ",
        },
      ],
    });
    let btnExport = `<a href="export_excel.php?dep_id=${selectedDept}" class="btn btn-success mt-3 ml-2">
                      <i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;&nbsp;Export
                    </a>`;
    $("#export_report").html(btnExport);
    Swal.close();
  }, 1000);
  e.preventDefault();
  // $.ajax({
  //   method: "POST",
  //   url: base_url,
  //   data: {
  //     dep_id: selectedDept,
  //   },
  // })
  //   .done((resp) => {
  //     // let data = JSON.parse(resp);
  //     console.log(resp);
  //   })
  //   .fail((error) => {
  //     console.log(error);
  //   });
});
