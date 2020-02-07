<template>
  <form>
    <div class="form-group row">
      <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
      <div class="col-sm-10">
        <select
          class="form-control m-b"
          name="provinsi"
          id="provinsi"
          v-model="selectedprovinsi"
          v-on:change="getKabupaten"
        >
          <option selected value>-- Pilih Provinsi --</option>
          <option v-for="p in provinsi" :key="p.id" v-bind:value="p.id">{{p.name}}</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
      <div class="col-sm-10">
        <select
          class="form-control m-b"
          name="kabupaten"
          id="kabupaten"
          v-model="selectedkabupaten"
          v-on:change="getKecamatan"
        >
          <option selected value>-- Pilih Kabupaten --</option>
          <option v-for="k in kabupaten" :key="k.id" v-bind:value="k.id">{{k.name}}</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
      <div class="col-sm-10">
        <select
          class="form-control m-b"
          name="kecamatan"
          id="kecamatan"
          v-model="selectedkecamatan"
          v-on:change="getKelurahan"
        >
          <option selected value>-- Pilih Kecamatan --</option>
          <option v-for="k in kecamatan" :key="k.id" v-bind:value="k.id">{{k.name}}</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
      <div class="col-sm-10">
        <select class="form-control m-b" name="kelurahan" id="kelurahan">
          <option selected value>-- Pilih Kelurahan --</option>
          <option v-for="k in kelurahan" :key="k.id" v-bind:value="k.id">{{k.name}}</option>
        </select>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      uniqueCode: [],
      provinsi: [],
      kabupaten: [],
      kecamatan: [],
      kelurahan: [],
      selectedprovinsi: "",
      selectedkabupaten: "",
      selectedkecamatan: ""
    };
  },

  created() {
    axios
      .get(`https://x.rajaapi.com/poe`)
      .then(response => {
        this.uniqueCode = response.data.token;
        this.getProvinsi(
          `https://x.rajaapi.com/MeP7c5ne${this.uniqueCode}/m/wilayah/provinsi`
        );
      })
      .catch(e => {
        this.errors.push(e);
        console.log(e);
      });
  },

  methods: {
    getProvinsi: function(p) {
      axios
        .get(p)
        .then(response => {
          this.provinsi = response.data.data;
        })
        .catch(e => {
          this.errors.push(e);
          console.log(e);
        });
    },

    getKabupaten: function() {
      axios
        .get(
          `https://x.rajaapi.com/MeP7c5ne${this.uniqueCode}/m/wilayah/kabupaten?idpropinsi=${this.selectedprovinsi}`
        )
        .then(response => {
          this.kabupaten = response.data.data;
        })
        .catch(e => {
          this.errors.push(e);
          console.log(e);
        });
    },

    getKecamatan: function() {
      axios
        .get(
          `https://x.rajaapi.com/MeP7c5ne${this.uniqueCode}/m/wilayah/kecamatan?idkabupaten=${this.selectedkabupaten}`
        )
        .then(response => {
          this.kecamatan = response.data.data;
        })
        .catch(e => {
          this.errors.push(e);
          console.log(e);
        });
    },
    getKelurahan: function() {
      axios
        .get(
          `https://x.rajaapi.com/MeP7c5ne${this.uniqueCode}/m/wilayah/kelurahan?idkecamatan=${this.selectedkecamatan}`
        )
        .then(response => {
          this.kelurahan = response.data.data;
        })
        .catch(e => {
          this.errors.push(e);
          console.log(e);
        });
    }
  }
};
</script>