(function (jQuery) {
  "use strict";

  /*---------------------------------------------------------------------
        Tooltip
        -----------------------------------------------------------------------*/
  jQuery('[data-toggle="popover"]').popover();
  jQuery('[data-toggle="tooltip"]').tooltip();

  /*---------------------------------------------------------------------
        Fixed Nav
        -----------------------------------------------------------------------*/

  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 0) {
      $(".iq-top-navbar").addClass("fixed");
    } else {
      $(".iq-top-navbar").removeClass("fixed");
    }
  });

  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 0) {
      $(".white-bg-menu").addClass("sticky-menu");
    } else {
      $(".white-bg-menu").removeClass("sticky-menu");
    }
  });

  
  /*---------------------------------------------------------------------
        Sidebar Widget
        -----------------------------------------------------------------------*/

  jQuery(document).on("click", ".iq-menu > li > a", function () {
    jQuery(".iq-menu > li > a").parent().removeClass("active");
    jQuery(this).parent().addClass("active");
  });

  // Active menu
  var parents = jQuery("li.active").parents(".iq-submenu.collapse");

  parents.addClass("show");

  parents.parents("li").addClass("active");
  jQuery('li.active > a[aria-expanded="false"]').attr("aria-expanded", "true");

  /*---------------------------------------------------------------------
        FullScreen
        -----------------------------------------------------------------------*/
  jQuery(document).on("click", ".iq-full-screen", function () {
    let elem = jQuery(this);
    if (
      !document.fullscreenElement &&
      !document.mozFullScreenElement && // Mozilla
      !document.webkitFullscreenElement && // Webkit-Browser
      !document.msFullscreenElement
    ) {
      // MS IE ab version 11

      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen(
          Element.ALLOW_KEYBOARD_INPUT
        );
      } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen(
          Element.ALLOW_KEYBOARD_INPUT
        );
      }
    } else {
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
    }
    elem
      .find("i")
      .toggleClass("ri-fullscreen-line")
      .toggleClass("ri-fullscreen-exit-line");
  });

  /*---------------------------------------------------------------------
        Page Loader
        -----------------------------------------------------------------------*/
  jQuery("#load").fadeOut();
  jQuery("#loading").delay().fadeOut("");

  /*---------------------------------------------------------------------
        Counter
        -----------------------------------------------------------------------*/
  if (window.counterUp !== undefined) {
    const counterUp = window.counterUp["default"];
    const $counters = $(".counter");
    $counters.each(function (ignore, counter) {
      var waypoint = new Waypoint({
        element: $(this),
        handler: function () {
          counterUp(counter, {
            duration: 1000,
            delay: 10,
          });
          this.destroy();
        },
        offset: "bottom-in-view",
      });
    });
  }

  /*---------------------------------------------------------------------
        Progress Bar
        -----------------------------------------------------------------------*/
  jQuery(".iq-progress-bar > span").each(function () {
    let progressBar = jQuery(this);
    let width = jQuery(this).data("percent");
    progressBar.css({
      transition: "width 2s",
    });

    setTimeout(function () {
      progressBar.appear(function () {
        progressBar.css("width", width + "%");
      });
    }, 100);
  });

  jQuery(".progress-bar-vertical > span").each(function () {
    let progressBar = jQuery(this);
    let height = jQuery(this).data("percent");
    progressBar.css({
      transition: "height 2s",
    });
    setTimeout(function () {
      progressBar.appear(function () {
        progressBar.css("height", height + "%");
      });
    }, 100);
  });

  /*---------------------------------------------------------------------
        Page Menu
        -----------------------------------------------------------------------*/
  jQuery(document).on("click", ".wrapper-menu", function () {
    jQuery(this).toggleClass("open");
  });

  jQuery(document).on("click", ".wrapper-menu", function () {
    jQuery("body").toggleClass("sidebar-main");
  });

  /*---------------------------------------------------------------------
       Close  navbar Toggle
       -----------------------------------------------------------------------*/

  jQuery(".close-toggle").on("click", function () {
    jQuery(".h-collapse.navbar-collapse").collapse("hide");
  });

 
  /*---------------------------------------------------------------------
        user toggle
        -----------------------------------------------------------------------*/
  jQuery(document).on("click", ".iq-user-toggle", function () {
    jQuery(this).parent().addClass("show-data");
  });

  jQuery(document).on("click", ".close-data", function () {
    jQuery(".iq-user-toggle").parent().removeClass("show-data");
  });
  jQuery(document).on("click", function (event) {
    var $trigger = jQuery(".iq-user-toggle");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      jQuery(".iq-user-toggle").parent().removeClass("show-data");
    }
  });
  /*-------hide profile when scrolling--------*/
  jQuery(window).scroll(function () {
    let scroll = jQuery(window).scrollTop();
    if (
      scroll >= 10 &&
      jQuery(".iq-user-toggle").parent().hasClass("show-data")
    ) {
      jQuery(".iq-user-toggle").parent().removeClass("show-data");
    }
  });
  let Scrollbar = window.Scrollbar;
  if (jQuery(".data-scrollbar").length) {
    Scrollbar.init(document.querySelector(".data-scrollbar"), {
      continuousScrolling: false,
    });
  }

  /*---------------------------------------------------------------------
      Datatables
  -----------------------------------------------------------------------*/

  /*---------------------------------------------------------------------
        Form Validation
        -----------------------------------------------------------------------*/

  // Example starter JavaScript for disabling form submissions if there are invalid fields
  window.addEventListener(
    "load",
    function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );

  /*------------------------------------------------------------------
        Flatpicker
        * -----------------------------------------------------------------*/
  if (jQuery.fn.flatpickr !== undefined) {
    if (jQuery(".basicFlatpickr").length > 0) {
      jQuery(".basicFlatpickr").flatpickr();
    }

    if (jQuery("#inputTime").length > 0) {
      jQuery("#inputTime").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
      });
    }
    if (jQuery("#inputDatetime").length > 0) {
      jQuery("#inputDatetime").flatpickr({
        enableTime: true,
      });
    }
    if (jQuery("#inputWeek").length > 0) {
      jQuery("#inputWeek").flatpickr({
        weekNumbers: true,
      });
    }
    if (jQuery("#inline-date").length > 0) {
      jQuery("#inline-date").flatpickr({
        inline: true,
      });
    }
    if (jQuery("#inline-date1").length > 0) {
      jQuery("#inline-date1").flatpickr({
        inline: true,
      });
    }
  }

  /*---------------------------------------------------------------------
        Scrollbar
        -----------------------------------------------------------------------*/

  jQuery(window)
    .on("resize", function () {
      if (jQuery(this).width() <= 1299) {
        jQuery("#salon-scrollbar").addClass("data-scrollbar");
      } else {
        jQuery("#salon-scrollbar").removeClass("data-scrollbar");
      }
    })
    .trigger("resize");

  jQuery(".data-scrollbar").each(function () {
    var attr = $(this).attr("data-scroll");
    if (typeof attr !== typeof undefined && attr !== false) {
      let Scrollbar = window.Scrollbar;
      var a = jQuery(this).data("scroll");
      Scrollbar.init(document.querySelector('div[data-scroll= "' + a + '"]'));
    }
  });

  /*---------------------------------------------------------------------
        Pricing tab
        -----------------------------------------------------------------------*/
  jQuery(window).on("scroll", function (e) {
    // Pricing Pill Tab
    var nav = jQuery("#pricing-pills-tab");
    if (nav.length) {
      var contentNav = nav.offset().top - window.outerHeight;
      if (jQuery(window).scrollTop() >= contentNav) {
        e.preventDefault();
        jQuery("#pricing-pills-tab li a").removeClass("active");
        jQuery("#pricing-pills-tab li a[aria-selected=true]").addClass(
          "active"
        );
      }
    }
  });

  /*---------------------------------------------------------------------
        Sweet alt Delete
        -----------------------------------------------------------------------*/
  $('[data-extra-toggle="delete"]').on("click", function (e) {
    const closestElem = $(this).attr("data-closest-elem");
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-outline-primary ml-2",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        showClass: {
          popup: "animate__animated animate__zoomIn",
        },
        hideClass: {
          popup: "animate__animated animate__zoomOut",
        },
      })
      .then((willDelete) => {
        if (willDelete.isConfirmed) {
          swalWithBootstrapButtons
            .fire({
              title: "Deleted!",
              text: "Your note has been deleted.",
              icon: "success",
              showClass: {
                popup: "animate__animated animate__zoomIn",
              },
              hideClass: {
                popup: "animate__animated animate__zoomOut",
              },
            })
            .then(() => {
              if (closestElem == ".card") {
                $(this).closest(closestElem).parent().remove();
              } else {
                $(this).closest(closestElem).remove();
              }
            });
        } else {
          swalWithBootstrapButtons.fire({
            title: "Your note is safe!",
            showClass: {
              popup: "animate__animated animate__zoomIn",
            },
            hideClass: {
              popup: "animate__animated animate__zoomOut",
            },
          });
        }
      });
  });

  if ($.fn.slick !== undefined && $(".top-product").length > 0) {
    jQuery(".top-product").slick({
      slidesToShow: 3,
      speed: 300,
      slidesToScroll: 1,
      focusOnSelect: true,
      autoplay: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            autoplay: true,
            slidesToShow: 1,
          },
        },
      ],
    });
  }

  
  $(document).ready(function() {
    // Update Status Based on Quantity
    $('#quantityInput').on('input', function() {
        var quantity = $(this).val();
        var statusElement = $('#stockStatus');

        if (quantity == 0) {
            statusElement.text('Out of Stock').removeClass('badge-success badge-warning').addClass('badge-danger');
        } else if (quantity > 0 && quantity <= 10) {
            statusElement.text('Low in Stock').removeClass('badge-success badge-danger').addClass('badge-warning');
        } else {
            statusElement.text('In Stock').removeClass('badge-danger badge-warning').addClass('badge-success');
        }
    });

    // Show the confirmation modal and set the row to delete
    window.showDeleteConfirmation = function(element) {
        rowToDelete = $(element).closest('tr');
        $('#deleteConfirmationModal').modal('show');
    };

    // Confirm deletion
    $('#confirmDelete').on('click', function() {
        if (rowToDelete) {
            rowToDelete.remove();
            $('#deleteConfirmationModal').modal('hide');
        }
    });
});

