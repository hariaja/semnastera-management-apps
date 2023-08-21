let table;

$(() => {
    table = $(".table").DataTable();
});

function deleteSchedule(url) {
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

function showSchedule(url) {
    const modal = $("#modal-show-schedule");
    const modalContent = modal.find(".modal-content");

    modal.modal("show");
    modal.find(".block-title").text("Detail Jadwal Kegiatan");

    $.get(url).done((response) => {
        const schedule = response;
        const program = schedule.program;

        const scheduleElements = {
            "#schedule-type": schedule.type,
            "#schedule-start-date": schedule.start,
            "#schedule-end-date": schedule.end,
            "#schedule-status": schedule.status,
            "#program-name": program.name,
            "#program-location": program.location,
            "#program-responsible": program.responsible,
        };

        Object.entries(scheduleElements).forEach(([selector, value]) => {
            modalContent.find(selector).text(value);
        });
    });
}

$(document).on("click", ".delete-schedules", function (e) {
    e.preventDefault();
    let url = urlDestroy;
    url = url.replace(":uuid", $(this).data("uuid"));
    deleteSchedule(url);
});

$(document).on("click", ".show-schedules", function (e) {
    e.preventDefault();
    let url = urlShow;
    url = url.replace(":uuid", $(this).data("uuid"));
    showSchedule(url);
});
