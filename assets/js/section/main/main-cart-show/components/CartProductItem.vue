<template>
  <tr>
    <td class="product-col">
      <div class="text-center">
        <figure>
          <a
            :href="urlShowProduct"
            target="_blank"
          >
            <img
              :src="getUrlProductImage(productImage)"
              :alt="cartProduct.product.title"
            >
          </a>
          <div class="product-title">
            <a
              :href="urlShowProduct"
              target="_blank"
            >
              {{ cartProduct.product.title }}
            </a>
          </div>
        </figure>
      </div>
    </td>
    <td class="price-col">
      ${{ cartProduct.product.price }}
    </td>
    <td class="quantity-col">
      <input
        v-model="quantity"
        type="number"
        class="form-control"
        min="1"
        step="1"
      >
    </td>
    <td class="total-col">
      ${{ productPrice }}
    </td>
    <td class="remove-col">
      <a
        href="#"
        class="btn-remove"
        title="Remove product"
        @click="RemoveCartProduct"
      >
        X
      </a>
    </td>
  </tr>
</template>

<script>
import {mapState} from "vuex";

export default {
  data() {
    return {
      quantity: 1
    }
  },
  name: "CartProductItem",
  props: {
    cartProduct: {
      type: Object,
      default: () => {}
    }
  },
  computed: {
    ...mapState("cart", ["staticStore"]),
    productImage() {
      const productImages = this.cartProduct.product.productImages;

      return productImages.length ? productImages[0] : null;
    },
    productPrice() {
      return this.quantity * this.cartProduct.product.price
    },
    urlShowProduct() {
      return this.staticStore.url.viewProduct + "/" + this.cartProduct.product.uuid
    }
  },
  methods: {
    getUrlProductImage() {
      return (
          this.staticStore.url.assetImageProducts +
              "/" +
              this.cartProduct.product.id +
              "/" +
              productImage.filenameSmall
      )
    },
    removeCartProduct() {
      return true
    }
  }
}
</script>

<style scoped>

</style>