$(() => {
    var today = new Date();

    var start_date_calendar = flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        minDate: today,
        onChange: function (selectedDates, dateStr, instance) {
            end_date_calendar.set("minDate", dateStr);
            end_date_calendar.setDate(dateStr); // Memastikan tanggal end_date tidak kurang dari start_date
            document.querySelector("#end_date").disabled = false; // Mengaktifkan end_date setelah start_date dipilih
        },
    });

    var end_date_calendar = flatpickr("#end_date", {
        dateFormat: "Y-m-d",
        minDate: today,
        disable: [true], // Menonaktifkan end_date awalnya
        onReady: function () {
            document.querySelector("#end_date").disabled = true; // Pastikan end_date dinonaktifkan saat halaman dimuat
        },
    });
});