window.deleteRow = function(btn) {
  $(btn).closest('tr').remove();
};

//Purchase Order Table

$(document).ready(function() {
  // Function to show dropdown menu
  $(document).on('click focus', '.dropdown-input', function() {
      var $input = $(this);
      var $dropdownMenu = $('.product-dropdown-menu');

      // Position the dropdown menu
      $dropdownMenu.css({
          top: $input.offset().top + $input.outerHeight(), // Position below the input
          left: $input.offset().left,
          width: $input.outerWidth()
      }).slideDown();

      // Store reference to the current row or input inside modal
      $input.closest('.product-row').data('dropdown-input', $input);
  });

  // Hide dropdown menu when clicking outside
  $(document).on('click', function(event) {
      if (!$(event.target).closest('.dropdown-container').length) {
          $('.product-dropdown-menu').slideUp();
      }
  });

  // Handle dropdown item click
  $(document).on('click', '.product-dropdown-menu .dropdown-item', function(e) {
      e.preventDefault(); // Prevent default link behavior

      var selectedProduct = $(this).data('product');
      var productDetails = $(this).data('details');

      // Get the current row from the stored reference
      var $row = $('.product-dropdown-menu').data('currentRow');

      // Update the input and details in the appropriate row
      if ($row && $row.length) {
          $row.find('.dropdown-input').val(selectedProduct);
          $row.find('.product-details').val(productDetails);
      }

      // Hide the dropdown menu
      $('.product-dropdown-menu').slideUp();
  });

  // Search filter in dropdown menu
  $(document).on('input', '.dropdown-input', function() {
      var searchValue = $(this).val().toLowerCase();
      $('.product-dropdown-menu .dropdown-item').each(function() {
          var itemText = $(this).text().toLowerCase();
          if (itemText.includes(searchValue)) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
  });

  // Handle Enter key press to select product
  $(document).on('keypress', '.dropdown-input', function(e) {
      if (e.which === 13) { // Enter key
          e.preventDefault();
          var $row = $(this).closest('.product-row');
          var selectedProduct = $('.product-dropdown-menu .dropdown-item:visible').first();

          if (selectedProduct.length) {
              var productText = selectedProduct.data('product');
              var productDetails = selectedProduct.data('details');

              $row.find('.dropdown-input').val(productText);
              $row.find('.product-details').val(productDetails);

              $('.product-dropdown-menu').slideUp();
          }
      }
  });

  // Function to add a new row
  $('#add-row').on('click', function() {
      var newRow = `
          <tr class="product-row">
              <td>
                  <div class="dropdown-container">
                      <input class="form-control dropdown-input" type="text" placeholder="Type or click to select an item.">
                  </div>
              </td>
              <td>
                  <input class="form-control product-details" type="text">
              </td>
              <td>
                  <input class="form-control product-details" type="text">
              </td>
              <td>
                
              </td>
              <td>
                  <button type="button" class="close" aria-label="Close" href="javascript:void(0);" onclick="deleteRow(this);">
                      <span aria-hidden="true">×</span>
                  </button>
              </td>
          </tr>
      `;
      // Append new row to the table
      $('.table tbody').append(newRow);
  });

  // Store the reference to the current row when dropdown input is focused
  $(document).on('focus', '.dropdown-input', function() {
      var $row = $(this).closest('.product-row');
      $('.product-dropdown-menu').data('currentRow', $row);
  });
});


// Actual Date

$(document).ready(function() {
  // Automatically set the current date in the input with id 'currentDate'
  var today = new Date();
  var year = today.getFullYear();
  var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so we add 1
  var day = String(today.getDate()).padStart(2, '0');
  var formattedDate = year + '-' + month + '-' + day;
  $('#currentDate').val(formattedDate);

  // Checkbox functionality to check/uncheck all checkboxes in the table
  $('#checkbox1').change(function() {
      $('tbody input[type="checkbox"]').prop('checked', this.checked);
  });
});




// Change Image Product 
$(document).ready(function() {
  $('#productImage').on('change', function(event) {
      var reader = new FileReader();
      reader.onload = function(e) {
          $('#productImagePreview').attr('src', e.target.result);
      }
      reader.readAsDataURL(event.target.files[0]); // Read the file and convert it to a Data URL
  });
});


//Edit Table In Price List

$(document).ready(function() {
  $('#edit-toggle').click(function() {
      const isEditing = $(this).text().includes('Edit');
      $(this).text(isEditing ? 'Save Table' : 'Edit Table');
      
      // Toggle contentEditable for cells
      $('.editable').each(function() {
          $(this).attr('contenteditable', isEditing);
          $(this).toggleClass('border', isEditing);
      });
      
      // Show or hide save button
      $('#save-section').toggle(isEditing);
  });

  $('#save-changes').click(function() {
      // Implement your save logic here
      alert('Changes saved!');
  });
});


// Upload Excel





})(jQuery);


