$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//
function close_modal()
{
    console.log("modal");

// $(".close").click(function () {
    $("#call_back_at_elifee").val('');
    $("#call_back_new").val('');
    $("#call_back_mnp").val('');
    $("#later_date").val('');
    $("#reject_comment").val('');
// })

}
function check_package_type(div,number,url,div2){
    // alert(div);
    // alert(number);
    // alert(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            number: number,
        },
        success: function (data) {
            // alert(data);
            console.log(div);
            $("#"+div).val(data);
            check_package(data,div2);
            // $("#ReportingData").html(data);
        }
    });
}
function check_elife_package(product,url){
    // alert(div);
    // alert(number);
    var product = product.value;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            product: product,
        },
        success: function (data) {
            // alert(data);
            // console.log(div);
            // $("#"+div).val(data);
            // check_package(data,div2);
            $("#c__select").html(data);
        }
    });
}
function accept_lead(lead_id,url,web){
    // alert(div);
    // alert(number);
    // alert(url);
    // let url = {{route('admin')}}
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            lead_id: lead_id,
        },
        success: function (data) {
            // alert(data);
            if(data > 0){
                window.location.href = web +'/'+lead_id
            }
            // console.log(div);
            // $("#"+div).val(data);
            // check_package(data);
            // $("#ReportingData").html(data);
        }
    });
}
function CheckPendingLead() {
    // alert(div);
    var url = $("#CheckPendingLead").val();
    // alert(number);
    // alert(url);
    var number = '';
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            number: number,
        },
        success: function (data) {
            // alert(data);
            // console.log(div);
            if(data > 0){
                Swal.fire({
                    title: 'your have '+data+' Notifications?',
                    text: "Later Lead Reminder!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Check Lead!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Swal.fire(
                            window.location.href = 'http://callvel.test/admin/pending'
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                    else{
                        alert("you cancel popup");
                    }
                })
            }
            // $("#"+div).val(data);
            // check_package(data);
            // $("#ReportingData").html(data);
        }
    });
}
// CheckPendingLead();
function checkNumData(url) {
    // alert(div);
    // alert(number);
    var number = '';
    // alert(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            number: number,
        },
        success: function (data) {
            // alert(data);
            var num_limit = 10
            if (data >= num_limit) {
                Swal.fire(
                    'Alert!',
                    'You have exceeded your number limit of ' + num_limit + ', Please choose Resevered Number List!',
                    'error'
                    )
                $("#number_exceed_msg").html('<p style="color:red;">You have exceeded your number limit of '+num_limit+', Please choose from your Resevered Number List</p>')
                // alert("You already Choose Limited Number, Please use Reserved Number Thanks");
                // $("")
            }
            // console.log(div);
            // $("#"+div).val(data);
            // check_package(data);
            // $("#ReportingData").html(data);
        }
    });
}
$("#role").change(function () {
    var Role = $("#role").val();
    if(Role == 'Tele Sale' || Role == 'DirectSale'){
        $("#TeamLeaderDiv").show();
    }
    else{
        $("#TeamLeaderDiv").hide();
    }
});
function check_package(id,div){
    // $("#klon1 #mytypeval").change(function () {
        // var div
        console.log(div);
        // var id = $("#klon1 #mytypeval").val();
        var url = $("#AjaxUrl2").val();
        // alert(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                id: id,
            },
            url: url,
            cache: false,
            beforeSend: function () {
                // $("#klon1 #c__select").empty();
                $("#" + div).empty();
            },
            success: function (res) {
                // location.reload();
                if (res) {
                    $("#"+div).append($("<option/>", {
                        value: '',
                        text: 'Select'
                    }));
                    $.each(res, function (key, value) {
                        $("#" + div).append($("<option/>", {
                            value: key,
                            text: value
                        }));
                    });
                    // $('#klon2 #c__select').append($("<option/>", {
                    //     value: '',
                    //     text: 'Select'
                    // }));
                    // $.each(res, function (key, value) {
                    //     $('#klon2 #c__select').append($("<option/>", {
                    //         value: key,
                    //         text: value
                    //     }));
                    // });
                }
                // var value = $.trim(value);
                // $("#fetch_teacher").html(value);
            }
        });
        $("#klon1 #mytypeval").change(function () {
            $("#klon1 .NumberDropDown").empty();
            $("#klon1 #lm").val('');
            $("#klon1 #fm").val('');
            $("#klon1 #data").val('');
            $("#klon1 #pnum").val('');
            $("#klon1 #fmnum").val('');
            $("#klon1 #mp1").val('');
            $("#klon1 #contract_commitment_1").text('');
        })
        //
    //     $('#klon1 .NumberDropDown').select2({
    //         placeholder: 'Please Search Numbers',
    //         // dropdownParent: $('#AddSkill'),
    //         // tags: true,
    //         minimumInputLength: 3,
    //         ajax: {
    //             url: '/skill-auto-complete?id=' + $("#klon1 #mytypeval").val() + '&pid=' + $("#type").val(),
    //             dataType: 'json',
    //             delay: 250,
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data, function (item) {
    //                         return {
    //                             text: item.number,
    //                             id: item.number
    //                         }
    //                     })
    //                 };

    //             }
    //         }
    //     });
    // });
}
//
//
function SearchCustomReport(simtype,url,userid){
    var status = $("#status").val();
    var start = $("#start_date").val();
    var end = $("#end_date").val();
    // alert(status + url + userid);
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            status: status,
            userid: userid,
            start:start,
            end:end,
            simtype: simtype,
        },
        success: function (data) {
            // alert(data);
            $("#ReportingData").html(data);
        }
    });
}
//
function AssignJunaid(url,id,form){
        // alert(form);


        var rizwan = document.getElementById(form);


        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#loading_num2").show();
                // // $(".request_call").hide();
                // $('#' + btn).prop('disabled', true);
            },
            success: function (msg) {
                //    alert(msg);
                 if (msg == 1) {
                     Swal.fire(
                         'Good job!',
                         'You succesfully assigned lead!',
                         'success'
                     )
                     setTimeout(() => {
                        // window.location.href =
                        window.location.href = "https://soft.riuman.com/home";
                     }, 3000);
                        // alert("Thank you for assign lead");
                    }else{
                        alert("Something wrong Kindly contact IT Team");
                    }
                // $("#loading_num2").hide();
                // var k = msg.split('###');
                // $("#dob").val(k[1]);
                // $("#expiry").val(k[2]);
                // $("#activation_emirate_expiry").val(k[2]);
            }
            // }
        });
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: {
    //         id: id,
    //         // partner:partner,
    //     },
    //     beforeSend: function () {
    //         $("#loading_num").show();
    //         // // $(".request_call").hide();
    //         // $('#' + btn).prop('disabled', true);
    //     },
    //     success: function (data) {
    //         // alert(data);
    //         if(data == 1){
    //             alert("Thank you for assign lead");
    //         }else{
    //             alert("Something wrong Kindly contact IT Team");
    //         }

    //         // $("#loading_num").hide();
    //         // $("#broom").html(data);
    //     }
    // });
}
//
function NumberDtl(simtype,url,partner){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            simtype: simtype,
            partner:partner,
        },
        beforeSend: function () {
            $("#loading_num").show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (data) {
            // alert(data);
            $("#loading_num").hide();
            $("#broom").html(data);
        }
    });
}
function SavingDataDeal(url,form) {
    // alert(form);


    var rizwan = document.getElementById(form);


    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
       beforeSend: function () {
           $("#loading_num2").show();
           // // $(".request_call").hide();
           // $('#' + btn).prop('disabled', true);
       },
        success: function (msg) {
        //    alert(msg);
        $("#loading_num2").hide();
         var k = msg.split('###');
         $("#dob").val(k[1]);
         $("#expiry").val(k[2]);
         $("#activation_emirate_expiry").val(k[2]);
        }
        // }
    });
}
function OnlineHandling(url,type){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            type: type,
        },
        success: function (data) {
            // alert(data);
            $("#broom").html(data);
        }
    });
}
    // }));
