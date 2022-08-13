<template>
  <div class="table-additional-selection">
    <OrderProductAdd/>
    <hr>
      <OrderProductItem
          v-for="(orderProduct, index) in staticStore.orderProducts"
          :key="orderProduct.id"
          :order-product="orderProduct"
          :index="index"
      />
    <hr>
  </div>
</template>

<script>
import { mapState } from "vuex"
import OrderProductItem from "./components/orderProductItem";
import OrderProductAdd from "./components/OrderProductAdd";

export default {
  components: {OrderProductAdd, OrderProductItem},
  created() {
    console.log(
        window.staticStore
    )
  },
  computed: {
    ...mapState("products", ["staticStore"]),
    productsCount: () => {
       return 1234;
     }
  }
}
</script>