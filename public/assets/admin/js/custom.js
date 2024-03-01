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
function editPetugas(id, nama, username, password) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#id").val(id);
    $("#nama").val(nama);
    $("#username").val(username);
    $("#password_lama").val(password);
    $("#notifPassword").text("*Kosongkan Jika Tidak Ingin Merubah Password");
    $("#password").removeAttr("required");
    $("#proses").val("Update");
}

// Tambah Value Petugas
$("#tambah-edit-tab").on("click", function() {
    $("#id").val("");
    $("#nama").val("");
    $("#username").val("");
    $("#email").val("");
    $("#level").val("Petugas");
    $("#notifPassword").empty();
    $("#password").prop("required", true);
    $("#proses").val("Tambah");
});

// Edit Rontgen
function editRontgen(no, id_pasien, tgl, jenis, detail,nama) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#idpemeriksaan").val(no).prop('readonly', true);
    document.getElementById("text-pasien").style.display = "";
    document.getElementById("idpasienselect").style.display = "none";
    document.getElementById("pasien").style.display = "";
    $("#pasien").prop("type", "text").prop("readonly", true).val(id_pasien+' - '+nama);
    $("#tgl_pemeriksaan").val(tgl);
    $("#jenis_pemeriksaan").val(jenis);
    $("#detail_pemeriksaan").val(detail);
    $("#notifPassword").text("*Kosongkan Jika Tidak Ingin Merubah Gambar");
    $("#notifdokumen").text("*Kosongkan Jika Tidak Ingin Merubah Dokumen");
    $("#foto_rontgen").removeAttr("required");
    $("#proses").val("Update");
};

$("#custom-tab-tambah-edit").on("click", function() {
    $("#idpemeriksaan").val("").prop('readonly', false);
    document.getElementById("text-pasien").style.display = "none";
    document.getElementById("idpasienselect").style.display = "";
    document.getElementById("pasien").style.display = "none";
    $("#tgl_pemeriksaan").val("");
    $("#jenis_pemeriksaan").val("");
    $("#detail_pemeriksaan").val("");
    $("#foto_rontgen").prop("required", true);
    $("#notifPassword").empty();
    $("#notifdokumen").empty();
    $("#proses").val("Tambah");
});