function SrApi(url,form) {
    // alert(form);
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $("#loading_num3").show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (msg) {
            $("#loading_num3").hide();
        //    alert(msg);
         var k = msg.split('###');
        // console.log(k[3] + ' ' + $k[4]);
         $("#sr_no").val(k[1]);
         $("#activation_sr_no").val(k[1]);
         $("#order_number").val(k[2]);
         $("#activation_service_order").val(k[2]);
         $("#application_date").val(k[3] + ' ' + k[4]);
         $("#activation_date").val(k[3] + ' ' + k[4]);
        }
        // }
    });
    // }
    // }));
}
function NameApi(url, form) {
    // alert(form);
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
         beforeSend: function () {
             $("#loading_num1").show();
             // // $(".request_call").hide();
             // $('#' + btn).prop('disabled', true);
            },
            success: function (msg) {
                $("#loading_num1").hide();
                //    alert(msg);
                var k = msg.split('###');
                // console.log(k[3] + ' ' + $k[4]);
                $("#name").val(k[1]);
                $("#cname").val(k[1]);
                $("#CustomerNameAct").val(k[1]);
                $("#emirate_id").val(k[2]);
                $("#emirate_id_form").val(k[2]);
                $("#activation_emirate_expiry").val(k[2]);
                //  $("#application_date").val(k[3] + ' ' + k[4]);
                $("#emirate_number").val(k['2']);
                $("#passport_number").val(k['2']);
        }
        // }
    });
    // }
    // }));
}

function ShowReserved(simtype, url,partner) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            simtype: simtype,
            partner: partner,
        },
        success: function (data) {
            // alert(data);
            $("#broom").html(data);
        }
    });
}
function BookNum(id,url,Channel,e){
    Swal.fire({
        title: 'Do you want to resever this number?',
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        // denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id:id,
                    Channel: Channel,
                },
                success: function (data) {
                    // alert(data);
                    // location.reload();
                    if(data == 1){
                        location.reload();
                    }
                    else if(data == 2)
                    {
                        alert("You already crossed Limit");
                    }
                    else if(data == 0){
                        alert("Number Already Booked");
                    }

                    // $("#ReportingData").html(data);
                }
            });
        }
    });

}
function RevNum(id,url,cid,e){

     Swal.fire({
         title: 'Do you want to Revive this number?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     id: id,
                     cid: cid,
                 },
                 success: function (data) {
                     // alert(data);
                     location.reload();

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
}

function HoldNum(id, url, cid, e) {

     Swal.fire({
         title: 'Do you want to Lead this number?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     id: id,
                     cid: cid,
                 },
                 success: function (data) {
                     // alert(data);
                     location.reload();

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
}
// $("#add_location").bind("paste", function (e) {
//     // access the clipboard using the api
//     // var pastedData = e.originalEvent.clipboardData.getData('text');
//     // alert(pastedData);
//     var location = $("#add_location").val();
//     var longlat = /\/\@(.*),(.*),/.exec(location);
//     if (longlat == null) {
//         alert("Please use Valid Url, or Complete URL, Sample: https://www.google.com/maps/place/Little+Hut+Restaurant/@25.2778584,55.3832735,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f5c375738485f:0xe7f816caec4bca51!8m2!3d25.2778584!4d55.3854622");
//     } else {
//         var lng = longlat['1'];
//         var lat = longlat['2'];
//         $("#add_lat_lng").val(lat + ',' + lng);
//         // $('#result').html('lng: ' + lng + '<br />' + 'lat: ' + lat);
//     }
// });
// $('input').on('paste', function () {
// var location = $("#add_location").val();
// var longlat = /\/\@(.*),(.*),/.exec(location);
// if (longlat == null) {
//     $("#location_error").html("<p class='alert alert-danger'>Please use Valid Url, or Complete URL, Sample: https://www.google.com/maps/place/Little+Hut+Restaurant/@25.2778584,55.3832735,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f5c375738485f:0xe7f816caec4bca51!8m2!3d25.2778584!4d55.3854622</p>");
//     $(".btn").prop("disabled", true);
// } else {
//     $("#location_error").html("<p class='alert alert-dismissible alert-success'>Thank You for Valid URL !!</p>");
//     var lng = longlat['1'];
//     var lat = longlat['2'];
//     $("#add_lat_lng").val(lat + ',' + lng);
//     $(".btn").prop("disabled", false);

//     // $('#result').html('lng: ' + lng + '<br />' + 'lat: ' + lat);
// }
// });


function check_location_url(){
    var location = $("#add_location").val();
    var longlat = /\/\@(.*),(.*),/.exec(location);
    console.log("sabtitut");
    console.log(longlat);
    console.log(location);
    if (longlat == null) {
        $("#location_error").html("<p class='alert alert-danger'>Please use Valid Url, or Complete URL, Sample: https://www.google.com/maps/place/Little+Hut+Restaurant/@25.2778584,55.3832735,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f5c375738485f:0xe7f816caec4bca51!8m2!3d25.2778584!4d55.3854622</p>");
        $(".btn").prop("disabled", true);
        $("#checker").prop("disabled", false);
    } else {
        $("#location_error").html("<p class='alert alert-dismissible alert-success'>Thank You for Valid URL !!</p>");
        var lng = longlat['1'];
        var lat = longlat['2'];
        $("#add_lat_lng").val(lat + ',' + lng);
        $(".btn").prop("disabled", false);

        // $('#result').html('lng: ' + lng + '<br />' + 'lat: ' + lat);
    }

}



function AssignLead(id, url, cid, e) {
    var google_url = $("#lead_location").val();
    // console.log(google_url);
    var longlat = /\/\@(.*),(.*),/.exec(google_url);
    // console.log(longlat);
//     if (longlat === undefined || longlat['1'] === null) {
//     console.log("salman" + longlat['1']);
//      // do something

// }
    if(longlat == null){
        alert("Please use Valid Url, or Complete URL, Sample: https://www.google.com/maps/place/Little+Hut+Restaurant/@25.2778584,55.3832735,17z/data=!3m1!4b1!4m5!3m4!1s0x3e5f5c375738485f:0xe7f816caec4bca51!8m2!3d25.2778584!4d55.3854622");
    }
    else{

    var lng = longlat['1'];
    var lat = longlat['2'];
    $('#result').html('lng: '+lng+'<br />'+'lat: '+lat);


     Swal.fire({
         title: 'Do you want to Assign this number?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     google_url:google_url,
                     id: id,
                     cid: cid,
                     lat:lat,
                     lng:lng,
                 },
                 success: function (data) {
                     alert(data);
                    //  location.reload();

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
     }
}
function Revert(id, url, cid, e) {

     Swal.fire({
         title: 'Do you want to Re-Available this number?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     id: id,
                     cid: cid,
                 },
                 success: function (data) {
                     // alert(data);
                     location.reload();

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
}
function reject(id, url, cid, e) {

     Swal.fire({
         title: 'Do you want to Reject this number?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     id: id,
                     cid: cid,
                 },
                 success: function (data) {
                     // alert(data);
                     location.reload();

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
}
function change_feedback(id) {
    var a = $("#remarks_call_log_" + id).val();
    // alert(a);
    if (a == 'other') {
        $("#remarks_" + id).show();
    }
    else if (a == 'Follow Up') {
        $("#follow_date_" + id).show();
        $("#remarks_" + id).hide();
    }
    else {
        $("#follow_date_" + id).hide();
        $("#remarks_" + id).hide();
    }
}
function rejectManager(id, url, cid,divid, e) {
    var remarks = $("#reject_comment"+divid).val();
     Swal.fire({
         title: 'Do you want to Reject this lead?',
         // showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: `Confirm`,
         // denyButtonText: `Don't save`,
     }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             // Swal.fire('Saved!', '', 'success')
             $.ajax({
                 type: 'POST',
                 url: url,
                 data: {
                     id: id,
                     cid: cid,
                     remarks:remarks,
                 },
                 success: function (data) {
                     // alert(data);
                     if(data == 1){
                         //  alert("Data ")
                          location.reload();
                     }
                     else{
                         alert("SOMETHING WRONG PLEASE COORDINATE WITH IT TEAM");
                     }

                     // $("#ReportingData").html(data);
                 }
             });
         }
     });
}
function VerifyNum(id,url,cid,e){
    Swal.fire({
        title: 'Do you want to Remove this number?',
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        // denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            $.ajax({
            type: 'POST',
            url: url,
            data: {
                id:id,
                cid:cid,
            },
            success: function (data) {
                // alert(data);
                location.reload();

                // $("#ReportingData").html(data);
            }
        });
        }
    });
    // if (!confirm('Do you want to Verify this number?')) {
    //     e.preventDefault();
    // }
    // // alert("yes");
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: {
    //         id:id,
    //         cid:cid,
    //     },
    //     success: function (data) {
    //         // alert(data);
    //         location.reload();

    //         // $("#ReportingData").html(data);
    //     }
    // });

}
function VerifyNum2(id,url,e){
    Swal.fire({
        title: 'Do you want to Remove this number?',
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        // denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            $.ajax({
            type: 'POST',
            url: url,
            data: {
                id:id,
                // cid:cid,
            },
            success: function (data) {
                // alert(data);
                location.reload();

                // $("#ReportingData").html(data);
            }
        });
        }
    });
    // if (!confirm('Do you want to Verify this number?')) {
    //     e.preventDefault();
    // }
    // // alert("yes");
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: {
    //         id:id,
    //         cid:cid,
    //     },
    //     success: function (data) {
    //         // alert(data);
    //         location.reload();

    //         // $("#ReportingData").html(data);
    //     }
    // });

}
function VerifyNum22(id,url,e){
    Swal.fire({
        title: 'Do you want to Remove this number?',
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        // denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            // Swal.fire('Saved!', '', 'success')
            $.ajax({
            type: 'POST',
            url: url,
            data: {
                id:id,
                // cid:cid,
            },
            success: function (data) {
                // alert(data);
                // location.reload();
                alert("Number has been removed");

                // $("#ReportingData").html(data);
            }
        });
        }
    });
    // if (!confirm('Do you want to Verify this number?')) {
    //     e.preventDefault();
    // }
    // // alert("yes");
    // $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: {
    //         id:id,
    //         cid:cid,
    //     },
    //     success: function (data) {
    //         // alert(data);
    //         location.reload();

    //         // $("#ReportingData").html(data);
    //     }
    // });

}
function myconversation(){
    // alert($(".chat_input").val());
    var remarks = $(".chat_input").val();
    var id = $("#leadid").val();
    var url = $("#ChatAjaxUrl").val();
    var saler_id = $("#saler_id").val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
            remarks:remarks,
            saler_id: saler_id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            $(".chat_input").val('');
            // $(".chat_input").empty();
        },
        success: function (res) {
            // alert(res);
            // console.log(res);
            var data = $.trim(res);
            // alert(data);
            // $("#leadno").text(data);
            $(".msg_container_base").html(data);
            // $(".msg_sent").text('<p>Lorem ipsum</p>');
            // location.reload();
            // if (res) {
            //     $('#package_id').append($("<option/>", {
            //         value: '',
            //         text: 'Select'
            //     }));
            //     $.each(res, function (key, value) {

            //         $('#package_id').append($("<option/>", {
            //             value: key,
            //             text: value
            //         }));
            //     });
            // }
            // var value = $.trim(value);
            // $("#fetch_teacher").html(value);
        }
    });
}

