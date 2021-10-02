<template>
  <div class="container">
    <div class="row justify-content-center" >
      <div class="col-8">
        <nav class="navbar navbar-light bg-light">
          <form class="form-inline" @submit.prevent='submit'>
            <div class="input-group">
              <div class="input-group-prepend">
                <button type="submit" btn-sm btn-secondary>search</button>
              </div>
              <input
                type="text"
                class="form-control"
                v-model="query"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </form>
        </nav>
      </div>
      <div class="col-4">
 <div class="alert alert-success" v-if="success">{{ success }}</div>
          <Link href="category" class="btn btn-info" style="margin-top:10px;">Create</Link>
      </div>
     
    </div>
    <div class="row">
      <div class="col-md-12">
        <div>

          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Product</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
              <tr v-for="item in products.data" :key="item.id">
                <th>{{ item.id }}</th>
                <th>{{ item.category }}</th>
                <th>{{ item.product }}</th>
                <th>{{ item.price }}</th>
                <th>
                  <Link :href="`/user/${item.id}/edit`" class="btn btn-info"
                    >Edit</Link
                  >
                  <button @click="destroy(item.id)" class="btn btn-danger">
                    Delete
                  </button>
                </th>
              </tr>
            </thead>
          </table>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li
                :class="[
                  'page-item',
                  link.url === null ? 'disabled' : '',
                  link.active ? 'active' : '',
                ]"
                v-for="(link, index) in products.links"
                :key="index"
              >
                <Link class="page-link" :href="link.url" v-html="link.label">{{
                  link.label
                }}</Link>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue";
import Form from "vform";
export default {
  components: {
    Link,
  },
  props: ["products", "success","search"],
  methods: {
    destroy(id) {
      this.$inertia.delete(`/user/${id}`);
    },
    submit()
    {
        this.$inertia.get(`/user/index?search=${this.query}`)
    }
  },
  data()
  {
      return {
          query:this.search
      }
  }
};
</script>

<style>
</style>