
<template>
  <div>
    <div class="_container">
      <div class="row">
        <div class="col-12">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Sekolah</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">NSS</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat Sekolah</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kelurahan/Desa</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kota/Kabupaten</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Provinsi</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Website</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">NPSN</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
              <span class="form-control-plaintext">:</span>
            </div>
          </div>

          <div class="form-group row float-right">
            <router-link :to="{name:'ubahdatasekolah'}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i> Ubah Data Sekolah
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