function fetch_package(id,url) {
//    var class_add = 'fetch_teacher';
// alert(id);
// alert(url);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            $("#package_id").empty();
        },
        success: function (res) {
            // location.reload();
            if (res) {
                $('#package_id').append($("<option/>", {
                    value: '',
                    text: 'Select'
                }));
                $.each(res, function (key, value) {

                    $('#package_id').append($("<option/>", {
                        value: key,
                        text: value
                    }));
                });
            }
            // var value = $.trim(value);
            // $("#fetch_teacher").html(value);
        }
    });

}
function itplan(id,url) {
//    var class_add = 'fetch_teacher';
// alert(id);
// alert(url);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            // $("#package_id").empty();
        },
        success: function (res) {
            // location.reload();
            if (res) {
                $.each(res, function (key, value) {
                //   alert(key);
                //   alert(value);
                  $(".plan_pricing").val(value);
                  $(".plan_description").html(key);
                    // $('#package_id').append($("<option/>", {
                    //     value: '',
                    //     text: 'Select'
                    // }));
                    // $('#package_id').append($("<option/>", {
                    //     value: key,
                    //     text: value
                    // }));
                });
            }
            // var value = $.trim(value);
            // $("#fetch_teacher").html(value);
        }
    });

}

$(".btn-submit").click(function (e) {

    e.preventDefault();

    var name = $("input[name=name]").val();
    var password = $("input[name=password]").val();
    var email = $("input[name=email]").val();

    $.ajax({
        type: 'POST',
        url: "{{ route('ajaxRequest.post') }}",
        data: {
            name: name,
            password: password,
            email: email
        },
        success: function (data) {
            alert(data.success);
        }
    });

});
function report(userid,url,reportName,type){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            userid:userid,
            type: type,
            reportName:reportName
        },
        success: function (data) {
            // alert(data);
            $("#saledata").hide();
            $("#saledata2").hide();
            $("#data").html(data);
        }
    });
}
function reportChannel(userid, url, reportName, type) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            userid:userid,
            reportName:reportName,
            type: type,
        },
        success: function (data) {
            // alert(data);
            $("#saledata").hide();
            $("#saledata2").hide();
            $("#data").html(data);
        }
    });
}
function OTP(leadid,url){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            leadid:leadid,
        },
        success: function (data) {
            // alert(data);
            if(data == 1){
                alert('OTP SEND');
            }
            else{
                location.reload();
            }
            // $("#saledata").hide();
            // $("#saledata2").hide();
            // $("#data").html(data);
        }
    });
}
function manager_sale_report(userid,url,reportName){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            userid:userid,
            reportName:reportName
        },
        success: function (data) {
            // alert(data);
            $("#saledata").html(data);
        }
    });
}
function DetailReport(userid,url,reportName,ProductType){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            userid:userid,
            reportName:reportName,
            ProductType: ProductType,
        },
        success: function (data) {
            // alert(data);
            $("#saledata2").html(data);
        }
    });
}
function isNumberKey(evt) {
    var t = (evt.which) ? evt.which : event.keyCode;
    return !(t > 31 && (t < 48 || t > 57))
}
function plan_month(plan_name, ajaxName,ajaxUrl) {
    // var plan_name
    // alert(ajaxName);
    // alert(this.id);
    $.ajax({
        // e.preventDefault();
        type: "POST",
        url: ajaxUrl,
        data: {
            'ajaxName': ajaxName,
            'plan_name': plan_name,
            // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function () {
            // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function (value) {
            //   alert(value);
            var a = JSON.stringify(value);
            // alert(a);
            console.log(a);
            // var b =
            var obj = $.parseJSON(a);
            // console.log(obj['0']['flexible_minutes']);

            // alert(a[1]['plan_name']);

            // var data = value.split(",");
            // // alert(data[0]);
            $(".fname1").val(data[0]);
            $(".contract_commitment_1").text(obj['0']['duration']);
            $('.lm').val(obj['0']['local_minutes']);
            $('.fm').val(obj['0']['flexible_minutes']);
            $('.samina').val(obj['0']['data']);
            $('.pnum').val(obj['0']['number_allowed']);
            $('.fmnum').val(obj['0']['free_minutes']);
            $('.mp').val(obj['0']['revenue']);

         // $("#suggesstion-box2").show();
            // $("#suggesstion-box2").html(data);
            // $("#quick_search_text").css("background", "#FFF");
        }


  });
}
//
    function package_addon(package_id,Url){
        $.ajax({
            // e.preventDefault();
            type: "POST",
            url: Url,
            data: {
                'package_id': package_id,
                // 'plan_name': plan_name,
                // 'housess': housess
            },
            // data: {plan_name: plan_name},
            beforeSend: function () {
                // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
            },
            success: function (value) {
                $("#addon_fetch").html(value);
            }


        });
    }
    function elife_plan_month(plan_name, ajaxName,ajaxUrl) {
        // var plan_name
        // alert(ajaxName);
        // alert(this.id);
        $.ajax({
            // e.preventDefault();
            type: "POST",
            url: ajaxUrl,
            data: {
                'ajaxName': ajaxName,
                'plan_name': plan_name,
                // 'housess': housess
            },
            // data: {plan_name: plan_name},
            beforeSend: function () {
                // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
            },
            success: function (value) {
                //   alert(value);
                package_addon(plan_name, $("#elife_addon_url").val());
                var a = JSON.stringify(value);
                // alert(a);
                console.log(a);
                // var b =
                var obj = $.parseJSON(a);
                // console.log(obj['0']['flexible_minutes']);

                // alert(a[1]['plan_name']);

                // var data = value.split(",");
                // // alert(data[0]);
                $("#elife_package_name").val(obj['0']['plan_name']);
                $("#elife_speed").val(obj['0']['speed']);
                $('#elife_devices').val(obj['0']['devices']);
                $('#elife_mothly_charges').val(obj['0']['monthly_charges']);
                $('#elife_installation_charges').val(obj['0']['installation_charges']);
                $('#elife_contract').text(obj['0']['contract']);
                $('#contract_commitment_elife').val(obj['0']['contract']);

             // $("#suggesstion-box2").show();
                // $("#suggesstion-box2").html(data);
                // $("#quick_search_text").css("background", "#FFF");
            }


      });
    }
