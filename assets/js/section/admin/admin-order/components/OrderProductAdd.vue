<template>
  <div class="row mb-2">
    <div class="col-md-2">
      <select
          v-model="form.category"
          name="add_product_category_select"
          class="form-control"
      >
        <option value="" disabled>- choose options -</option>
      </select>
    </div>
    <div class="col-md-3">
      <select
          v-model="form.productId"
          name="add_product_product_select"
          class="form-control"
      >
        <option value="" disabled>- choose options -</option>
      </select>
    </div>
    <div class="col-md-2">
      <input
          v-model="form.quantity"
          type="number"
          class="form-control"
          placeholder="quantity"
          min="0"
      />
    </div>
    <div class="col-md-2">
      <input
          v-model="form.pricePerOne"
          type="number"
          class="form-control"
          placeholder="price per one"
          step="0.01"
          min="0"
      />
    </div>
    <div class="col-md-3">
      <button
          class="btn btn-outline-info"
      >
        Details
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "OrderProductAdd",
  data() {
    return {
      form: {
        category: "",
        productId: "",
        quantity: "",
        pricePerOne: ""
      }
    }
  }
}
</script>

<style scoped>

</style>