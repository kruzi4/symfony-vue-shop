<template>
  <div class="row mb-1">
    <div class="col-md-1 text-center">
      {{ rowNumber }}
    </div>
    <div class="col-md-2">
      {{ productTitle }}
    </div>
    <div class="col-md-2">
      {{ categoryTitle }}
    </div>
    <div class="col-md-2">
      {{ orderProduct.quantity }}
    </div>
    <div class="col-md-2">
      ${{ orderProduct.PricePerOne }}
    </div>
    <div class="col-md-3">
      <button class="btn btn-outline-info" @click="viewDetails">
        Details
      </button>
      <button class="btn btn-outline-success" @click="remove">
        Remove
      </button>
    </div>
  </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import {getUrlViewProduct} from "../../../../utils/url-generator";
import {getProductInformativeTitle} from "../../../../utils/title-formatter";

export default {
  name: "orderProductItem",
  props: {
    orderProduct: {
      type: Object,
      default: () => {}
    },
    index: {
      type: Number,
      default: 0
    }
  },
  computed: {
    ...mapState("products", ["staticStore"]),
    rowNumber() {
      return this.index + 1;
    },
    productTitle() {
      return getProductInformativeTitle(this.orderProduct.product);
    },
    categoryTitle() {
      return this.orderProduct.product.category.title
    }
  },
  methods: {
    ...mapActions("products", ["removeOrderProduct"]),
    viewDetails(event) {
      event.preventDefault();

      const url = getUrlViewProduct(
          this.staticStore.url.viewProduct,
          this.orderProduct.product.id
      )
      window.open(url, "_blank").focus()
    },
    remove(event) {
      event.preventDefault()
      this.removeOrderProduct(this.orderProduct.id)
    }
  }
}
</script>

<style scoped>

</style>