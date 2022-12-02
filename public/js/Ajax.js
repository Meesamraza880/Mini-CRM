// $(document).ready(function () {
//   alert("ajax is runing");
// });

// $(document).ready(function () {
//   show_users();
//   $("#myTable").DataTable();
// });

/*------Add company-------- */

$("#add_company").submit(function (evt) {
  var obj = document.getElementById("add_company");
  evt.preventDefault();
  var formData = new FormData(obj);
  formData.append("image", $("#formFile")[0].files[0]);

  $.ajax({
    url: "add_company",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      $("#co_dataTable").DataTable().ajax.reload();
      $("#add_company_msg").html(response);
      setTimeout(function () {
        $("#add_company_msg").html("");
      }, 10000);

      $("#add_company").trigger("reset");
    },
  });
});

/*------show company data-------- */
$(document).ready(function () {
  $("#co_dataTable").DataTable({
    ajax: {
      url: "show_company",
      type: "POST",
      dataSrc: "",
      data: {
        result: "show",
      },
    },

    columns: [
      {
        data: "company_id",
      },
      {
        data: "name",
      },
      {
        data: "email",
      },
      {
        data: "website",
      },
      {
        data: "status",
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a data-bs-toggle="modal" data-bs-target="#edit_company" href="javascript:void(0)" id="editbtn_' +
            data.company_id +
            '" onclick="edit(' +
            data.company_id +
            ')">Edit</a>'
          );
        },
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a href="javascript:void(0)" id="deletebtn_' +
            data.company_id +
            '" onclick="dele(' +
            data.company_id +
            ')">Delete</a>'
          );
        },
      },
    ],
  });
});

/*------Edit company data-------- */
function edit(id) {
  $.ajax({
    url: "edit_company",
    type: "POST",
    data: {
      result: "edit",
      id: id,
    },
    success: function (response) {
      $("#modal_name").val(response.name);
      $("#modal_email").val(response.email);
      // $("#formfile").val(response.logo);

      $("#modal_website").val(response.website);
      $("#modal_id").val(response.company_id);
      $("#modal_status").val(response.status);
    },
  });
}

/*------Update company data-------- */
$("#update_company").submit(function (evt) {
  var obj = document.getElementById("update_company");
  evt.preventDefault();
  var formData = new FormData(obj);
  formData.append("image", $("#formFile")[0].files[0]);

  $.ajax({
    url: "update_company",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      $("#co_dataTable").DataTable().ajax.reload();
      $("#edit_company").modal("hide");
      $("#company_table_msg").html(response);
      setTimeout(function () {
        $("#company_table_msg").html("");
      }, 10000);

      // $("#add_company").trigger("reset");
    },
  });
});

/*------Delete company-------- */
function dele(id) {
  $.ajax({
    url: "delete_company",
    type: "POST",
    data: {
      result: "delete",
      id: id,
    },
    success: function (response) {
      $("#em_Table").DataTable().ajax.reload();
      $("#co_dataTable").DataTable().ajax.reload();
    },
  });
}

/*------Add employee-------- */
$("#add_employee").submit(function (evt) {
  var obj = document.getElementById("add_employee");
  evt.preventDefault();
  var formData = new FormData(obj);

  $.ajax({
    url: "add_employee",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      // alert(response);
      $("#em_Table").DataTable().ajax.reload();
      $("#register_employee_msg").html(response);
      setTimeout(function () {
        $("#register_employee_msg").html("");
      }, 10000);

      $("#add_employee").trigger("reset");
    },
  });
});

// $(document).ready(function () {
//   $.ajax({
//     url: "show_employee",
//     type: "POST",
//     success: function (response) {
//       console.log(response);
//     },
//   });
// });

/*------Show employee Record-------- */
$(document).ready(function () {
  $("#em_Table").DataTable({
    ajax: {
      url: "show_employee",
      type: "POST",
      dataSrc: "",
      data: {
        result: "show",
      },
    },

    columns: [
      {
        data: "id",
      },
      {
        data: "name",
      },
      {
        data: "added_by",
      },
      {
        data: "first_name",
      },
      {
        data: "email",
      },
      {
        data: "phone",
      },
      {
        data: "status",
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a data-bs-toggle="modal" data-bs-target="#edit_employee_modal" href="javascript:void(0)" id="editbtn_' +
            data.id +
            '" onclick="edit_employee(' +
            data.id +
            ')">Edit</a>'
          );
        },
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a href="javascript:void(0)" id="deletebtn_' +
            data.id +
            '" onclick="dele_employee(' +
            data.id +
            ')">Delete</a>'
          );
        },
      },
    ],
  });
});

