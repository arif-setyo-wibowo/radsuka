// Dismiss Alert
setTimeout(function() {
    document.getElementById("autoDismissAlert").style.display = "none";
}, 3000);

// Edit Kategori
function editPasien(id, nama, jk, tgl, alamat) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#idpasien").val(id).prop('readonly', true);
    $("#nama_pasien").val(nama);
    $("#jenis_kelamin").val(jk);
    $("#tgl_lahir").val(tgl);
    $("#alamat").val(alamat);
    $("#proses").val("Update");
}

// Hapus Value Kategori
$("#custom-tab-tambah-edit").on("click", function() {
    $("#idpasien").val("").prop('readonly', false);
    $("#nama_pasien").val("");
    $("#jenis_kelamin").val("");
    $("#tgl_lahir").val("");
    $("#alamat").val("");
    $("#proses").val("Tambah");
});

// Edit Pengguna
function editPengguna(id, nama, username, password) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#id").val(id);
    $("#nama").val(nama);
    $("#username").val(username);
    $("#password_lama").val(password);
    $("#notifPassword").text("*Kosongkan Jika Tidak Ingin Merubah Password");
    $("#password").removeAttr("required");
    $("#proses").val("Update");
}

// Tambah Value Pengguna
$("#tambah-edit-tab").on("click", function() {
    $("#idpengguna").val("");
    $("#nama").val("");
    $("#username").val("");
    $("#email").val("");
    $("#level").val("User");
    $("#notifPassword").empty();
    $("#password").prop("required", true);
    $("#proses").val("Tambah");
});

// Edit Mobil