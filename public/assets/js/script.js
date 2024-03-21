$(document).ready(function () {});
function buttonEntriPadam() {
    var penyebab_padam = document.getElementById("penyebab_padam").value;
    var penyulang = document.getElementById("penyulang").value;
    var checkboxes = document.querySelectorAll('input[name="section[]"]');

    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function () {
            if (this.checked) {
                console.log(this.value);
                // Lakukan apapun yang Anda butuhkan dengan nilai yang dicentang di sini
            }
        });
    }

    var jam_padam = document.getElementById("jam_padam").value;
    var keterangan = document.getElementById("keterangan").value;
    var status = document.getElementById("status").value;
    var csrfToken = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    $.ajax({
        url: "/entripadam",
        type: "POST",
        data: {
            _token: csrfToken,
            penyebab_padam,
            penyulang,
            jam_padam,
            keterangan,
            status,
        },
        success: function (response) {
            console.log(response);
            var alertSuccessEntri =
                document.getElementById("alertSuccessEntri");
            var alertTextEntri = document.getElementById("alertTextEntri");
            alertTextEntri.innerHTML = response.message;
            alertSuccessEntri.classList.remove("d-none");
        },
    });
}
