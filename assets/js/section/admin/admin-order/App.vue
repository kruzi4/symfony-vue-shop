<template>
  <div>
    Vue app:  {{ testProperty }}
  </div>
</template>

<script>
import { mapState } from "vuex"

export default {
  computed: {
    ...mapState("products", ["testProperty"]),
    productsCount: () => {
       return 1234;
     }
  }
}
</script>