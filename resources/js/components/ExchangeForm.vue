<template>
  <div>
    <template v-if="hasError">
      <div class="alert error">
        <p>Error in get price list</p>
        <button @click="getLastPrices">Try Again</button>
      </div>
    </template>
    <template v-else>
      <form @submit.prevent="sendExchangeRequest" :class="['form', loading ? 'loading' : '']">
        <div class="select-wrapper">
          <div>
            <select v-model="formData.fromCurrency" name="from" id="from">
              <option
                v-for="(item, index) in fromOptions"
                :key="index"
                :value="item.id"
              >{{item.label}}</option>
            </select>
          </div>
          <div>
            <select v-model="formData.toCurrency" name="to" id="to">
              <option
                v-for="(item, index) in toOptions"
                :key="index"
                :value="item.id"
              >{{item.label}}</option>
            </select>
          </div>
        </div>
        <div class="inputs-wrapper">
          <div>
            <input
              type="number"
              name="fromValue"
              id="fromValue"
              v-model="formData.fromValue"
              placeholder="value (*)"
            />
          </div>
          <div>
            <input type="number" name="toValue" id="toalue" v-model="formData.toValue" readonly />
          </div>
        </div>
        <div class="email-wrapper">
          <input
            type="email"
            name="email"
            id="email"
            placeholder="email address (*)"
            v-model="formData.email"
          />
        </div>
        <div class="actions">
          <button type="submit">Save Exchange Request</button>
        </div>
      </form>
    </template>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      currencyOptions: [
        { id: "IRR", label: "IRR" },
        { id: "USD", label: "USD" },
        { id: "EUR", label: "EUR" },
      ],
      formData: {
        fromCurrency: "",
        toCurrency: "",
        fromValue: "",
        toValue: "",
        email: "",
      },
      hasError: false,
      loading: false,
      lastPrices: [],
    };
  },
  computed: {
    fromOptions() {
      return this.currencyOptions;
    },
    toOptions() {
      if (this.formData.fromCurrency) {
        return this.currencyOptions.filter(
          (item) => item.id !== this.formData.fromCurrency
        );
      }
      return this.currencyOptions;
    },
  },
  mounted: async function () {
    await this.getLastPrices();
  },
  methods: {
    getLastPrices: async function () {
      try {
        this.loading = true;
        this.hasError = false;
        const result = await axios.get(
          "http://127.0.0.1:8000/api/v1/prices/last"
        );
        this.lastPrices = result.data.data;
      } catch (e) {
        this.hasError = true;
      } finally {
        this.loading = false;
      }
    },
    sendExchangeRequest: async function () {
      if (this.validateForm()) {
        try {
          this.loading = true;
          this.hasError = false;
          const result = await axios.post(
            "http://127.0.0.1:8000/api/v1/orders",
            {
              from: this.getPriceByAbbr(this.formData.fromCurrency).id,
              to: this.getPriceByAbbr(this.formData.toCurrency).id,
              amount: this.formData.fromValue,
              email: this.formData.email,
            }
          );
          alert("operation was successfull");
        } catch (e) {
          console.log("@@", e);
          alert(e.message);
        } finally {
          this.loading = false;
        }
      } else {
        alert("Please fill all fields");
      }
    },
    validateForm() {
      return (
        this.formData.fromCurrency &&
        this.formData.toCurrency &&
        this.formData.fromCurrency !== this.toCurrency &&
        this.formData.fromValue &&
        this.formData.email
      );
    },
    getPriceByAbbr(abbr) {
      return this.lastPrices.find((price) => price.currency.abbr === abbr);
    },
  },
  watch: {
    ["formData.fromCurrency"]() {
      this.formData.toCurrency = "";
      this.formData.fromValue = "";
    },
    ["formData.fromValue"](val) {
      if (val) {
        if (this.formData.fromCurrency && this.formData.toCurrency) {
          const fromPrice = this.getPriceByAbbr(this.formData.fromCurrency);
          const toPrice = this.getPriceByAbbr(this.formData.toCurrency);

          this.formData.toValue = val * (fromPrice.value / toPrice.value);
        }
      } else {
        this.formData.toValue = "";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.form {
  padding: 24px 0;
  overflow: hidden;
  position: relative;
  border-radius: 8px;
  box-sizing: border-box;

  &::before,
  &::after {
    opacity: 0;
    visibility: hidden;
    transition: all 300ms ease-in-out;
  }

  &::before {
    top: 0;
    left: 0;
    z-index: 1;
    content: "";
    width: 100%;
    height: 100%;
    color: white;
    text-align: center;
    position: absolute;
    background-color: rgba($color: #000000, $alpha: 0.6);
  }

  &::after {
    top: 50%;
    left: 50%;
    z-index: 2;
    color: #ffffff;
    font-weight: bold;
    font-size: 1.4rem;
    position: absolute;
    content: "Loading...";
    transform: translate(-50%, -50%);
  }

  &.loading {
    &::before,
    &::after {
      opacity: 1;
      visibility: visible;
    }
  }

  .select-wrapper {
    display: flex;

    div {
      padding: 6px 12px;
      flex-grow: 1;

      select {
        width: 100%;
      }
    }
  }

  .inputs-wrapper {
    display: flex;

    div {
      padding: 6px 12px;
      flex-grow: 1;

      input {
        box-sizing: border-box;
        display: inline-block;
        width: 100%;
      }
    }
  }

  .email-wrapper {
    padding: 8px 12px;

    input {
      width: 100%;
      box-sizing: border-box;
    }
  }

  .actions {
    padding: 8px 0;
    text-align: center;
  }
}
</style>