//
$("#c_select").on('change',function(){
    var a = $("#c_select").val();
    if (a != 'United Arab Emirates'){
        $("#sumebutton").hide();
    }
    else{
        $("#sumebutton").show();

    }
});
$('.sim_type').on('change', function () {
    // alert()
    // if(this)
    var sim_type = $(".sim_type").val();
    // alert(sim_type);
    if (sim_type == 'MNP' || sim_type == 'Migration') {
        $("#amount_control_line").hide();
        $(".postpaid_package").show();
        $(".elife_package").hide();
        $(".new_package").hide();
        $("#hideme_document").show();
        $(".hideonelife").show();
        $(".itp").hide();

    } else if (sim_type == 'Elife') {
        $("#amount_control_line").hide();
        $(".postpaid_package").hide();
        $(".new_package").hide();
        $(".elife_package").show();
        // $("#document_option").hide();
        $("#hideme_document").hide();
        $(".hideonelife").hide();
        $(".itp").hide();
        $("#zone").show();
        // check_elife_package()

    } else if (sim_type == 'New') {
        $("#amount_control_line").hide();
        $(".hideonelife").show();
        $(".postpaid_package").hide();
        $(".new_package").show();
        $(".elife_package").hide();
        $("#hideme_document").show();
        $(".itp").hide();

    }
    else if(sim_type == 'control line'){
        // alert("S");
        $("#zone").hide();
        $("#amount_control_line").show();
        var url = $("#ajaxUrlIT").val();
        fetch_package(sim_type,url);
        $(".itp").show();
    }
    else{
        // alert("S");
        $("#zone").hide();
        $("#amount_control_line").hide();
        var url = $("#ajaxUrlIT").val();
        fetch_package(sim_type,url);
        $(".itp").show();

    }
    // if (sim_type == 'MNP') {
    // alert("yes");
    //   $(".salman_ahmed").hide();
    // } else {
    //   alert("no");
    //   $(".salman_ahmed").show();
    // }
}); // $(".sim_type").on(change(func))
//
$('#klon1 .NumberDropDown').change(function (e) {
    // alert($(this).val());
    // alert("yes");
    var div = 'klon1 #mytypeval';
    var div2 = 'klon1 #c__select';
    // var div3 = 'klon2 #mytypeval';
    var url = $("#CheckPackageName").val();
    check_package_type(div,$(this).val(),url,div2);



    // $('#output').append('<p>' + $(this).val() + "</p>");
});

$("#klon1 .activation_charges").on('change', function () {
    // if(this).val(
    var ac = $(this).val();
    // var ac = $(".activation_charges").val();
    // alert(ac);
    if (ac == 'Paid') {
        $("#klon1 .activation_rate").show();
        $("#klon1 .activation_rate").val("130");

    } else if (ac == 'Free') {
        $("#klon1 .activation_rate").val("Free");
        $("#klon1 .activation_rate").hide();
        // $(".activation_rate").val("130");
        // $("#activation_rate").hide();
    }
});
//
$("body").on('change', '#klon2 .activation_charges', function () {
    var ac = $(this).val();
    if (ac == 'Paid') {
        $("#klon2 .activation_rate").show();
        $("#klon2 .activation_rate").val("130");
        // $("#klon2 .activation_rate").hide();

        // alert("p");

    } else if (ac == 'Free') {
        $("#klon2 .activation_rate").val("Free");
        $("#klon2 .activation_rate").hide();

    }
});
$("body").on('change', '#klon3 .activation_charges', function () {
    var ac = $(this).val();
    if (ac == 'Paid') {
        $("#klon3 .activation_rate").show();
        $("#klon3 .activation_rate").val("130");
        // $("#klon3 .activation_rate").hide();

        // alert("p");

    } else if (ac == 'Free') {
        $("#klon3 .activation_rate").val("Free");
        $("#klon3 .activation_rate").hide();

    }
});
//

$("body").on('change', '#klon4 .activation_charges', function () {
    var ac = $(this).val();
    if (ac == 'Paid') {
        $("#klon4 .activation_rate").show();
        $("#klon4 .activation_rate").val("130");
        // alert("p");

    } else if (ac == 'Free') {
        $("#klon4 .activation_rate").val("Free");
        $("#klon4 .activation_rate").hide();

    }
});
//
$("body").on('change', '#klon5 .activation_charges', function () {
    var ac = $(this).val();
    if (ac == 'Paid') {
        $("#klon5 .activation_rate").show();
        $("#klon5 .activation_rate").val("130");
        // alert("p");

    } else if (ac == 'Free') {
        $("#klon5 .activation_rate").val("Free");
        $("#klon5 .activation_rate").hide();

    }
});
//
$("#emirate_id").on('change', function () {
    var a = $("#emirate_id").val();
    // alert(a);
    if(a == 'Emirate ID'){
        $("#show_emirate_id").show();
        $("#show_passport").hide();
    }
    else{
        $("#show_emirate_id").hide();
        $("#show_passport").show();

    }
})
//
  $('.sim_type').on('change', function () {
      // alert()
      // if(this)
      var sim_type = $(".sim_type").val();
      // alert(sim_type);
    //   if (sim_type == 'MNP' || sim_type == 'Migration') {
    //       $(".postpaid_package").show();
    //       $(".elife_package").hide();
    //       $(".new_package").hide();
    //       $("#hideme_document").show();
    //       $(".hideonelife").show();

    //   } else if (sim_type == 'Elife') {
    //       $(".postpaid_package").hide();
    //       $(".new_package").hide();
    //       $(".elife_package").show();
    //       // $("#document_option").hide();
    //       $("#hideme_document").hide();
    //       $(".hideonelife").hide();
    //   } else if (sim_type == 'New') {
          $(".hideonelife").show();
          $(".postpaid_package").hide();
          $(".new_package").show();
          $(".elife_package").hide();
          $("#hideme_document").show();


    //   }
      // if (sim_type == 'MNP') {
      // alert("yes");
      //   $(".salman_ahmed").hide();
      // } else {
      //   alert("no");
      //   $(".salman_ahmed").show();
      // }
  }); // $(".sim_type").on(change(func))
