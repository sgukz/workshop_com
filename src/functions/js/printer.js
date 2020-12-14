$("#check_printer").click(function () {
  let printer_number = $("#pnum").val();
  if (printer_number !== "") {
    let base_url = "../controllers/printer/SearchPrinterController.php";
    $.ajax({
      method: "GET",
      url: base_url,
      data: `id=${printer_number}`,
    })
      .done((response) => {
        // console.log(response);
        let data = JSON.parse(response);
        if (data.status_code === 200) {
          if (data.status_printer_check > 0) {
            window.location =
              "?page=main-printer&pcode=" + data.printer_barcode;
          } else {
            Swal.fire({
              title: data.text,
              icon: data.type,
              showConfirmButton: false,
              timer: 1500,
            });
            $("#p_equip").val(data.printer_sn);
            $("#pmodel").val(data.printer_name);
            $("#p_detail").val(data.printer_detail);
          }
        } else if (data.status_code === 400) {
          Swal.fire({
            title: "แจ้งเตือน",
            text: data.text,
            icon: data.type,
          });
        }
      })
      .fail((error) => console.log(error));
  } else {
    Swal.fire({
      title: "แจ้งเตือน",
      text: "กรุณาใส่เลขทะเบียนปริ้นเตอร์ที่ต้องการตรวจสอบ",
      icon: "warning",
    });
  }
});

$("#form-printer").submit((event) => {
    let base_url = "../controllers/printer/PrinterController.php";
    $.ajax({
      method: "POST",
      url: base_url,
      data: $("#form-printer").serialize(),
    })
      .done((response) => {
        let data = JSON.parse(response);
        if (data.status_code === 200) {
          Swal.fire({
            title: "แจ้งเตือน",
            text: data.msg,
            icon: data.type,
          });
          setTimeout(() => {
            if (data.section === "add") {
              window.location = "?page=main-printer&pcode=" + data.printer_barcode;
            } else if (data.section === "update") {
              window.location.reload();
            }
          }, 2000);
        } else {
          Swal.fire({
            title: "แจ้งเตือน",
            text: data.text,
            icon: data.type,
          });
        }
      })
      .fail((error) => {
        console.log(JSON.parse(error));
      });
    event.preventDefault();
  });
