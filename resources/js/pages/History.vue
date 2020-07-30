<template>
  <div>
    <h1>History</h1>
    <form @submit.prevent="getHistoryData">
      <input
        type="number"
        name="order"
        id="order"
        placeholder="Please Enter Order ID"
        v-model="orderId"
      />
      <button type="submit">Get Data</button>
    </form>

    <div v-if="historyData && Object.keys(historyData).length">
        <h3>Exchange Detail:</h3>

        <div>
            from <b>{{historyData.from_price.currency.abbr}}</b> to <b>{{historyData.to_price.currency.abbr}}</b> <br>
            value: {{historyData.exchange_total_value}} <br>
            date: {{historyData.created_at}}
        </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      loading: false,
      hasError: false,
      orderId: "",
      historyData: {},
    };
  },
  methods: {
    getHistoryData: async function () {
      if (!this.orderId) {
        alert("Please Fill Order ID");
        return;
      }
      try {
        this.loading = true;
        this.hasError = false;
        const result = await axios.get(
          `http://127.0.0.1:8000/api/v1/orders/${this.orderId}`
        );
        this.historyData = result.data.data;
      } catch (e) {
        alert(e.response.data.message ?? e.message);
        this.hasError = true;
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
