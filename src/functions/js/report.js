let is_equip = $("#is_equip").val();
let not_equip = $("#not_equip").val();
$("#is_equip").click(function () {
  if ($(this).is(":checked")) {
    if ($("#not_equip").is(":checked")) {
      is_equip = true;
      not_equip = true;
    } else {
      is_equip = true;
      not_equip = false;
    }
  } else if ($(this).is(":not(:checked)")) {
    if ($("#not_equip").is(":checked")) {
      is_equip = false;
      not_equip = true;
    } else {
      is_equip = false;
      not_equip = false;
    }
  }
});
$("#not_equip").click(function () {
  if ($(this).is(":checked")) {
    if ($("#is_equip").is(":checked")) {
      not_equip = true;
      is_equip = true;
    } else {
      is_equip = false;
      not_equip = true;
    }
  } else if ($(this).is(":not(:checked)")) {
    if ($("#is_equip").is(":checked")) {
      not_equip = false;
      is_equip = true;
    } else {
      is_equip = false;
      not_equip = false;
    }
  }
});
// $.ajax({
//   method: "POST",
//   url: base_url,
//   data: {
//     dep_id: department,
//     is_equip: is_equip,
//     not_equip: not_equip,
//   },
// }).done((response) => {
//   console.log(response);
// });
$("#search-report").submit(function (e) {
  let base_url = "../controllers/reports/ReportController.php";
  let department = $("#department").children("option:selected").val().trim();
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
          dep_id: department,
          is_equip: is_equip,
          not_equip: not_equip,
        },
      },
      columns: [
        { data: "order" },
        { data: "dep_name" },
        { data: "count_com" },
        { data: "count_printer" },
      ],
      columnDefs: [
        {
          targets: [0, 2, 3],
          className: "dt-body-center ",
        },
      ],
    });
    let btnExport = `<a href="export_excel.php?dep_id=${department}&is_equip=${is_equip}&notequip=${not_equip}" class="btn btn-success mt-3 ml-2">
                      <i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;&nbsp;Export
                    </a>`;
    $("#export_report").html(btnExport);
    Swal.close();
  }, 1000);
  e.preventDefault();
});
