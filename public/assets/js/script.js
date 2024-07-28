//? SCRIPT DARI ENTRIDATA_USER.BLADE
document.getElementById("getLocation").addEventListener("click", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
});

function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

document.getElementById("tarif").addEventListener("change", function () {
    var dayaSelected = document.getElementById("daya");
    var selectedTarif = this.value;

    dayaSelected.innerHTML =
        "<option selected disabled>--- Pilih Daya ---</option>";
    if (selectedTarif === "R1" || selectedTarif === "R1T") {
        dayaSelected.innerHTML += '<option value ="450 VA">450 VA</option>';
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
        dayaSelected.innerHTML += '<option value ="1300 VA">1300 VA</option>';
        dayaSelected.innerHTML += '<option value ="2200 VA">2200 VA</option>';
    } else if (selectedTarif === "R1M" || selectedTarif === "R1MT") {
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
    } else if (selectedTarif === "R2" || selectedTarif === "R2T") {
        dayaSelected.innerHTML += '<option value ="3500 VA">3500 VA</option>';
        dayaSelected.innerHTML += '<option value ="4400 VA">4400 VA</option>';
        dayaSelected.innerHTML += '<option value ="5500 VA">5500 VA</option>';
    } else if (selectedTarif === "R3" || selectedTarif === "R3T") {
        dayaSelected.innerHTML += '<option value ="7700 VA">7700 VA</option>';
        dayaSelected.innerHTML += '<option value ="11000 VA">11000 VA</option>';
    }else if (selectedTarif === "B1" || selectedTarif === "B1T") {
        dayaSelected.innerHTML += '<option value ="450 VA">450 VA</option>';
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
        dayaSelected.innerHTML += '<option value ="1300 VA">1300 VA</option>';
        dayaSelected.innerHTML += '<option value ="2200 VA">2200 VA</option>';
        dayaSelected.innerHTML += '<option value ="3500 VA">3500 VA</option>';
        dayaSelected.innerHTML += '<option value ="4400 VA">4400 VA</option>';
        dayaSelected.innerHTML += '<option value ="5500 VA">5500 VA</option>';
    }else if (selectedTarif === "B2" || selectedTarif === "B2T") {
        dayaSelected.innerHTML += '<option value ="7700 VA">7700 VA</option>';
        dayaSelected.innerHTML += '<option value ="11000 VA">11000 VA</option>';
    }else if (selectedTarif === "S2" || selectedTarif === "S2T") {
        dayaSelected.innerHTML += '<option value ="450 VA">450 VA</option>';
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
        dayaSelected.innerHTML += '<option value ="1300 VA">1300 VA</option>';
        dayaSelected.innerHTML += '<option value ="2200 VA">2200 VA</option>';
        dayaSelected.innerHTML += '<option value ="3500 VA">3500 VA</option>';
        dayaSelected.innerHTML += '<option value ="4400 VA">4400 VA</option>';
        dayaSelected.innerHTML += '<option value ="5500 VA">5500 VA</option>';
        dayaSelected.innerHTML += '<option value ="7700 VA">7700 VA</option>';
        dayaSelected.innerHTML += '<option value ="11000 VA">11000 VA</option>';
    }else if (selectedTarif === "P1" || selectedTarif === "P1T") {
        dayaSelected.innerHTML += '<option value ="450 VA">450 VA</option>';
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
        dayaSelected.innerHTML += '<option value ="1300 VA">1300 VA</option>';
        dayaSelected.innerHTML += '<option value ="2200 VA">2200 VA</option>';
        dayaSelected.innerHTML += '<option value ="3500 VA">3500 VA</option>';
        dayaSelected.innerHTML += '<option value ="4400 VA">4400 VA</option>';
        dayaSelected.innerHTML += '<option value ="5500 VA">5500 VA</option>';
        dayaSelected.innerHTML += '<option value ="7700 VA">7700 VA</option>';
        dayaSelected.innerHTML += '<option value ="11000 VA">11000 VA</option>';
    }else if (selectedTarif === "P3" || selectedTarif === "P3T") {
        dayaSelected.innerHTML += '<option value ="450 VA">450 VA</option>';
        dayaSelected.innerHTML += '<option value ="900 VA">900 VA</option>';
        dayaSelected.innerHTML += '<option value ="1300 VA">1300 VA</option>';
        dayaSelected.innerHTML += '<option value ="2200 VA">2200 VA</option>';
        dayaSelected.innerHTML += '<option value ="3500 VA">3500 VA</option>';
        dayaSelected.innerHTML += '<option value ="4400 VA">4400 VA</option>';
        dayaSelected.innerHTML += '<option value ="5500 VA">5500 VA</option>';
        dayaSelected.innerHTML += '<option value ="7700 VA">7700 VA</option>';
        dayaSelected.innerHTML += '<option value ="11000 VA">11000 VA</option>';
    }  else {
        dayaSelected.innerHTML +=
            '<option value="other" >Pilihan Daya Tidak Ada</option>';
    }
});
//? END SCRIPT DARI ENTRIDATA_USER.BLADE
