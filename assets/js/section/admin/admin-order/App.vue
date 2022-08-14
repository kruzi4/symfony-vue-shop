<template>
  <div class="table-additional-selection">
    <OrderProductAdd/>
    <hr>
      <OrderProductItem
          v-for="(orderProduct, index) in orderProducts"
          :key="orderProduct.id"
          :order-product="orderProduct"
          :index="index"
      />
    <hr>
  </div>
</template>

<script>
import {mapActions, mapState} from "vuex"
import OrderProductItem from "./components/orderProductItem";
import OrderProductAdd from "./components/OrderProductAdd";

export default {
  components: {OrderProductAdd, OrderProductItem},
  created() {
    this.getCategories()
    this.getOrderProducts()
  },
  computed: {
    ...mapState("products", ["orderProducts"]),
  },
  methods: {
    ...mapActions("products", ["getCategories", "getOrderProducts"])
  }
}
</script>