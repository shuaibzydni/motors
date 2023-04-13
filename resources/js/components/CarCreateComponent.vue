<template>
  <form
    enctype="multipart/form-data"
    novalidate
    @submit.prevent="submitForm(payload)"
  >
    <div class="popup_body">
      <div class="flex-container">
        <div class="inner_flx">
          <div class="flx_list">
            <label>Make</label>
            <v-select
              class="v-car-select"
              id="make"
              :reduce="(make) => make.id"
              label="name"
              v-model="payload.product_brand_id"
              :options="carMake"
            />
            <span class="invalid-msg" v-if="formErrors.product_brand_id">{{
              formErrors.product_brand_id[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Model</label>
            <v-select
              class="v-car-select"
              id="model"
              :reduce="(model) => model.id"
              label="name"
              v-model="payload.product_make_id"
              :options="carModels"
            />
            <span class="invalid-msg" v-if="formErrors.product_make_id">{{
              formErrors.product_make_id[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label class="two_list">Model Year </label>
            <v-select
              class="v-car-select"
              id="year"
              v-model="payload.model_year"
              :options="modelYears"
            />
            <span class="invalid-msg" v-if="formErrors.model_year">{{
              formErrors.model_year[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Drive Type</label>
            <v-select
              class="v-car-select"
              id="drive_type"
              :reduce="(model) => model.id"
              label="title"
              v-model="payload.drive_type_id"
              :options="driveTypes"
            />
            <span class="invalid-msg" v-if="formErrors.drive_type_id">{{
              formErrors.drive_type_id[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Fuel Type</label>
            <v-select
              class="v-car-select"
              id="fuel_type"
              :reduce="(model) => model.id"
              label="name"
              v-model="payload.fuel_type_id"
              :options="fuelTypes"
            />
            <span class="invalid-msg" v-if="formErrors.fuel_type_id">{{
              formErrors.fuel_type_id[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Vehicle Current Odometer/Mileage</label>
            <input type="text" v-model="payload.odometer_mileage" />
            <span class="invalid-msg" v-if="formErrors.odometer_mileage">{{
              formErrors.odometer_mileage[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Vehicle Registration Number</label>
            <input type="text" v-model="payload.vehicle_registration_number" />
            <span
              class="invalid-msg"
              v-if="formErrors.vehicle_registration_number"
              >{{ formErrors.vehicle_registration_number[0] }}</span
            >
          </div>

          <div class="flx_list">
            <label>Vehicle VIN</label>
            <input type="text" v-model="payload.vehicle_vin" />
            <span class="invalid-msg" v-if="formErrors.vehicle_vin">{{
              formErrors.vehicle_vin[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Vehicle Price</label>
            <input type="text" v-model="payload.vehicle_price" />
            <span class="invalid-msg" v-if="formErrors.vehicle_price">{{
              formErrors.vehicle_price[0]
            }}</span>
          </div>

        </div>
        <div class="inner_flx">
          <!-- <div class="flx_list">
            <label>Vehicle Name</label>
            <input type="text" v-model="payload.name" />
            <span class="invalid-msg" v-if="formErrors.name">{{
              formErrors.name[0]
            }}</span>
          </div> -->

          <div class="flx_list">
            <label>Body Type</label>
            <v-select
              class="v-car-select"
              id="body_type"
              :reduce="(model) => model.id"
              label="title"
              v-model="payload.body_type_id"
              :options="bodyTypes"
            />
            <span class="invalid-msg" v-if="formErrors.body_type_id">{{
              formErrors.body_type_id[0]
            }}</span>
          </div>
          <div class="flx_list">
            <label>Model Description</label>
            <textarea
              placeholder="Description"
              v-model="payload.model_description"
            ></textarea>
            <span class="invalid-msg" v-if="formErrors.model_description">{{
              formErrors.model_description[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Transmission </label>
            <v-select
              class="v-car-select"
              id="transmission"
              :reduce="(model) => model.id"
              label="title"
              v-model="payload.transmission_id"
              :options="transmissions"
            />
            <span class="invalid-msg" v-if="formErrors.transmission_id">{{
              formErrors.transmission_id[0]
            }}</span>
          </div>
          <div class="flx_list">
            <label>Service Log Book</label>
            <input type="file" @change="serviceLogSelected" />
            <span class="invalid-msg" v-if="formErrors.service_log_book">{{
              formErrors.service_log_book[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Upload Vehicle Images</label>
          </div>

          <div class="flx_list">
            <label>Front Image</label>
            <input type="file" @change="frontImageSelected" />
            <span class="invalid-msg" v-if="formErrors.front_image">{{
              formErrors.front_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Rear Image</label>
            <input type="file" @change="rearImageSelected" />
            <span class="invalid-msg" v-if="formErrors.rear_image">{{
              formErrors.rear_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Left Side Image</label>
            <input type="file" @change="leftSideImageSelected" />
            <span class="invalid-msg" v-if="formErrors.left_side_image">{{
              formErrors.left_side_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Interior Image</label>
            <input type="file" @change="interiorImageSelected" />
            <span class="invalid-msg" v-if="formErrors.interior_image">{{
              formErrors.interior_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Cargo Area Image</label>
            <input type="file" @change="cargoAreaImageSelected" />
            <span class="invalid-msg" v-if="formErrors.cargo_area_image">{{
              formErrors.cargo_area_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Engine Bay Image</label>
            <input type="file" @change="engineBayImageSelected" />
            <span class="invalid-msg" v-if="formErrors.engine_bay_image">{{
              formErrors.engine_bay_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Roof Image</label>
            <input type="file" @change="roofImageSelected" />
            <span class="invalid-msg" v-if="formErrors.roof_image">{{
              formErrors.roof_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Wheels Image</label>
            <input type="file" @change="wheelsImageSelected" />
            <span class="invalid-msg" v-if="formErrors.wheels_image">{{
              formErrors.wheels_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Keys Image</label>
            <input type="file" @change="keysImageSelected" />
            <span class="invalid-msg" v-if="formErrors.keys_image">{{
              formErrors.keys_image[0]
            }}</span>
          </div>

          <div class="flx_list">
            <label>Owners Manual</label>
            <input type="file" @change="ownersManualSelected" />
            <span class="invalid-msg" v-if="formErrors.owners_manual">{{
              formErrors.owners_manual[0]
            }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="popup_footer">
      <button type="submit" class="sell_btn btn">Sell your Vehicle</button>
      <button type="reset" class="reset_form btn">Reset Form</button>
    </div>
  </form>
</template>

<script>
import CarApi from "../api/CarApi";

export default {
  data() {
    return {
      vehicleStatus: [
        {
          name: "Available",
          value: "available",
        },
        {
          name: "Unavailable",
          value: "unavailable",
        },
        {
          name: "Sold",
          value: "sold",
        },
      ],
      payload: {
        product_brand_id: null,
        product_make_id: null,
        body_type_id: null,
        drive_type_id: null,
        fuel_type_id: null,
        transmission_id: null,
        model_year: null,
        name: null,
        model_description: null,
        odometer_mileage: null,
        vehicle_registration_number: null,
        vehicle_vin: null,
        vehicle_price: null,
        vehicle_status: "available",
        service_log_book: null,
        front_image: null,
        rear_image: null,
        left_side_image: null,
        interior_image: null,
        cargo_area_image: null,
        engine_bay_image: null,
        roof_image: null,
        wheels_image: null,
        keys_image: null,
        owners_manual: null,
      },
      formErrors: [],
      errors: [],
      carMake: [],
      carModels: [],
      modelYears: [],
      driveTypes: [],
      fuelTypes: [],
      bodyTypes: [],
      transmissions: [],
    };
  },
  watch: {
    errors: function (error) {
      if (error.length > 0) {
        this.$_toast(error, "error");
      }
    },

    'payload.product_brand_id': async function (brandId) {
      if (brandId) {
        await this.getModels({ brand_id: brandId })
      }
    }
  },
  async created() {
    await this.getCarResources();
  },
  computed: {},
  methods: {
    async getCarResources(params = null) {
      await CarApi.carResources(params)
        .then((response) => {
          const data = response.data;
          this.carMake = data.makes;
          this.modelYears = data.modelYears;
          this.driveTypes = data.driveTypes;
          this.fuelTypes = data.fuelTypes;
          this.bodyTypes = data.bodyTypes;
          this.transmissions = data.transmissions;
          this.errors = [];
        })
        .catch((error) => {
          this.errors = error.response ? error.response.data.errors : [];
        });
    },

    async getModels(params = null) {
        let loader = this.$loading.show()
        await CarApi.carModels(params)
            .then((response) => {
                this.carModels = response.data;
                loader.hide()
            })
            .catch((error) => {
                this.errors = error.response ? error.response.data.errors : [];
                loader.hide()
            });
    },

    serviceLogSelected(e) {
      this.payload.service_log_book = e.target.files[0];
    },

    frontImageSelected(e) {
      this.payload.front_image = e.target.files[0];
    },

    rearImageSelected(e) {
      this.payload.rear_image = e.target.files[0];
    },

    leftSideImageSelected(e) {
      this.payload.left_side_image = e.target.files[0];
    },

    interiorImageSelected(e) {
      this.payload.interior_image = e.target.files[0];
    },

    cargoAreaImageSelected(e) {
      this.payload.cargo_area_image = e.target.files[0];
    },

    engineBayImageSelected(e) {
      this.payload.engine_bay_image = e.target.files[0];
    },

    roofImageSelected(e) {
      this.payload.roof_image = e.target.files[0];
    },

    wheelsImageSelected(e) {
      this.payload.wheels_image = e.target.files[0];
    },

    keysImageSelected(e) {
      this.payload.keys_image = e.target.files[0];
    },

    ownersManualSelected(e) {
      this.payload.owners_manual = e.target.files[0];
    },

    async submitForm(payload) {
      let formData = new FormData();
      for (let key in payload) {
        if (payload[key]) {
          formData.append(key, payload[key]);
        }
      }
      let loader = this.$loading.show()
      await CarApi.carStore(formData)
        .then((response) => {
          loader.hide();
          this.$_toast(null, "success");
          this.formErrors = [];
          window.location = "/my-vehicles";
        })
        .catch((error) => {
            loader.hide();
          if (error.response.status !== 422) {
          }
          this.formErrors = error.response.data.errors;
        });
    },
  },
};
</script>
