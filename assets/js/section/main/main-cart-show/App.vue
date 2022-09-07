<template>
  <div class="row">
    <div class="col-lg-12 order-block">
      <div class="order-content">
        <div v-if="showCartContent">
          <CartProductList/>
          <CartTotalPrice/>
          <a
            class="btn btn-success mb-3 text-white"
            @click="makeOrder"
          >Make order</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CartTotalPrice from "./components/CartTotalPrice";
import CartProductList from "./components/CartProductList";
import {mapActions} from "vuex";

export default {
  name: "App",
  components: {CartTotalPrice, CartProductList},
  created() {
    this.getCart()
  },
  computed: {
    showCartContent() {
      return true
    }
  },
  methods: {
    ...mapActions("cart", ["getCart"]),
    makeOrder() {
      return true
    }
  }

}
</script>