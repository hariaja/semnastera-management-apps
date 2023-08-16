let table;

$(() => {
    table = $(".table").DataTable();

    $("#status").on("change", function (e) {
        table.draw();
        e.preventDefault();
    });

    $("#roles").on("change", function (e) {
        table.draw();
        e.preventDefault();
    });
});

function deleteUser(url) {
    Swal.fire({
        icon: "warning",
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
        showCancelButton: true,
        confirmButtonText: "Hapus Data",
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#E74C3C",
        confirmButtonColor: "#3498DB",
    }).then((result) => {
        if (result.value) {
            $.post(url, {
                _token: $("[name=csrf-token]").attr("content"),
                _method: "delete",
            })
                .done((response) => {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        confirmButtonText: "Selesai",
                    });
                    table.ajax.reload();
                })
                .fail((errors) => {
                    Swal.fire({
                        icon: "error",
                        title: errors.responseJSON.message,
                        confirmButtonText: "Mengerti",
                    });
                    return;
                });
        } else if (result.dismiss == swal.DismissReason.cancel) {
            Swal.fire({
                icon: "error",
                title: "Tidak ada perubahan disimpan",
                confirmButtonText: "Mengerti",
                confirmButtonColor: "#3498DB",
            });
        }
    });
}

$(document).on("click", ".delete-users", function (e) {
    e.preventDefault();
    let url = urlDestroy;
    url = url.replace(":uuid", $(this).data("uuid"));
    deleteUser(url);
});

function statusUser(url) {
    Swal.fire({
        icon: "warning",
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol <b>Ubah Status</b>, Maka <b>Status</b> akan berubah!",
        showCancelButton: true,
        confirmButtonText: "Ubah Status Akun Pengguna",
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#E74C3C",
        confirmButtonColor: "#3498DB",
    }).then((result) => {
        if (result.value) {
            $.post(url, {
                _token: $("[name=csrf-token]").attr("content"),
                _method: "patch",
            })
                .done((response) => {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        confirmButtonText: "Selesai",
                    });
                    table.ajax.reload();
                })
                .fail((errors) => {
                    Swal.fire({
                        icon: "error",
                        title: errors.responseJSON.message,
                        confirmButtonText: "Mengerti",
                    });
                    return;
                });
        } else if (result.dismiss == swal.DismissReason.cancel) {
            Swal.fire({
                icon: "error",
                title: "Tidak ada perubahan disimpan",
                confirmButtonText: "Mengerti",
                confirmButtonColor: "#3498DB",
            });
        }
    });
}

$(document).on("click", ".status-users", function (e) {
    e.preventDefault();
    let url = urlStatus;
    url = url.replace(":uuid", $(this).data("uuid"));
    statusUser(url);
});