$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};
//
function test_reject(e) {
    // e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire(
            //     'Deleted!',
            //     'Your lead has been rejected.',
            //     'success'
            // )
            $("form").submit();
        } else {
            e.preventDefault();
        }
    })
}
  $(document).ready(function() {

// $('.btn-danger').on('click', function (e) {
//     if (!confirm('Do you want to delete/Reject this lead/item?')) {
//         e.preventDefault();
//     }
// });



$('#sumebutton').click(function() {
      var numItems = $('.jackson_action').length;
      // alert(numItems);

      if (numItems == 1) {
          // alert("s");
          setTimeout(() => {
              $("#klon2 .select2-container").remove();
              $("#klon2 .NumberDropDown").empty();

          }, 100);
      } else if (numItems == 2) {
          setTimeout(() => {

          $("#klon3 .select2-container").remove();
          $("#klon3 .NumberDropDown").empty();
          }, 100);

        } else if (numItems == 3) {
            setTimeout(() => {

                $("#klon4 .NumberDropDown").empty();
                $("#klon4 .select2-container").remove();
            }, 100);

      }

      // var salman_ahmed = $(".jackson_action").length();
      // var l = salman_ahmed.length;
      // alert(salman_ahmed);
      if (numItems < 5) {
        // get the last DIV which ID starts with ^= "klon"
        var $div = $('div[id^="klon"]:last');
        // Read the Number from that DIV's ID (i.e: 3 from "klon3")
        // And increment that number by 1
        var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;
        // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
        var $klon = $div.clone(true).prop('id', 'klon' + num);
        // $klon.find(".NumberDropDown").each(function (index) {
        //     $(this).select2('destroy');
        // });
        var jackson_action = $(".jackson_action").html();
        // var salmanahmed = 'salmanahmed';

        // Finally insert $klon wherever you want
        $div.after($klon.html(jackson_action));
        $("#klon2 #mytypeval").change(function () {
            var id = $("#klon2 #mytypeval").val();
            var url = $("#AjaxUrl2").val();
            // alert(id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id,
                },
                url: url,
                cache: false,
                beforeSend: function () {
                    $("#klon2 #c__select").empty();
                },
                success: function (res) {
                    // location.reload();
                    if (res) {
                        $('#klon2 #c__select').append($("<option/>", {
                            value: '',
                            text: 'Select'
                        }));
                        $.each(res, function (key, value) {
                            $('#klon2 #c__select').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                    // var value = $.trim(value);
                    // $("#fetch_teacher").html(value);
                }
            });
            //
            setTimeout(() => {
                $('#klon2 .NumberDropDown').select2({
                    placeholder: 'Please Search Numbers',
                    // dropdownParent: $('#AddSkill'),
                    // tags: true,
                    minimumInputLength: 3,
                    ajax: {
                        url: '/skill-auto-complete?id=' + $("#klon2 #mytypeval").val() + '&pid=' + $("#type").val(),
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.number,
                                        id: item.number
                                    }
                                })
                            };

                        }
                    }
                });
            }, 1000);
            $('#klon2 .NumberDropDown').change(function (e) {
                // alert($(this).val());
                alert("yes");
                console.log("ssssss");
                var div = 'klon2 #mytypeval';
                var div2 = 'klon2 #c__select';
                var url = $("#CheckPackageName").val();
                check_package_type(div, $(this).val(), url,div2);
                // $('#output').append('<p>' + $(this).val() + "</p>");
            });
        });
        $("#klon3 #mytypeval").change(function () {
            var id = $("#klon3 #mytypeval").val();
            var url = $("#AjaxUrl2").val();
            // alert(id);
            //
        $("#klon3 .NumberDropDown").empty();
        $("#klon3 #lm").val('');
        $("#klon3 #fm").val('');
        $("#klon3 #data").val('');
        $("#klon3 #pnum").val('');
        $("#klon3 #fmnum").val('');
        $("#klon3 #mp1").val('');
        $("#klon3 #contract_commitment_1").text('');
    //
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id,
                },
                url: url,
                cache: false,
                beforeSend: function () {
                    $("#klon3 #c__select").empty();
                },
                success: function (res) {
                    // location.reload();
                    if (res) {
                        $('#klon3 #c__select').append($("<option/>", {
                            value: '',
                            text: 'Select'
                        }));
                        $.each(res, function (key, value) {
                            $('#klon3 #c__select').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                    // var value = $.trim(value);
                    // $("#fetch_teacher").html(value);
                }
            });
            //
            setTimeout(() => {
                $('#klon3 .NumberDropDown').select2({
                    placeholder: 'Please Search Numbers',
                    // dropdownParent: $('#AddSkill'),
                    // tags: true,
                    minimumInputLength: 3,
                    ajax: {
                        url: '/skill-auto-complete?id=' + $("#klon3 #mytypeval").val() + '&pid=' + $("#type").val(),
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.number,
                                        id: item.number
                                    }
                                })
                            };

                        }
                    }
                });
            }, 1000);
        });
        $("#klon4 #mytypeval").change(function () {
            var id = $("#klon4 #mytypeval").val();
            var url = $("#AjaxUrl2").val();
            // alert(id);
            //
            $("#klon4 .NumberDropDown").empty();
            $("#klon4 #lm").val('');
            $("#klon4 #fm").val('');
            $("#klon4 #data").val('');
            $("#klon4 #pnum").val('');
            $("#klon4 #fmnum").val('');
            $("#klon4 #mp1").val('');
            $("#klon4 #contract_commitment_1").text('');
        //
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id,
                },
                url: url,
                cache: false,
                beforeSend: function () {
                    $("#klon4 #c__select").empty();
                },
                success: function (res) {
                    // location.reload();
                    if (res) {
                        $('#klon4 #c__select').append($("<option/>", {
                            value: '',
                            text: 'Select'
                        }));
                        $.each(res, function (key, value) {
                            $('#klon4 #c__select').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                    // var value = $.trim(value);
                    // $("#fetch_teacher").html(value);
                }
            });
            //
            setTimeout(() => {
                $('#klon4 .NumberDropDown').select2({
                    placeholder: 'Please Search Numbers',
                    // dropdownParent: $('#AddSkill'),
                    // tags: true,
                    minimumInputLength: 3,
                    ajax: {
                        url: '/skill-auto-complete?id=' + $("#klon4 #mytypeval").val() + '&pid=' + $("#type").val(),
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.number,
                                        id: item.number
                                    }
                                })
                            };

                        }
                    }
                });
            }, 1000);
            });

        }

});

