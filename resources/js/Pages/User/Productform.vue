<template>
  <form @submit.prevent="update">
    <div class="form-group">
      <label for="Category">Category</label>
      <select v-model="productlist.category" class="form-control">
        <option v-for="(name, id) in category" :key="id" :value="name.category">
          {{ name.category }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label for="product">Product</label>
      <input
        type="text"
        name="product"
        v-model="productlist.product"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <label for="price">Price</label>
      <input
        type="text"
        name="price"
        v-model="productlist.price"
        class="form-control"
      />
    </div>
    <button type="submit" class="btn btn-info">Update</button>
    <Link href="/user/index" class="btn btn-danger">Back</Link>
  </form>
</template>

<script>
export default {};
</script>

<style>
</style>