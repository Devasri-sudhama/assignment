$(document).ready(function () {
  var page = 1;
  var current_page = 1;
  var total_page = 0;
  var is_ajax_fire = 0;
  $("#search").keyup(function () {
    if ($(this).val().length != 0) {
      search();
      // return true;
    } else {
      manageData();
    }
  });
  manageData();

  /* manage data list */
  function manageData() {
    var search = $(".search").val();
    if (search == "") {
      $.ajax({
        dataType: "json",
        url: url + "api/getData.php",
        data: { page: page },
      })
        .done(function (data) {
          total_page = Math.ceil(data.total / 5);
          current_page = page;
          // $("#pagination").html(data);
          //   for (var i = 1; i <= total_page+1; i++) {
          //     $('#pagination').append($('<button type="button" class="btn btn-success pagination" id="page">'+i+'</button>'));
          //   }
          //   for(var i=0;i<total_page;I++){
          // $("#pagination").append("<li >1</li>");
          // $('#pagination').append('<div id="innerDiv"></div>');
          // Pagination();

          //   $("#pagination").Pagination({
          //     totalPages: total_page,
          //     visiblePages: current_page,
          //     onPageClick: function (event, pageL) {
          //       page = pageL;
          //       if (is_ajax_fire != 0) {
          //         getPageData();
          //       }
          //     },
          //   });
          // console.log("data "+data);
          // if (data.data == "") {

          //   return false;
          // }
          $("#pagination").show();
          $("#norecords").hide();
          manageRow(data.data);
          is_ajax_fire = 1;
          pages = "";
          for (var i = 1; i <= total_page; i++) {
            pages =
              pages +
              '<span><li><button href="#" id="page" class="page btn btn-primary">' +
              i +
              "</button></li></span>";
          }
          $("#pagination").html(pages);
        })
        .fail(function (data) {
          $("#norecords").show();
          $("#pagination").hide();
        });
    } else {
      // $("#pagination").remove();
      $.ajax({
        dataType: "json",
        url: url + "api/getSearchData.php",
        data: { search: search },
      })
        .done(function (data) {
          // alert(data);
          total_page = Math.ceil(data.total / 5);
          current_page = page;
          manageRow(data.data);
          is_ajax_fire = 1;
          searchPages = "";

          $("#pagination").show();

          for (var i = 1; i <= total_page; i++) {
            searchPages =
              searchPages +
              '<span><li><button href="#" id="page" class="page btn btn-primary">' +
              i +
              "</button></li></span>";
          }
          $("#pagination").show();
          // $("#searchPagination").html(searchPages);
        })
        .fail(function (data) {
          $("#norecords").show();
          $("#pagination").hide();
          // $("#searchPagination").hide();
        });
    }
  }
  $(document).ready(function () {
    //Hide Loading Image
    function Hide_Load() {
      $("#loading").fadeOut("slow");
    }
    //Default Starting Page Results
    $("#pagination li:first").css({ color: "#FF0084" }).css({ border: "none" });
    $("#content").load("dashboard.php?page=1", Hide_Load());
    //Pagination Click
    $("#pagination li").click(function () {
      //CSS Styles
      $("#pagination li")
        .css({ border: "solid #dddddd 1px" })
        .css({ color: "#0063DC" });
      $(this).css({ color: "#FF0084" }).css({ border: "none" });
      //Loading Data
      var pageNum = this.id;
      $("#content").load("pagination_data.php?page=" + pageNum, Hide_Load());
    });
  });
  /* Get Page Data*/
  function getPageData() {
    $.ajax({
      dataType: "json",
      url: url + "api/getData.php",
      data: { page: page },
    }).done(function (data) {
      console.log(data);
      manageRow(data.data);
    });
  }
  $("body").on("click", ".page", function (e) {
    // $(".page").on("click", function (e) {
    e.preventDefault();
    var page = $(this).closest("li").find("#page").html();
    var search = $(".search").val();
    if (search == "") {
      $.ajax({
        dataType: "json",
        url: url + "api/getData.php",
        type: "GET",
        data: {
          page: page,
        },
      }).done(function (data) {
        console.log(data);
        manageRow(data.data);
        // getPageData();
      });
    } else {
      $.ajax({
        dataType: "json",
        url: url + "api/getSearchData.php",
        type: "GET",
        data: {
          page: page,
          search: search,
        },
      }).done(function (data) {
        console.log(data);
        // getPageData();
        manageData();
        // manageRow(data.data);
        // man
        // getPageData();
      });
    }
  });

  /* Search */
  // $("body").on("click", "#search-btn", function (e) {
  function search() {
    // $(".page").on("click", function (e) {
    // e.preventDefault();
    // $("#pagination").hide();
    var search = $(".search").val();
    if (search == "") {
      return false;
    } else {
      $.ajax({
        dataType: "json",
        url: url + "api/getSearchData.php",
        type: "GET",
        data: {
          search: search,
        },
      })
        .done(function (data) {
          // if(data){
          // console.log(data);

          // console.log("data+ if"+data);
          // alert("helo " + data);
          // $("#norecords").show();
          // return false;
          // } else {
          // alert("else " + data);
          $("#norecords").hide();

          manageRow(data.data);
          manageData();

          // }
          // }else{
          // console.log("error");
          // }
          // getPageData();
        })
        .fail(function (data) {
          // alert("Try again champ!");
          $("#norecords").show();
          $("#pagination").hide();
          manageRow(data.data);
        });
    }
  }

  /* Add new Item table row */
  function manageRow(data) {
    var rows = "";
    $.each(data, function (key, value) {
      rows = rows + "<tr>";
      rows = rows + "<td data-id='" + value.id + "'>" + value.id + "</td>";
      rows = rows + "<td data-id='" + value.name + "'>" + value.name + "</td>";
      rows =
        rows + "<td data-role='" + value.role + "'>" + value.role + "</td>";
      rows =
        rows + "<td data-email='" + value.email + "'>" + value.email + "</td>";
      rows =
        rows +
        "<td data-mobile='" +
        value.mobile +
        "'>" +
        value.mobile +
        "</td>";
      rows =
        rows +
        "<td data-address='" +
        value.address +
        "'>" +
        value.address +
        "</td>";
      rows =
        rows +
        "<td data-profilepicture='" +
        value.profilepicture +
        "'><img src=" +
        value.profilepicture +
        " width='100px' height='50px'></td>";
      rows =
        rows +
        "<td data-dateofbirth='" +
        value.status +
        "'>" +
        value.dateofbirth +
        "</td>";
      rows =
        rows +
        "<td data-status='" +
        value.status +
        "'>" +
        value.status +
        "</td>";
      rows =
        rows +
        "<td data-creationdate='" +
        value.creationdate +
        "'>" +
        value.creationdate +
        "</td>";
      rows =
        rows +
        "<td data-last_updated_by='" +
        value.last_updated_by +
        "'>" +
        value.last_updated_by +
        "</td>";
      rows = rows + '<td data-id="' + value.id + '">';
      // alert(value.status);
      if (value.status == "0") {
        rows =
          rows +
          '<button class="btn btn-success approve-item" data-approve="approve"><span class="glyphicon glyphicon-ok-circle "></button></span>';
      }
      rows =
        rows +
        '<a data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item"> <span class="glyphicon glyphicon-pencil"></span></a> ';
      rows =
        rows +
        '<button class="btn btn-danger remove-item"><span class="glyphicon glyphicon-trash"></span></button>';

      rows = rows + "</td>";
      rows = rows + "</tr>";
    });
    $("tbody").html(rows);
  }


  // reset form after modal close
  $('#create-item').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
    $(this).find('#preview').html("");
    $(this).find('#preview').html("");
  })



  /* Create new Item */
  $(".crud-submit").click(function (e) {
    e.preventDefault();
    // var form_action = $("#create-item").find("form").attr("action");
    // var title = $("#create-item").find("input[name='title']").val();
    // var description = $("#create-item")
    //   .find("textarea[name='description']")
    //   .val();
    // $("#create-item").find("#profilepicture").attr("src"," ");
    // $("#profilePicture").attr("src"," ");
    var name = $("#name").val();
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var address = $("#address").val();
    var gender = $('input[name="gender"]:checked').val();
    var dateofbirth = $("#dateofbirth").val();
    var profile = $("#profilePicture").attr("src");
    var password = name + dateofbirth;
    if (
      name != "" &&
      mobile != "" &&
      email != "" &&
      address != "" &&
      gender != "" &&
      dateofbirth != "" &&
      profile != ""
    ) {
      $.ajax({
        dataType: "json",
        type: "POST",
        url: url + "api/register.php",
        data: {
          name: name,
          mobile: mobile,
          email: email,
          address: address,
          gender: gender,
          dateofbirth: dateofbirth,
          profile: profile,
          password: password,
        },
      })
        .done(function (data) {
          if (data.statusCode == 201) {
            $("#error").show();
            $("#error").html("Email Id Already Exists");
            // alert("EmailId Already Exists");
            return false;
            // alert("Invalid Details");
          } else {
            $("#success").show();
            $("#success").html("User Added");
          }
          $("#name").val("");
          $("#mobile").val("");
          $("#email").val("");
          $("#address").val("");
          $("#gender").prop("checked", false);
          $("#dateofbirth").val("");
          $("#profilePicture").attr("src","");
          getPageData();
          $(".modal").modal("hide");
          // alert("User Added");
          toastr.success("Item Created Successfully.", "Success Alert", {
            timeOut: 5000,
          });
        })
        /* .fail(function (data) {
          // $("#norecords").show();
          // $("#pagination").hide ();
          alert("Internal Server Error");
        }); */
    } else {
      alert("Please Fill All Fields");
    }
  });

  /* Remove Item */
  $("body").on("click", ".remove-item", function () {
    var id = $(this).parent("td").data("id");
    // var c_obj = $(this).parent("tr").data("approval");
    var c_obj = $(this).parents("tr");
    $.ajax({
      dataType: "json",
      type: "POST",
      url: url + "api/delete.php",
      data: { id: id },
    }).done(function (data) {
      c_obj.remove();

      toastr.success("Item Deleted Successfully.", "Success Alert", {
        timeOut: 5000,
      });
      getPageData();
    });
  });
  $("#edit-item").find("#fileToUpload-edit").change(function () {
    imagePreviewEdit(this);
  });

  /* Edit Item */
  $("body").on("click", ".edit-item", function () {
    var id = $(this).parent("td").data("id");
    // var name = $(this).parent("tr").data("name");
    // var mobile = $(this).parent("td").data("mobile");
    // var dateofbirth = $(this).parent("td").data("dateofbirth");
    // var address = $(this).parent("td").data("address");
    // alert(name);
    // alert(mobile);
    // var id = $(this).parent("td").data("id");
    // var id = $(this).parent("td").data("id");
    // alert(id);
    var title = $(this).parent("td").prev("td").prev("td").text();
    // alert(title);
    var currentRow = $(this).closest("tr");
    var id = currentRow.find("td:eq(0)").text();
    var name = currentRow.find("td:eq(1)").text();
    var role = currentRow.find("td:eq(2)").text();
    var email = currentRow.find("td:eq(3)").text();
    var mobile = currentRow.find("td:eq(4)").text();
    var address = currentRow.find("td:eq(5)").text();
    var profilePicture = currentRow.find("img").attr("src");

    //  var profilePicture=currentRow.find("td:eq(6)").attr('src');
    var dateofbirth = currentRow.find("td:eq(7)").text();
    var status = currentRow.find("td:eq(8)").text();
    // var description = $(this).parent("td").prev("td").text();
    // alert(col1);
    // var name = $(this).parent("td").closest("tr").text()
    // var name = $(this).parent("tr").prev("td").prev("td").val();
    // alert(name);
    $("#edit-item").find("#name").val(name);
    $("#edit-item").find("#mobile").val(mobile);
    $("#edit-item").find("#email").val(email);
    $("#edit-item").find("#role").val(role);
    $("#edit-item").find("#address").val(address);
    
    $("#edit-item").find("#status").val(status);
    $("#edit-item").find("#profilepicture").attr("src",'');
    $("#edit-item").find("#preview").show();
    $("#edit-item").find("#profile").attr("src", profilePicture);

    // imagePreview(this);

    $("#edit-item").find("#dateofbirth").val(dateofbirth);
    //  $('input[name="gender"]:checked').val();
    $("#edit-item").find("#dateofbirth").val();

    // $("#edit-item").find("input[name='title']").val(title);
    // $("#edit-item").find("textarea[name='description']").val(description);
    $("#edit-item").find(".edit-id").val(id);
  });

  /* Admin Approval */
  $("body").on("click", ".approve-item", function () {
    var id = $(this).parent("td").data("id");
    alert(id);
    // var c_obj = $(this).parent("td").data("approve");
    $.ajax({
      dataType: "json",
      type: "POST",
      url: url + "api/approval.php",
      data: { id: id },
    }).done(function (data) {
      // c_obj.off();
      $(".approve-item").remove();
      // $("#myButton").off('click')
      // toastr.success("Item Deleted Successfully.", "Success Alert", {
      //   timeOut: 5000,
      // });
      getPageData();
    });
  });

  /* Updated new Item */
  $(".crud-submit-edit").click(function (e) {
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    // var id = $(this).parent("td").data("id");
    // var title = $(this).parent("td").prev("td").prev("td").text();
    // var description = $(this).parent("td").prev("td").text();
    var name = $("#edit-item").find("#name").val();
    var mobile = $("#edit-item").find("#mobile").val();
    var email = $("#edit-item").find("#email").val();
    var address = $("#edit-item").find("#address").val();
    var gender = $("#edit-item").find('input[name="gender"]:checked').val();
    var dateofbirth = $("#edit-item").find("#dateofbirth").val();
    var profile = $("#edit-item").find("#profilePicture1").attr("src");
    var id = $("#edit-item").find(".edit-id").val();
    // $("#fileToUpload").change(function () {
    //   imagePreview(this);
    // });

    if (
      name != "" &&
      mobile != "" &&
      email != "" &&
      address != "" &&
      gender != "" &&
      dateofbirth != "" &&
      profile != ""
    ) {
      $.ajax({
        dataType: "json",
        type: "POST",
        url: url + form_action,
        data: {
          name: name,
          mobile: mobile,
          email: email,
          address: address,
          gender: gender,
          dateofbirth: dateofbirth,
          profile: profile,
          id: id,
        },
      }).done(function (data) {
        $("#name").val("");
        $("#mobile").val("");
        $("#email").val("");
        $("#address").val("");
        $("#gender").prop("checked", false);
        $("#dateofbirth").val("");
        $("#edit-item").find("#profilepicture").attr("src",'');
        getPageData();
        $(".modal").modal("hide");
        
        toastr.success("Item Updated Successfully.", "Success Alert", {
          timeOut: 5000,
        });
      });
    } else {
      alert("You are missing title or description.");
    }
  });
  $("#success").hide();
  $("#login-error").hide();
  $("#error").hide();
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function (event) {
        $("#preview").html(
          '<img src="' +
            event.target.result +
            '" id="profilePicture" width="300" height="auto"/>'
        );
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }

  function imagePreviewEdit(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function (event) {
        $("#preview1").html(
          '<img src="' +
            event.target.result +
            '" id="profilePicture1" width="300" height="auto"/>'
        );
        $("#profile").remove();
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }
  $("#fileToUpload").change(function () {
    imagePreview(this);
  });
  $("#fileToUpload-edit").change(function () {
    imagePreviewEdit(this);
  });

  $("#login-error").hide();
  $("#login").on("click", function (e) {
    // e.stopPropagation();
    // e.stopPropagation();
    e.preventDefault();

    var email = $("#email").val();

    var password = $("#password").val();

    if (email != "" && password != "") {
      $.ajax({
        url: url + "api/login.php",
        type: "POST",
        data: {
          email: email,
          password: password,
        },
        cache: false,
        success: function (dataResult) {
          console.log(JSON.parse(JSON.stringify(dataResult)));
          dataResult = dataResult.replace(/\\/g, "");
          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            location.replace(url + "dashboard.php");
            // return false;
          } else {
            $("#login-error").show();
            $("#login-error").html(dataResult.msg);
            // alert("Invalid Details");
          }
        },
      });
    }
  });

  /* register */

  $("#register").on("click", function (e) {
    // e.stopPropagation();
    // e.stopPropagation();
    $("#error").hide();
    $("#success").hide();
    e.preventDefault();

    var name = $("#name").val();
    var email = $("#email").val();

    var mobile = $("#mobile").val();
    var password = $("#password").val();

    var dateofbirth = $("#dateofbirth").val();
    var address = $("#address").val();
    var profile = $("#profilePicture").val();
    var gender = $('input[name="gender"]:checked').val();

    if (
      name != "" &&
      email != "" &&
      mobile != "" &&
      password != "" &&
      dateofbirth != "" &&
      address != "" &&
      gender != "" &&
      password != "" &&
      profile != ""
    ) {
      $.ajax({
        url: url + "api/register.php",
        type: "POST",
        data: {
          name: name,
          email: email,
          mobile: mobile,
          password: password,
          dateofbirth: dateofbirth,
          address: address,
          gender: gender,
          password: password,
          profile: profile,
        },
        cache: false,
        success: function (dataResult) {
          console.log(JSON.parse(JSON.stringify(dataResult)));
          dataResult = dataResult.replace(/\\/g, "");
          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            $("#success").show();
            $("#success").html(
              "Registration has been completed Successfully! Needs to be approved by Admin"
            );
            $("#name").val("");
            $("#password").val("");
            // $("#role").val('');
            $("#mobile").val("");
            $("#email").val("");
            $("#address").val("");
            $("#gender").prop("checked", false);
            $("#dateofbirth").val("");
            // location.replace(url + "index.php");
            // return false;
          } else if (dataResult.statusCode == 201) {
            $("#error").show();
            $("#error").html("Email Id Already Exists");
            // alert("Invalid Details");
          }
        },
      });
    }
  });

  $("#logout").click(function () {
    $.ajax({
      url: url + "logout.php",
      success: function (data) {
        location.replace("http://localhost/systemTask/index.php");
      },
    });
  });
});