$("#klon1 .c__select").on('change', function() {
      // alert("yes");
      var plan_name = $(this).val();
      var AjaxUrl = $("#AjaxUrl").val();
      $.ajax({
        // e.preventDefault();
        type: "POST",
        url: AjaxUrl,
        data: {
            'ajaxName': 'PlanFetch',
            'plan_name': plan_name,
          // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function() {
        //   $("div#divLoading").addClass('show');
          // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function(value) {

        var a = JSON.stringify(value);
        // alert(a);
        console.log(a);
        // var b =
        var obj = $.parseJSON(a);
        // console.log(obj['0']['flexible_minutes']);

        // alert(a[1]['plan_name']);

        // var data = value.split(",");
        // // alert(data[0]);
            $("#klon1 .fname1").val(data[0]);
            $("#klon1 .contract_commitment_1").text(obj['0']['duration']);
            $('#klon1 .lm').val(obj['0']['local_minutes']);
            $('#klon1 .fm').val(obj['0']['flexible_minutes']);
            $('#klon1 .samina').val(obj['0']['data']);
            $('#klon1 .pnum').val(obj['0']['number_allowed']);
            $('#klon1 .fmnum').val(obj['0']['free_minutes']);
            $('#klon1 .mp').val(obj['0']['monthly_payment']);
          // $("#suggesstion-box2").show();
          // $("#suggesstion-box2").html(data);
          // $("#quick_search_text").css("background", "#FFF");
        }
      });
      // alert("1" + k);
    });
    // $('body').on('click', '#klon2', function() {
    // do something
    // alert("damn");
    // });
    // $("#klon1").click(function(){
    // })

    $("body").on('change', '#klon2 .c__select', function() {
      // alert("yes");
      // var k = $(this).val();
      // alert(k);
      var plan_name = $(this).val();
      var AjaxUrl = $("#AjaxUrl").val();
      // alert(plan_name);
      $.ajax({
        // e.preventDefault();
        type: "POST",
        url: AjaxUrl,
        data: {
            'ajaxName': 'PlanFetch',
            'plan_name': plan_name,
          // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function() {
        //   $("div#divLoading").addClass('show');

          // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function(value) {
          var a = JSON.stringify(value);
          // alert(a);
          console.log(a);
          // var b =
          var obj = $.parseJSON(a);
          // console.log(obj['0']['flexible_minutes']);

          // alert(a[1]['plan_name']);

          // var data = value.split(",");
          // // alert(data[0]);
          $("#klon2 .fname1").val(data[0]);
          $("#klon2 .contract_commitment_1").text(obj['0']['duration']);
          $('#klon2 .lm').val(obj['0']['local_minutes']);
          $('#klon2 .fm').val(obj['0']['flexible_minutes']);
          $('#klon2 .samina').val(obj['0']['data']);
          $('#klon2 .pnum').val(obj['0']['number_allowed']);
          $('#klon2 .fmnum').val(obj['0']['free_minutes']);
          $('#klon2 .mp').val(obj['0']['monthly_payment']);
          // $("#suggesstion-box2").show();
          // $("#suggesstion-box2").html(data);
          // $("#quick_search_text").css("background", "#FFF");
          }
      });
    });
    $("body").on('change', '#klon3 .c__select', function() {
      // alert("yes");
      // var k = $(this).val();
      // alert(k);
      var plan_name = $(this).val();
      var AjaxUrl = $("#AjaxUrl").val();
      // alert(plan_name);
      $.ajax({
        // e.preventDefault();
        type: "POST",
        url: AjaxUrl,
        data: {
            'ajaxName': 'PlanFetch',
            'plan_name': plan_name,
          // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function() {
        //   $("div#divLoading").addClass('show');

          // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function(value) {
          var a = JSON.stringify(value);
          // alert(a);
          console.log(a);
          // var b =
          var obj = $.parseJSON(a);
          // console.log(obj['0']['flexible_minutes']);

          // alert(a[1]['plan_name']);

          // var data = value.split(",");
          // // alert(data[0]);
          $("#klon3 .fname1").val(data[0]);
          $("#klon3 .contract_commitment_1").text(obj['0']['duration']);
          $('#klon3 .lm').val(obj['0']['local_minutes']);
          $('#klon3 .fm').val(obj['0']['flexible_minutes']);
          $('#klon3 .samina').val(obj['0']['data']);
          $('#klon3 .pnum').val(obj['0']['number_allowed']);
          $('#klon3 .fmnum').val(obj['0']['free_minutes']);
          $('#klon3 .mp').val(obj['0']['monthly_payment']);
          // $("#suggesstion-box2").show();
          // $("#suggesstion-box2").html(data);
          // $("#quick_search_text").css("background", "#FFF");
          }
      });
    });
    $("body").on('change', '#klon4 .c__select', function() {
      // alert("yes");
      // var k = $(this).val();
      // alert(k);
      var plan_name = $(this).val();
      var AjaxUrl = $("#AjaxUrl").val();
      // alert(plan_name);
      $.ajax({
        // e.preventDefault();
        type: "POST",
        url: AjaxUrl,
        data: {
            'ajaxName': 'PlanFetch',
            'plan_name': plan_name,
          // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function() {
        //   $("div#divLoading").addClass('show');

          // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function(value) {
          var a = JSON.stringify(value);
          // alert(a);
          console.log(a);
          // var b =
          var obj = $.parseJSON(a);
          // console.log(obj['0']['flexible_minutes']);

          // alert(a[1]['plan_name']);

          // var data = value.split(",");
          // // alert(data[0]);
          $("#klon4 .fname1").val(data[0]);
          $("#klon4 .contract_commitment_1").text(obj['0']['duration']);
          $('#klon4 .lm').val(obj['0']['local_minutes']);
          $('#klon4 .fm').val(obj['0']['flexible_minutes']);
          $('#klon4 .samina').val(obj['0']['data']);
          $('#klon4 .pnum').val(obj['0']['number_allowed']);
          $('#klon4 .fmnum').val(obj['0']['free_minutes']);
          $('#klon4 .mp').val(obj['0']['monthly_payment']);
          // $("#suggesstion-box2").show();
          // $("#suggesstion-box2").html(data);
          // $("#quick_search_text").css("background", "#FFF");
          }
      });
    });
    $("body").on('change', '#klon5 .c__select', function() {
      // alert("yes");
      // var k = $(this).val();
      // alert(k);
      var plan_name = $(this).val();
      var AjaxUrl = $("#AjaxUrl").val();
      // alert(plan_name);
      $.ajax({
        // e.preventDefault();
        type: "POST",
        url: AjaxUrl,
        data: {
            'ajaxName': 'PlanFetch',
            'plan_name': plan_name,
          // 'housess': housess
        },
        // data: {plan_name: plan_name},
        beforeSend: function() {
        //   $("div#divLoading").addClass('show');

          // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
        },
        success: function(value) {
          var a = JSON.stringify(value);
          // alert(a);
          console.log(a);
          // var b =
          var obj = $.parseJSON(a);
          // console.log(obj['0']['flexible_minutes']);

          // alert(a[1]['plan_name']);

          // var data = value.split(",");
          // // alert(data[0]);
          $("#klon5 .fname1").val(data[0]);
          $("#klon5 .contract_commitment_1").text(obj['0']['duration']);
          $('#klon5 .lm').val(obj['0']['local_minutes']);
          $('#klon5 .fm').val(obj['0']['flexible_minutes']);
          $('#klon5 .samina').val(obj['0']['data']);
          $('#klon5 .pnum').val(obj['0']['number_allowed']);
          $('#klon5 .fmnum').val(obj['0']['free_minutes']);
          $('#klon5 .mp').val(obj['0']['monthly_payment']);
          // $("#suggesstion-box2").show();
          // $("#suggesstion-box2").html(data);
          // $("#quick_search_text").css("background", "#FFF");
          }
      });
    });
    // $("body").on('change', '#klon4 .c__select', function() {
    //   // alert("yes");
    //   // var k = $(this).val();
    //   // alert(k);
    //   var plan_name = $(this).val();
    //   $.ajax({
    //     // e.preventDefault();
    //     type: "POST",
    //     url: "ajax/ReadPlanName.php",
    //     data: {
    //       'plan_name': plan_name,
    //       // 'housess': housess
    //     },
    //     // data: {plan_name: plan_name},
    //     beforeSend: function() {
    //       $("div#divLoading").addClass('show');

    //       // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
    //     },
    //     success: function(value) {
    //       $("div#divLoading").removeClass('show');

    //       var data = value.split(",");
    //       // alert(data[0]);
    //       $("#klon4 .fname1").val(data[0]);
    //       $("#klon4 .contract_commitment_1").text(data[0]);
    //       $('#klon4 .lm').val(data[1]);
    //       $('#klon4 .fm').val(data[2]);
    //       $('#klon4 .samina').val(data[3]);
    //       $('#klon4 .pnum').val(data[4]);
    //       $('#klon4 .fmnum').val(data[5]);
    //       $('#klon4 .mp').val(data[6]);
    //       // $("#suggesstion-box2").show();
    //       // $("#suggesstion-box2").html(data);
    //       // $("#quick_search_text").css("background", "#FFF");
    //     }
    //   });
    // });
    // $("body").on('change', '#klon5 .c__select', function() {
    //   // alert("yes");
    //   // var k = $(this).val();
    //   // alert(k);
    //   var plan_name = $(this).val();
    //   $.ajax({
    //     // e.preventDefault();
    //     type: "POST",
    //     url: "ajax/ReadPlanName.php",
    //     data: {
    //       'plan_name': plan_name,
    //       // 'housess': housess
    //     },
    //     // data: {plan_name: plan_name},
    //     beforeSend: function() {
    //       $("div#divLoading").addClass('show');

    //       // $("#quick_search_text").css("background", "#FFF url(include/ajax/loading.gif) no-repeat 165px");
    //     },
    //     success: function(value) {
    //       $("div#divLoading").removeClass('show');

    //       var data = value.split(",");
    //       // alert(data[0]);
    //       $("#klon5 .fname1").val(data[0]);
    //       $("#klon5 .contract_commitment_1").text(data[0]);
    //       $('#klon5 .lm').val(data[1]);
    //       $('#klon5 .fm').val(data[2]);
    //       $('#klon5 .samina').val(data[3]);
    //       $('#klon5 .pnum').val(data[4]);
    //       $('#klon5 .fmnum').val(data[5]);
    //       $('#klon5 .mp').val(data[6]);
    //       // $("#suggesstion-box2").show();
    //       // $("#suggesstion-box2").html(data);
    //       // $("#quick_search_text").css("background", "#FFF");
    //     }
    //   });
    // });
  });
//

