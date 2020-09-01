/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
var dataListView;
$(document).ready(function() {
    "use strict"
    // init list view datatable
    dataListView = $(".data-thumb-view").DataTable({
        responsive: false,
        columnDefs: [{
            orderable: true,
            targets: 0,
            checkboxes: { selectRow: true },
            visible: false
        }],
        dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
        oLanguage: {
            sLengthMenu: "_MENU_",
            sSearch: ""
        },
        aLengthMenu: [
            [4, 10, 15, 20],
            [4, 10, 15, 20]
        ],
        select: {
            style: "multi"
        },
        order: [
            [1, "desc"]
        ],
        bInfo: false,
        pageLength: 4,
        buttons: [{
            text: "<i class='feather icon-plus'></i> Add New",
            action: function() {
                $(this).removeClass("btn-secondary")
                $(".add-new-data").addClass("show")
                $(".overlay-bg").addClass("show")
                $("#data-name, #data-price").val("")
                $("#data-category, #data-status").prop("selectedIndex", 0)
            },
            className: "btn-outline-primary"
        }],
        initComplete: function(settings, json) {
            $(".dt-buttons .btn").removeClass("btn-secondary")
        }
    });

    dataListView.on('draw.dt', function() {
        setTimeout(function() {
            if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
            }
        }, 50);
    });

    // init thumb view datatable
    // var dataThumbView = $(".data-thumb-view").DataTable({
    //   responsive: false,
    //   dom:
    //     '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    //   oLanguage: {
    //     sLengthMenu: "_MENU_",
    //     sSearch: ""
    //   },
    //   aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
    //   // select: {
    //   //   style: "multi"
    //   // },
    //   order: [[2, "asc"]],
    //   bInfo: false,
    //   pageLength: 4,
    //   buttons: [
    //   ],
    //   initComplete: function(settings, json) {
    //     $(".dt-buttons .btn").removeClass("btn-secondary")
    //   },
    //   columnDefs: [
    //     {
    //       orderable: false,
    //       targets: 0,
    //       // checkboxes: { selectRow: true }
    //     }
    //   ],
    //   initComplete: function () {
    //     setTimeout(function(){
    //       if($(".action-filters").length > 0){
    //         var action_filters_content = $(".action-filters").html()
    //         action_filters_content = '<div class="dataTables_length"><label><select name="status_filter" aria-controls="status_filter" class="custom-select custom-select-sm form-control form-control-sm"><option value="4">4</option><option value="10">10</option><option value="15">15</option><option value="20">20</option></select></label></div>' + action_filters_content
    //         console.log(action_filters_content)
    //         $(".action-filters").html(action_filters_content)
    //       }
    //     }, 50);
    //   }
    // })

    // dataThumbView.on('draw.dt', function(){
    //   setTimeout(function(){
    //     if (navigator.userAgent.indexOf("Mac OS X") != -1) {
    //       $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
    //     }
    //   }, 50);
    // });

    // To append actions dropdown before add new button
    var actionDropdown = $(".actions-dropodown")
    actionDropdown.insertBefore($(".top .actions .dt-buttons"))


    // Scrollbar
    if ($(".data-items").length > 0) {
        new PerfectScrollbar(".data-items", { wheelPropagation: false })
    }

    // Close sidebar
    $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $("#data-name, #data-price").val("")
        $("#data-category, #data-status").prop("selectedIndex", 0)
    })

    // On Edit
    $('.action-edit').on("click", function(e) {
        e.stopPropagation();
        var order_id = $(this).attr('id');
        let url = "getorder/" + order_id;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                $(".items").empty();
                var status;
                if (data.orderstatus_id == "1") {
                    status = "Order Placed";
                } else if (data.orderstatus_id == "2") {
                    status = "Order Accepted";
                } else if (data.orderstatus_id == "3") {
                    status = "Delivery Assigned";
                } else if (data.orderstatus_id == "4") {
                    status = "Picked Up";
                } else if (data.orderstatus_id == "5") {
                    status = "Completed";
                } else if (data.orderstatus_id == "6") {
                    status = "Canceled";
                } else if (data.orderstatus_id == "7") {
                    status = "Ready to Pickup";
                } else if (data.orderstatus_id == "8") {
                    status = "Order Finished";
                }

                $("#value-status").html(status);
                $('#data-order-id').html(data.unique_order_id);
                $('.btn-print-order').attr('data-id', data.unique_order_id);
                $('#d_placed_date').html(data.order_placed);
                $('#store_name').html(data.restaurant_name);
                $('#comments').html(data.order_comment);
                // $('#value-quantity').html("x"+data.quantity);
                // $('#value-item').html(data.name);
                for (const key in data.orderitems) {
                    if (data.orderitems.hasOwnProperty(key)) {
                        const element = data.orderitems[key];
                        var items = '<div class="col-sm-12 data-field-col">' +
                            '<span id="value-quantity" class="badge badge-flat border-grey-800 text-default mr-2">x' + element.quantity + '</span><strong id="value-item">' + element.name + '</strong>';
                        if (element.order_item_addons.length > 0) {
                            items += '<div class="table-responsive">' +
                                '<table class="table table-striped">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>Category</th>' +
                                '<th>Addon</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            for (const key in element.order_item_addons) {
                                if (element.order_item_addons.hasOwnProperty(key)) {
                                    const ele = element.order_item_addons[key];
                                    items += '<tr>' +
                                        '<td>' + ele.addon_category_name + '</td>' +
                                        '<td>' + ele.addon_name + '</td>' +
                                        '</tr>';
                                }
                            }
                            items += '</tbody>' +
                                '</table>' +
                                '</div>';
                        }
                        items += '<div class="mb-2" style="border-bottom: 2px solid #c9c9c9;"></div>' +
                            '</div>';
                        $('.items').append(items);
                    }
                }
                $('.btnFinish').attr('data-id', data.unique_order_id);
                $(".add-new-data").addClass("show");
                $(".overlay-bg").addClass("show");
            }
        })
    });

    // On Delete
    $('.action-delete').on("click", function(e) {
        e.stopPropagation();
        $(this).closest('td').parent('tr').fadeOut();
    });

    // dropzone init
    Dropzone.options.dataListUpload = {
        complete: function(files) {
            var _this = this
                // checks files in class dropzone and remove that files
            $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
                "click",
                function() {
                    $(".dropzone")[0].dropzone.files.forEach(function(file) {
                        file.previewElement.remove()
                    })
                    $(".dropzone").removeClass("dz-started")
                }
            )
        }
    }
    Dropzone.options.dataListUpload.complete()

    // mac chrome checkbox fix
    if (navigator.userAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
    }
})