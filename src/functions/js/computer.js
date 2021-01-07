$("#check_barcode").click(function () {
  let com_num = $("#cnum").val();
  if (com_num !== "") {
    let base_url = "../controllers/computer/SearchComputerController.php";
    $.ajax({
      method: "GET",
      url: base_url,
      data: `id=${com_num}`,
    })
      .done((response) => {
        // console.log(response);
        let data = JSON.parse(response);
        if (data.status_code === 200) {
          if (data.status_com_check > 0) {
            window.location = "?page=computer-create&cname=" + data.com_name;
          } else {
            Swal.fire({
              title: "แจ้งเตือน",
              text: data.text,
              icon: data.type,
              showConfirmButton: false,
              timer: 1500,
            });
            $("#equip").val(data.com_equip);
            $("#cname").val(data.com_name);
            $("#detail").val(data.com_detail);
          }
        } else if (data.status_code === 400) {
          Swal.fire({
            title: "แจ้งเตือน",
            text: data.text,
            icon: data.type,
          });
        }
      })
      .fail((error) => {
        console.log(error);
      });
  } else {
    Swal.fire({
      title: "แจ้งเตือน",
      text: "กรุณาใส่เลขทะเบียนคอมพิวเตอร์ที่ต้องการตรวจสอบ",
      icon: "warning",
    });
  }
});

$(".delete-computer").click(function () {
let base_url = "../controllers/computer/DeleteComputer.php";
  let data_comid = $(this).attr("data-comid");
  Swal.fire({
    title: "แจ้งเตือน",
    text: `คุณต้องการข้อมูล หมายเลขคอมพิวเตอร์ ${data_comid} ใช่หรือไม่?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: `ใช่`,
    denyButtonText: `ไม่ใช่`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        method: "GET",
        url: base_url,
        data: `id=${data_comid}`,
      })
        .done((response) => {
          let data = JSON.parse(response);
          if (data.status_code === 200) {
            Swal.fire({
              title: "แจ้งเตือน",
              text: data.text,
              icon: data.type,
            });
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          } else {
            Swal.fire({
              title: "เกิดข้อผิดพลาด !!!",
              text: data.text,
              icon: data.type,
            });
          }
        })
        .fail((error) => {
          console.log(error);
        });
    }
  });
});

$("#logout").click((e) => {
  e.preventDefault();
  Swal.fire({
    title: "คุณต้องการออกจากระบบใช่หรือไม่?",
    showCancelButton: true,
    confirmButtonText: `ใช่`,
    denyButtonText: `ไม่ใช่`,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "../controllers/logout.php";
    }
  });
});

$("#form-client").submit((event) => {
  let base_url = "../controllers/computer/ComputerController.php";
  $.ajax({
    method: "POST",
    url: base_url,
    data: $("#form-client").serialize(),
  })
    .done((response) => {
      console.log(response);
      let data = JSON.parse(response);
      if (data.status_code === 200) {
        Swal.fire({
          title: "แจ้งเตือน",
          text: data.msg,
          icon: data.type,
        });
        setTimeout(() => {
          if (data.section === "add") {
            window.location = "?page=computer-create&id=" + data.data;
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