// pre_verification_js
$(".box:checked").next().addClass("blue");


  //
  $('#state').change(function() {
    $('#province').attr('disabled', this.value == "other1");
  });

  $("#state2").change(function() {
    $("#province2").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state3").change(function() {
    $("#province3").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state4").change(function() {
    $("#province4").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state_emirates").change(function() {
    // alert("s");
    $("#province_emirates").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state_language").change(function() {
    // alert("s");
    $("#province_language").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state5").change(function() {
    $("#province5").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state_emirate_num").change(function() {
    $("#province_original_id1").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state6").change(function() {
    $("#province6").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state7").change(function() {
    $("#province7").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state8").change(function() {
    $("#province8").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state9").change(function() {
    $("#province9").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state10").change(function() {
    $("#province10").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state11").change(function() {
    $("#province11").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state12").change(function() {
    $("#province12").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state13").change(function() {
    $("#province13").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state14").change(function() {
    $("#province14").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#device_duration_state").change(function() {
    $("#device_duration").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state15").change(function() {
    $("#province15").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state16").change(function() {
    $("#province16").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $("#state17").change(function() {
    $("#province17").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state18").change(function() {
    $("#province18").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });
  $("#state19").change(function() {
    $("#province19").attr("disabled", this.value == "other1");
    // or $("#flap-drop").toggle(this.value!="23");
  });

  $(document).ready(function() {

    var pathname = window.location.pathname; // Returns path only (/path/example.html)
    // alert(pathname);
if (pathname.indexOf("verification") >= 0)
{



    $("#klon1").find('input, textarea, button, select').attr('disabled', 'disabled');
    // $("#klon2").find('input, textarea, button, select').attr('disabled', 'disabled');
    $("#klon2").find('input, textarea, button, select').attr('disabled', 'disabled');
    $("#klon3").find('input, textarea, button, select').attr('disabled', 'disabled');
    $("#klon4").find('input, textarea, button, select').attr('disabled', 'disabled');
    $("#klon5").find('input, textarea, button, select').attr('disabled', 'disabled');
    $(".klon_verify").attr('disabled', false);
    $(".klon_verify").prop('disabled', false);
}
else if(pathname.indexOf("admin/lead") >=0){
    var t = $("#simtype").val();
    var url = $("#ajaxUrlIT").val();

    console.log(t);
    if(t == 'MNP' || t == 'Migration'){
        var url2 = $("#ajaxUrlMNP").val();
        plan_month($(".plan_mnp").val(), 'PlanFetch', url2);
    }
    else{
        fetch_package(t, url);
        setTimeout(() => {
            itplan($("#itplanid").val(), $("#itplanurl").val());
            $("#package_id").val($("#itplanid").val());
        }, 1000);
    }
}
    $('#province').change(function() {
      $('#province1').val($('#province').val());
    });

    $('#province2').change(function() {
      $('#province22').val($('#province2').val());
    });

    $('#province3').change(function() {
      $('#province33').val($('#province3').val());
    });
    $('#province4').change(function() {
      $('#province44').val($('#province4').val());
    });
    $('#province_original_id1').change(function() {
      $('#province_original_id11').val($('#province_original_id1').val());
    });
    $('#province5').change(function() {
      $('#province55').val($('#province5').val());
    });
    $('#province6').change(function() {
      $('#province66').val($('#province6').val());
    });
    $('#province7').change(function() {
      $('#province77').val($('#province7').val());
    });
    $('#province8').change(function() {
      $('#province88').val($('#province8').val());
    });
    $('#province9').change(function() {
      $('#province99').val($('#province9').val());
    });
    $('#province10').change(function() {
      $('#province100').val($('#province10').val());
    });
    $('#province11').change(function() {
      $('#province111').val($('#province11').val());
    });
    $('#province12').change(function() {
      $('#province112').val($('#province12').val());
    });
    $('#province13').change(function() {
      $('#province113').val($('#province13').val());
    });
    $('#province14').change(function() {
      $('#province114').val($('#province14').val());
    });
    $('#province15').change(function() {
      $('#province115').val($('#province15').val());
    });
    $('#province16').change(function() {
      $('#province116').val($('#province16').val());
    });
    $('#province17').change(function() {
      $('#province117').val($('#province17').val());
    });
    $('#province_emirates').change(function() {
      $('#province__emirates').val($('#province_emirates').val());
    });
    $('#province_language').change(function() {
      $('#province__language').val($('#province_language').val());
    });
    $('#province18').change(function() {
      $('#province118').val($('#province18').val());
    });
    $('#province19').change(function() {
      $('#province119').val($('#province19').val());
    });

    $('#province_local_minutes').change(function() {
      $('#province_local_minutes1').val($('#province_local_minutes').val());
    });

    $('#preffered_number_allowed').change(function() {
      $('#preffered_number_allowed1').val($('#preffered_number_allowed').val());
    });


    $('#free_minutes').change(function() {
      $('#free_minutes1').val($('#free_minutes').val());
    });

    $('#mobile_payment').change(function() {
      $('#mobile_payment1').val($('#mobile_payment').val());
    });

    $('#device_duration').change(function() {
      $('#device_duration1').val($('#device_duration').val());
    });
    $("#show_sumebutton").click(function() {
      $("#show_sumebutton").hide();
      $("#sumebutton").show();
    });
    });

    // activation page
        $('#add_audio').click(function () {
            var numItems = $('.audio_action').length;

            // alert(numItems);

            // var salman_ahmed = $(".jackson_action").length();
            // var l = salman_ahmed.length;
            // alert(salman_ahmed);
            if (numItems < 8) {






                // get the last DIV which ID starts with ^= "klon"
                var $div = $('div[id^="klon_audio"]:last');

                // Read the Number from that DIV's ID (i.e: 3 from "klon3")
                // And increment that number by 1
                var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;

                // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
                var $klon = $div.clone(true).prop('id', 'klon_audio' + num);
                var jackson_action = $(".audio_action").html();
                var salmanahmed = 'salmanahmed';


                // Finally insert $klon wherever you want
                $div.after($klon.html(jackson_action));
            }

        });

        $(".select2").select2({
            //   dropdownParent: $('#AddSkill'),
        });
$("#klon1 #mytypeval").change(function(){
    //
    var ac = $(this).val();
    // var
    // alert(ac);
    if(ac == 'my'){

    }
    else{

        var url3 = $("#AjaxUrl3").val();
        // alert(url3);
        checkNumData(url3);
    }
    //
    var id = $("#klon1 #mytypeval").val();
    var url = $("#AjaxUrl2").val();
    // alert(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            id: id,
        },
        url: url,
        cache: false,
        beforeSend: function () {
            $("#klon1 #c__select").empty();
        },
        success: function (res) {
            // location.reload();
            if (res) {
                $('#klon1 #c__select').append($("<option/>", {
                    value: '',
                    text: 'Select'
                }));
                $.each(res, function (key, value) {
                    $('#klon1 #c__select').append($("<option/>", {
                        value: key,
                        text: value
                    }));
                });
            }
            // var value = $.trim(value);
            // $("#fetch_teacher").html(value);
        }
    });
    $("#klon1 #mytypeval").change(function(){
        $("#klon1 .NumberDropDown").empty();
        $("#klon1 #lm").val('');
        $("#klon1 #fm").val('');
        $("#klon1 #data").val('');
        $("#klon1 #pnum").val('');
        $("#klon1 #fmnum").val('');
        $("#klon1 #mp1").val('');
        $("#klon1 #contract_commitment_1").text('');
    })
    //
    $('#klon1 .NumberDropDown').select2({
        placeholder: 'Please Search Numbers',
        // dropdownParent: $('#AddSkill'),
        // tags: true,
        minimumInputLength: 3,
        ajax: {
            url: '/skill-auto-complete?id=' + $("#klon1 #mytypeval").val() + '&pid=' + $("#type").val(),
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.number,
                            id: item.number
                        }
                    })
                };

            }
        }
    });
});
$("#klon2 #mytypeval").change(function(){
    //
        $("#klon2 .NumberDropDown").empty();
        $("#klon2 #lm").val('');
        $("#klon2 #fm").val('');
        $("#klon2 #data").val('');
        $("#klon2 #pnum").val('');
        $("#klon2 #fmnum").val('');
        $("#klon2 #mp1").val('');
        $("#klon2 #contract_commitment_1").text('');
    //
    setTimeout(() => {
        $('#klon2 .NumberDropDown').select2({
            placeholder: 'Please Search Numbers',
            // dropdownParent: $('#AddSkill'),
            // tags: true,
            minimumInputLength: 3,
            ajax: {
                url: '/skill-auto-complete?id=' + $("#klon2 #mytypeval").val() + '&pid=' + $("#type").val(),
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.number,
                                id: item.number
                            }
                        })
                    };

                }
            }
        });
    }, 1000);
});
// var sam = $("#type").val();
// var sam2 = $('input[name="numbertype"]:checked').val();
// var sam2 = "";
// if (sam2.length > 0) {
    // sam2 = selected.val();
    // }
