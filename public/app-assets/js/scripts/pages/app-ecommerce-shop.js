/*=========================================================================================
    File Name: app-ecommerce-shop.js
    Description: Ecommerce Shop
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function() {
        "use strict";
        // RTL Support
        var direction = 'ltr';
        if ($('html').data('textdirection') == 'rtl') {
            direction = 'rtl';
        }

        var sidebarShop = $(".sidebar-shop"),
            shopOverlay = $(".shop-content-overlay"),
            sidebarToggler = $(".shop-sidebar-toggler"),
            priceFilter = $(".price-options"),
            gridViewBtn = $(".grid-view-btn"),
            listViewBtn = $(".list-view-btn"),
            ecommerceProducts = $("#ecommerce-products"),
            cart = $(".cart"),
            cardplus = $("#cardplus"),
            cartmin = $("#cartmin"),
            acceptcart = $("#acceptcart"),
            wishlist = $(".wishlist");


        // show sidebar
        sidebarToggler.on("click", function() {
            sidebarShop.toggleClass("show");
            shopOverlay.toggleClass("show");
        });

        // remove sidebar
        $(".shop-content-overlay, .sidebar-close-icon").on("click", function() {
            sidebarShop.removeClass("show");
            shopOverlay.removeClass("show");
        })

        //price slider
        var slider = document.getElementById("price-slider");
        if (slider) {
            noUiSlider.create(slider, {
                start: [51, 5000],
                direction: direction,
                connect: true,
                tooltips: [true, true],
                format: wNumb({
                    decimals: 0,
                }),
                range: {
                    "min": 51,
                    "max": 5000
                }
            });
        }
        // for select in ecommerce header
        if (priceFilter.length > 0) {
            priceFilter.select2({
                minimumResultsForSearch: -1,
                dropdownAutoWidth: true,
                width: '100%'
            });
        }

        /***** CHANGE VIEW *****/
        // Grid View
        gridViewBtn.on("click", function() {
            ecommerceProducts.removeClass("list-view").addClass("grid-view");
            listViewBtn.removeClass("active");
            gridViewBtn.addClass("active");
        });

        // List View
        listViewBtn.on("click", function() {
            ecommerceProducts.removeClass("grid-view").addClass("list-view");
            gridViewBtn.removeClass("active");
            listViewBtn.addClass("active");
        });

        // For View in cart
        cart.on("click", function() {
            var $this = $(this),
                addToCart = $this.find(".add-to-cart"),
                viewInCart = $this.find(".view-in-cart");
            if (addToCart.is(':visible')) {
                addToCart.addClass("d-none");
                viewInCart.addClass("d-inline-block");
            } else {
                var href = viewInCart.attr('href');
                window.location.href = href;
            }
        });
        $(".shopoptionminus").on("click", function() {
            $('.addonfield').remove();
            $('#modalID').val('');
            $('.current-status').val('2');
            var id = $(this).attr("value");
            var customizableItem = $('.customizableItem' + id).val();
            if (customizableItem == "onshow") {

                var cartname = $("#cartname" + id).text();
                var image = $("#image" + id).val();
                var cartprice = $("#cartprice" + id).text();
                var customizationname = $("#customizationname").text(cartname);
                var customizationimage = $("#customizationimage").val(image);
                var customizationID = $("#customizationID").val(id);
                var customizationvalue = $("#customizationvalue").text(cartprice);
                var storeID = $("#storeID").val();

                console.log(id)


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "GET",
                    url: "/SingleproductGet/" + id + "/" + storeID,
                }).done(function(dataValue) {

                    var dataLength = dataValue[0].length;
                    if (dataLength > 0) {
                        var data = dataValue[0];

                        for (var i = 0; i < dataLength; i++) {
                            var addonID = data[i]['addonID'];
                            $(".addonmodal").append('<div class="row col-md-12 addonfield" ><div id="addonnamemodalname' + addonID + '" class="col-md-6 addonnamemodalradio' + addonID + '" >' + data[i]["addon_name"] + '</div><div class="col-md-4"><span id="addonnamemodalprice' + addonID + '">' + data[i]["addon_price"] + '</span><i class="fas fa-euro-sign"></i></div><div class="vs-radio-con vs-radio-primary col-md-2"><input type="radio" name="vueradisize" class="addonnamemodalradio addonnamemodalradio' + addonID + '" value="' + addonID + '"><span class="vs-radio vs-radio-lg"><span class="vs-radio--border"></span><span class="vs-radio--circle"></span></span></div></div>');
                        }
                        $("input[type='radio']").click(function() {
                            var modalradio = $(this).val();
                            $('#modalID').val(modalradio);
                        });
                    } else {
                        $(".cartmin" + id).attr("style", " pointer-events: none;margin: 9px;")
                    }


                });

            } else {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var storeID = $("#storeID").val();
                $.ajax({
                    method: "POST",
                    url: "/storeValue",
                    data: {
                        "storeID": storeID,
                        "customizationID": id,
                        "customizableItem": id,
                        "currentStatus": $('.current-status').val(),
                        "customizationname": $("#cartname" + id).text(),
                        "customizationimage": $("#image" + id).val(),
                        "customizationvalue": $("#cartprice" + id).text(),
                    }
                }).done(function(msg) {
                    var customizationvalue = $("#itemscart").text(msg[1]);
                    var customizationvalue = $("#pricecart").text(msg[0]);
                    location.reload(true);
                });




            }











        });

        $("#acceptcart").on("click", function() {
            var currentStatus = $('.current-status').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var storeID = $("#storeID").val();
            var customizationID = $("#customizationID").val();
            var customizationname = $("#customizationname").text();
            var customizationvalue = $("#customizationvalue").text();
            var customizationimage = $("#customizationimage").val();
            var modalID = $("#modalID").val();
            $.ajax({
                method: "POST",
                url: "/storeValue",
                data: {
                    "storeID": storeID,
                    "customizationID": customizationID,
                    "customizationname": customizationname,
                    "customizationimage": customizationimage,
                    "currentStatus": currentStatus,
                    "addonID": modalID,
                    "addonname": $('#addonnamemodalname' + modalID).text(),
                    "addonprice": $('#addonnamemodalprice' + modalID).text(),
                    "customizationvalue": customizationvalue,
                }
            }).done(function(msg) {

                location.reload(true);

            });



        });
        // For filters

        $('#IsVeg, input[type=radio][name=price-range], #IsNew, #IsPopular, #IsRecommended, .category-filter').change(function() {

            if ($('#IsVeg').is(":checked")) {
                var IsVeg = '1';
            } else {
                var IsVeg = '0';

            }
            if ($('#IsNew').is(":checked")) {
                var IsNew = '1';
            } else {
                var IsNew = '0';

            }
            if ($('#IsPopular').is(":checked")) {
                var IsPopular = '1';
            } else {
                var IsPopular = '0';

            }
            if ($('#IsRecommended').is(":checked")) {
                var IsRecommended = '1';
            } else {
                var IsRecommended = '0';

            }
            if ($('input[type=radio][name=category-filter]').is(':checked')) {
                var CheckedCategoryValue = $("input[type=radio][name=category-filter]:checked").val();
            }
            if ($('input[type=radio][name=price-range]').is(':checked')) {
                var CheckedPriceValue = $('input[type=radio][name=price-range]:checked').val();
            } else {
                var CheckedPriceValue = '0';

            }
            var storeID = $('#storeID').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/storefilter",
                data: {
                    "CheckedCategoryValue": CheckedCategoryValue,
                    "CheckedPriceValue": CheckedPriceValue,
                    "IsRecommended": IsRecommended,
                    "IsPopular": IsPopular,
                    "IsNew": IsNew,
                    "IsVeg": IsVeg,
                    "storeID": storeID,
                }
            }).done(function(data) {
                var dataLength = data.length;
                $(".ecommerce-card").addClass('ecommerce-allcard');

                if (dataLength > 0) {
                    for (var i = 0; i < dataLength; i++) {
                        var id = data[i]['id'];
                        $(".ecommerce-singlecard" + id).removeClass('ecommerce-allcard');

                    }

                }






            });








        });

        // end filters
        $(".shopoptionplus").on("click", function() {

            $('.addonfield').remove();
            $('#modalID').val('');
            $('.current-status').val('1');
            var id = $(this).attr("value");
            var image = $("#image" + id).val();
            var customizationimage = $("#customizationimage").val(image);
            var customizableItem = $('.customizableItem' + id).val();
            if (customizableItem == "onshow") {
                var cartname = $("#cartname" + id).text();

                var cartprice = $("#cartprice" + id).text();
                var customizationname = $("#customizationname").text(cartname);

                var customizationID = $("#customizationID").val(id);
                var customizationvalue = $("#customizationvalue").text(cartprice);

                var addonValue = $('.addonValue' + id).val();
                var addonvaluearray = JSON.parse(addonValue);
                var addonvaluelength = addonvaluearray.length;
                for (var i = 0; i < addonvaluelength; i++) {
                    var addonID = addonvaluearray[i]['id'];
                    console.log(addonID)
                    $(".addonmodal").append('<div class="row col-md-12 addonfield" ><div id="addonnamemodalname' + addonID + '" class="col-md-6 addonnamemodalradio' + addonID + '" >' + addonvaluearray[i]["name"] + '</div><div class="col-md-4"><span id="addonnamemodalprice' + addonID + '">' + addonvaluearray[i]["price"] + '</span><i class="fas fa-euro-sign"></i></div><div class="vs-radio-con vs-radio-primary col-md-2"><input type="radio" name="vueradisize" class="addonnamemodalradio addonnamemodalradio' + addonID + '" value="' + addonID + '"><span class="vs-radio vs-radio-lg"><span class="vs-radio--border"></span><span class="vs-radio--circle"></span></span></div></div>');
                }
                $("input[type='radio']").click(function() {
                    var modalradio = $(this).val();
                    $('#modalID').val(modalradio);
                    console.log($('#modalID').val());
                    console.log("$('#modalID').val()");
                });
            } else {


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var storeID = $("#storeID").val();
                $.ajax({
                    method: "POST",
                    url: "/storeValue",
                    data: {
                        "storeID": storeID,
                        "customizationID": id,
                        "customizableItem": id,
                        "currentStatus": $('.current-status').val(),
                        "customizationname": $("#cartname" + id).text(),
                        "customizationimage": $("#image" + id).val(),
                        "customizationvalue": $("#cartprice" + id).text(),
                    }
                }).done(function(msg) {
                    var customizationvalue = $("#itemscart").text(msg[1]);
                    var customizationvalue = $("#pricecart").text(msg[0]);
                    location.reload(true);
                });




            }

        });



        $(".view-in-cart").on('click', function(e) {
            e.preventDefault();
        });

        // For Wishlist Icon
        wishlist.on("click", function() {
            var $this = $(this)
            $this.find("i").toggleClass("fa-heart-o fa-heart")
            $this.toggleClass("added");
        })

        // Checkout Wizard
        var checkoutWizard = $(".checkout-tab-steps"),
            checkoutValidation = checkoutWizard.show();
        if (checkoutWizard.length > 0) {
            $(checkoutWizard).steps({
                headerTag: "h6",
                bodyTag: "fieldset",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                enablePagination: false,
                onStepChanging: function(event, currentIndex, newIndex) {
                    // allows to go back to previous step if form is
                    if (currentIndex > newIndex) {
                        return true;
                    }
                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        checkoutValidation.find(".body:eq(" + newIndex + ") label.error").remove();
                        checkoutValidation.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                    }
                    console.log($(this).val())
                        // check for valid details and show notification accordingly
                    if (currentIndex === 1 && Number($(".form-control.required").val().length) < 1) {

                        toastr.warning('Error', 'Please Enter Valid Details', { "positionClass": "toast-bottom-right" });
                    }
                    checkoutValidation.validate().settings.ignore = ":disabled,:hidden";
                    return checkoutValidation.valid();
                },
            });
            // to move to next step on place order and save address click
            $(".place-order, .delivery-address").on("click", function() {
                $(".checkout-tab-steps").steps("next", {});
            });
            // check if user has entered valid cvv
            $(".btn-cvv").on("click", function() {
                // if ($(".input-cvv").val().length == 3) {
                toastr.success('Success', 'Payment received Successfully', { "positionClass": "toast-bottom-right" });
                // } else {
                //     toastr.warning('Error', 'Please Enter Valid Details', { "positionClass": "toast-bottom-right" });
                // }
            })
        }

        // checkout quantity counter
        var quantityCounter = $(".quantity-counter"),
            CounterMin = 1,
            CounterMax = 10;
        if (quantityCounter.length > 0) {
            quantityCounter.TouchSpin({
                min: CounterMin,
                max: CounterMax
            }).on('touchspin.on.startdownspin', function() {
                var $this = $(this);
                $('.bootstrap-touchspin-up').removeClass("disabled-max-min");
                if ($this.val() == 1) {
                    $(this).siblings().find('.bootstrap-touchspin-down').addClass("disabled-max-min");
                }
            }).on('touchspin.on.startupspin', function() {
                var $this = $(this);
                $('.bootstrap-touchspin-down').removeClass("disabled-max-min");
                $('.bootstrap-touchspin-down').attr("value", "disabled-max-min");
                if ($this.val() == 10) {
                    $(this).siblings().find('.bootstrap-touchspin-up').addClass("disabled-max-min");
                }
            });
        }

        // remove items from wishlist page
        $(".remove-wishlist , .move-cart").on("click", function() {
            $(this).closest(".ecommerce-card").remove();
        })
    })
    // on window resize hide sidebar
$(window).on("resize", function() {
    if ($(window).outerWidth() >= 991) {
        $(".sidebar-shop").removeClass("show");
        $(".shop-content-overlay").removeClass("show");
    }
});