/*------Edit Employee data-------- */
function edit_employee(id) {
  $.ajax({
    url: "edit_employee",
    type: "POST",
    data: {
      result: "edit",
      id: id,
    },
    success: function (response) {
      $("#em_fname").val(response.first_name);
      $("#em_lname").val(response.last_name);
      $("#em_email").val(response.email);
      $("#em_company").val(response.company_id_fk);
      $("#em_phone").val(response.phone);
      $("#em_status").val(response.status);
      $("#em_id").val(response.id);
    },
  });
}

/*------Update Employee data-------- */
$("#update_employee").submit(function (evt) {
  var obj = document.getElementById("update_employee");
  evt.preventDefault();
  var formData = new FormData(obj);

  $.ajax({
    url: "update_employee",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      // alert(response);
      $("#em_Table").DataTable().ajax.reload();
      $("#edit_employee_modal").modal("hide");
      $("#employee_table_msg").html(response);
      setTimeout(function () {
        $("#employee_table_msg").html("");
      }, 10000);
      $("#update_employee").trigger("reset");
    },
  });
});

/*------Delete employee-------- */
function dele_employee(id) {
  $.ajax({
    url: "delete_employee",
    type: "POST",
    data: {
      result: "delete",
      id: id,
    },
    success: function (response) {
      $("#em_Table").DataTable().ajax.reload();
    },
  });
}

/*------Add employee by sub admin-------- */
$("#sub_admin_add_employee").submit(function (evt) {
  var obj = document.getElementById("sub_admin_add_employee");
  evt.preventDefault();
  var formData = new FormData(obj);

  $.ajax({
    url: "sub_admin_add_employee",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      $("#sub_admin_em_Table").DataTable().ajax.reload();
      $("#register_employee_sub_admin_msg").html(response);
      setTimeout(function () {
        $("#register_employee_sub_admin_msg").html("");
      }, 10000);

      $("#sub_admin_add_employee").trigger("reset");
    },
  });
});

/*------Show employee Record-------- */
$(document).ready(function () {
  $("#sub_admin_em_Table").DataTable({
    ajax: {
      url: "sub_admin_show_employee",
      type: "POST",
      dataSrc: "",
      data: {
        result: "show",
      },
    },

    columns: [
      {
        data: "id",
      },
      {
        data: "name",
      },
      {
        data: "added_by",
      },
      {
        data: "first_name",
      },
      {
        data: "email",
      },
      {
        data: "phone",
      },
      {
        data: "status",
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a data-bs-toggle="modal" data-bs-target="#edit_sub_admin_employee_modal" href="javascript:void(0)" id="editbtn_' +
            data.id +
            '" onclick="edit_sub_admin_employee(' +
            data.id +
            ')">Edit</a>'
          );
        },
      },
      {
        data: null,
        className: "dt-center editor-delete",
        orderable: false,
        mRender: function (data) {
          return (
            '<a href="javascript:void(0)" id="deletebtn_' +
            data.id +
            '" onclick="dele_sub_admin_employee(' +
            data.id +
            ')">Delete</a>'
          );
        },
      },
    ],
  });
});

/*------Edit Employee data-------- */
function edit_sub_admin_employee(id) {
  $.ajax({
    url: "sub_admin_edit_employee",
    type: "POST",
    data: {
      result: "edit",
      id: id,
    },
    success: function (response) {
      $("#sub_ad_em_fname").val(response.first_name);
      $("#sub_ad_em_lname").val(response.last_name);
      $("#sub_ad_em_email").val(response.email);
      $("#sub_ad_em_company").val(response.company_id_fk);
      $("#sub_ad_em_phone").val(response.phone);
      $("#sub_ad_em_status").val(response.status);
      $("#sub_ad_em_id").val(response.id);
    },
  });
}

/*------Update sub admin Employee data-------- */
$("#update_sub_employee").submit(function (evt) {
  var obj = document.getElementById("update_sub_employee");
  evt.preventDefault();
  var formData = new FormData(obj);

  $.ajax({
    url: "sub_admin_update_employee",
    method: "POST",
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    enctype: "multipart/form-data",
    processData: false,
    success: function (response) {
      // alert(response);
      $("#sub_admin_em_Table").DataTable().ajax.reload();
      $("#edit_sub_admin_employee_modal").modal("hide");
      $("#sub_admin_em_msg").html(response);
      setTimeout(function () {
        $("#sub_admin_em_msg").html("");
      }, 10000);
      $("#update_sub_employee").trigger("reset");
    },
  });
});

/*------Delete sub admin employee-------- */
function dele_sub_admin_employee(id) {
  $.ajax({
    url: "sub_admin_delete_employee",
    type: "POST",
    data: {
      result: "delete",
      id: id,
    },
    success: function (response) {
      $("#sub_admin_em_Table").DataTable().ajax.reload();
    },
  });
}