// if ($('input.numbertype').prop('checked')) {
//         //blah blah
//         var sam2 = $('input[name="numbertype"]:checked').val();
// }
// $(".numbertype").click(function(){
//    $("#mytypeval").val($('input[name="numbertype"]:checked').val());
// });
// var sam2 = $("#mytypeval").val();
// var sam2 = $("#silver").val();
//
// function fetch_new_package(id, url) {
//     //    var class_add = 'fetch_teacher';
//     // alert(id);
//     // alert(url);
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         type: 'POST',
//         data: {
//             id: id,
//         },
//         url: url,
//         cache: false,
//         beforeSend: function () {
//             $("#klon1 #c__select").empty();
//         },
//         success: function (res) {
//             // location.reload();
//             if (res) {
//                 $('#klon1 #c__select').append($("<option/>", {
//                     value: '',
//                     text: 'Select'
//                 }));
//                 $.each(res, function (key, value) {
//                     $('#klon1 #c__select').append($("<option/>", {
//                         value: key,
//                         text: value
//                     }));
//                 });
//             }
//             // var value = $.trim(value);
//             // $("#fetch_teacher").html(value);
//         }
//     });

// }
//

$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $(".chat-window:last-child").css("margin-left");
    size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $("#chat_window_1").clone().appendTo(".container");
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $("#chat_window_1").remove();
});
$('.myDatepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD hh:mm:ss'
});
$('.myDatepicker2').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD hh:mm:ss'
});
$(document).ready(function () {
    $('#pdf').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});


//
function BulkAssigner(url, form) {
    // alert(form);
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#request_login" + id).show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
            $("#loading_num").show();
        },
        success: function (msg) {
            //    alert(msg);
            if (msg == 1) {
                $("#loading_num").hide();
                location.reload();
            } else {
                alert("Something wrong");
            }
            //  var k = msg.split('###');
            // // console.log(k[3] + ' ' + $k[4]);
            //  $("#name").val(k[1]);
            //  $("#CustomerNameAct").val(k[1]);
            //  $("#emirate_id").val(k[2]);
            //  $("#activation_emirate_expiry").val(k[2]);
            //  $("#application_date").val(k[3] + ' ' + k[4]);
        }
        // }
    });
    // }
    // }));
}
setInterval(() => {
    var count = $("#number :selected").length;
    // console.log(count);
    $("#selected_number").text(count);

}, 0);

function CallLogForm(id, form, url) {
    var rizwan = document.getElementById(form);
    // $("#btn_"+id).removeClass('btn-danger'); //versions newer than 1.6
    // $("#btn_"+id).AddClass('btn-danger'); //versions newer than 1.6
    // alert(id);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#request_login" + id).show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (msg) {
            //    alert(msg);
            if (msg == 1) {
                $("#btn_" + id).prop('value', 'Submitted'); //versions newer than 1.6
                $("#btn_" + id).prop('disabled', true); //versions newer than 1.6
            } else {
                // alert("Something Wrong");
                alert(msg.error);
            }
            // var k = msg.split('###');
            // $("#dob").val(k[1]);
            // $("#expiry").val(k[2]);
            // $("#activation_emirate_expiry").val(k[2]);
            // var age = getAge(k[1]);
            // $("#age").val(age);
            // //  alert(age);

            // if (age < 21) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Age less than 21',
            //         text: 'User is not eligible for this package!',
            //         //  footer: '<a href>Why do I have this issue?</a>'
            //     })
            // }
        }
        // }
    });

}
function CallLogFormLead(id, form, url,redirect) {
    var rizwan = document.getElementById(form);
    // $("#btn_"+id).removeClass('btn-danger'); //versions newer than 1.6
    // $("#btn_"+id).AddClass('btn-danger'); //versions newer than 1.6
    // alert(id);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            // $("#request_login" + id).show();
            // // $(".request_call").hide();
            // $('#' + btn).prop('disabled', true);
        },
        success: function (msg) {
            //    alert(msg);
            // alert(redirect);
            if (msg == 1) {
                // $("#btn_" + id).prop('value', 'Submitted'); //versions newer than 1.6
                // $("#btn_" + id).prop('disabled', true); //versions newer than 1.6
                // window.location.href = redirect;
                alert("wait meanwhile we are redirecting you...");
                location.href = redirect;
            } else {
                // alert("Something Wrong");
                alert(msg.error);
            }
            // var k = msg.split('###');
            // $("#dob").val(k[1]);
            // $("#expiry").val(k[2]);
            // $("#activation_emirate_expiry").val(k[2]);
            // var age = getAge(k[1]);
            // $("#age").val(age);
            // //  alert(age);

            // if (age < 21) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Age less than 21',
            //         text: 'User is not eligible for this package!',
            //         //  footer: '<a href>Why do I have this issue?</a>'
            //     })
            // }
        }
        // }
    });

}
//
function VerifyLead(url, form, redirect) {
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $("#loading_num3").show();
            // // $(".request_call").hide();
            $('.btn').prop('disabled', true);
            // $('#' + btn).prop('disabled', true);

        },
        success: function (data) {
            // alert(data);
            if ($.isEmptyObject(data.error)) {
                $("#loading_num3").hide();
                $('.btn').prop('disabled', false);
                // alert(data.success);
                // window.location.href = data.success;
                // // window.open = data.success;
                // window.open(data.success, '_blank');
                if (redirect == 'LoadTable'){
                    location.reload();
                }else{

                    setTimeout(() => {
                        // alert(data.success);
                        alert("wait meanwhile we are redirecting you...");
                        window.location.href = redirect;
                    }, 3000);
                }
            } else {
                $('.btn').prop('disabled', false);
                // alert("S");
                $("#loading_num3").hide();

                printErrorMsg(data.error);
            }
        }

    });
}
//
function SavingActivationLead(url, form) {
    // alert(form);


    var rizwan = document.getElementById(form);


    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $("#loading_num3").show();
            // // $(".request_call").hide();
            $('.btn').prop('disabled', true);
            // $('#' + btn).prop('disabled', true);

        },
        success: function (data) {
            // alert(data);
            if ($.isEmptyObject(data.error)) {
                alert(data.success);
                $("#loading_num3").hide();
                $('.btn').prop('disabled', false);
                window.location.href = 'https://soft.riuman.com/admin/activation'
            } else {
                $('.btn').prop('disabled', false);
                // alert("S");
                $("#loading_num3").hide();

                printErrorMsg(data.error);
            }
        }
        // success: function (msg) {
        //     //    alert(msg);
        //     // $("#loading_num2").hide();
        //     // var k = msg.split('###');
        //     // $("#dob").val(k[1]);
        //     // $("#expiry").val(k[2]);
        //     // $("#activation_emirate_expiry").val(k[2]);
        // },
        // error: function () {
        //     // alert(xhr);
        //     $('#validation-errors').html('');
        //     $.each(xhr.responseJSON.errors, function (key, value) {
        //         $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
        //     });
        // },
        // }
    });
}
//

function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}

function ModalForm(url, form) {
    var rizwan = document.getElementById(form);
    $.ajax({
        type: "POST",
        url: url,
        data: new FormData(rizwan), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $("#loading_num2").show();
        },
        success: function (msg) {
            if(msg == 1){
                $(".modal").modal('toggle');
                alert("Succesfully Verified")
            }
            else{
                $(".modal").modal('toggle');
                alert("Succesfully Verified")
            }
        }
        // }
    });
}
//
// function isLeapYear(Year: number){
//     return new Date(Year, 1,29).getDate() === 29;

// }

// export default isLeapYear
function AgencyID(url){
    // alert(url);
    var id = $("#AgencyID").val();
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id: id,
        },
        success: function (data) {
            if(data > 0){
                $("#BillingDiv").show();
                $("#BillingAmount").val(data);
                $("#BillingAmountVal").val(data);
                $("#agency_id").val(id);
            }else{
                alert("Don't Have Enough Balance to proceed");
                $("#BillingDiv").hide();
                $("#BillingAmount").val('0');
                $("#BillingAmountVal").val('0');
                $("#agency_id").val(id);

            }
        }
    });
}


