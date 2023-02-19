function kc_1() {
    Swal({
        title: 'Xác nhận đổi kim cương!',
        text: "Bạn có chắc muốn đổi 300 điểm thành 580 kim cương?!",
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: 'Change/500point.php',
                type: 'post',
                dataType : "json",
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal({
                    title: "Thông báo",
                    text:  data.msg,
                    type:  data.error
                });
                },
                error: function(data) {
                    Swal('Có lỗi xảy ra!', data.responseJSON.error, 'error')
                }
            })
        }
    })
}

function kc_2() {
    Swal({
        title: 'Xác nhận đổi kim cương!',
        text: "Bạn có chắc muốn đổi 600 điểm thành 1190 kim cương?!",
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: 'Change/1000point.php',
                type: 'post',
                dataType : "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal({
                    title: "Thông báo",
                    text:  data.msg,
                    type:  data.error
                });
                },
                error: function(data) {
                    Swal('Có lỗi xảy ra!', data.responseJSON.error, 'error')
                }
            })
        }
    })
}
function kc_3() {
    Swal({
        title: 'Xác nhận đổi kim cương!',
        text: "Bạn có chắc muốn đổi 1200 điểm thành 3050 kim cương?!",
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: 'Change/3050.php',
                type: 'post',
                dataType : "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal({
                    title: "Thông báo",
                    text:  data.msg,
                    type:  data.error
                });
                },
                error: function(data) {
                    Swal('Có lỗi xảy ra!', data.responseJSON.error, 'error')
                }
            })
        }
    })
}
function kc_4() {
    Swal({
        title: 'Xác nhận đổi kim cương!',
        text: "Bạn có chắc muốn đổi 2400 điểm thành 6100 kim cương?!",
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: 'Change/6100.php',
                type: 'post',
                dataType : "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal({
                    title: "Thông báo",
                    text:  data.msg,
                    type:  data.error
                });
                },
                error: function(data) {
                    Swal('Có lỗi xảy ra!', data.responseJSON.error, 'error')
                }
            })
        }
    })
}

