(function ($) {
  "use strict";

  $(function () {
    if ($("#tbl-list-books").length > 0) {
      $("#tbl-list-books").DataTable();
    }

    if ($("#tbl-list-book-shelf").length > 0) {
      $("#tbl-list-book-shelf").DataTable();
    }

    $(document).on("click", "#txt_image", function () {
      var image = wp
        .media({
          title: "Upload Book Image",
          multiple: false,
        })
        .open()
        .on("select", function (e) {
          var uploaded_image = image.state().get("selection").first();
          var image_url = uploaded_image.toJSON().url;
          $("#img-preview").attr("src", image_url);
          $("#book_cover_image").val(image_url);
        });
    });
  });
  $(function () {
    $(document).on("click", ".btn-delete-book-shelf", function () {
      var book_shelf_id = $(this).data("id");
      var postdata = {
        action: "admin_ajax_request",
        param: "delete_book_shelf",
        nonce: bmt_books.nonce,
        book_shelf_id: book_shelf_id,
      };

      if (confirm("Are you sure you want to delete this book shelf?")) {
        $.post(ajaxurl, postdata, function (response) {
          var data = JSON.parse(response);

          if (data.status == 1) {
            alert(data.message);
            setTimeout(function () {
              location.reload();
            }, 1000);
          }
        });
      }
    });

    $(document).on("click", ".btn-delete-book", function () {
      var book_id = $(this).data("id");
      var postdata = {
        action: "admin_ajax_request",
        param: "delete_book",
        nonce: bmt_books.nonce,
        book_id: book_id,
      };

      if (confirm("Are you sure you want to delete this book?")) {
        $.post(ajaxurl, postdata, function (response) {
          var data = JSON.parse(response);

          if (data.status == 1) {
            alert(data.message);
            setTimeout(function () {
              location.reload();
            }, 1000);
          }
        });
      }
    });
  });
  $(function () {
    $("#frm-add-book-shelf").validate({
      submitHandler: function () {
        var postdata = $("#frm-add-book-shelf").serialize();

        postdata +=
          "&action=admin_ajax_request&param=create_book_shelf&nonce=" +
          bmt_books.nonce;

        $.post(ajaxurl, postdata, function (response) {
          var data = JSON.parse(response);

          if (data.status == 1) {
            alert(data.message);
            setTimeout(function () {
              location.reload();
            }, 1000);
          }
        });
      },
    });

    $("#frm-create-book").validate({
      submitHandler: function () {
        var postdata = $("#frm-create-book").serialize();

        postdata +=
          "&action=admin_ajax_request&param=create_book&nonce=" +
          bmt_books.nonce;

        $.post(ajaxurl, postdata, function (response) {
          var data = JSON.parse(response);

          if (data.status == 1) {
            alert(data.message);
            setTimeout(function () {
              location.reload();
            }, 1000);
          }
        });
      },
    });
  });
})(jQuery);
