<template>
  <div class="row mb-1">
    <div class="col-md-2 text-right font-weight-bold">
      Total price:
    </div>
    <div class="col-md-10">
      <span class="wont-weight-bold">
        ${{ totalPrice }}
      </span>
    </div>
  </div>
</template>

<script>
import {mapState} from "vuex";

export default {
  name: "TotalPriceBlock",
  computed: {
    ...mapState("products", ["orderProducts"]),
    totalPrice() {
      let totalPrice = 0
      this.orderProducts.forEach(orderProduct => {
        totalPrice +=
            parseFloat(orderProduct.PricePerOne) * orderProduct.quantity
      })
      return parseFloat(totalPrice.toFixed(2))
    }
  }
}
</script>

<style scoped>

</style>