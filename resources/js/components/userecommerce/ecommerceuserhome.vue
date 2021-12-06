<template>
  <div class="home">
    <div v-if="allproducts == null" style="padding-top: 250px">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3 align="center">Loading Now</h3>
            <div class="d-flex justify-content-center">
              <div
                class="spinner-border text-info"
                style="width: 3rem; height: 3rem"
                role="status"
              >
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="phone" id="ph" v-if="allproducts != null">
      <div v-if="!euser" class="container" style="padding-top: 120px">
        <div class="row">
          <div class="col-md-6 offset-md-3" align="center">
            <h1>Your are not login</h1>
            <router-link to="/ecommerce/user/login"
              ><button class="btn btn-info">Login</button></router-link
            >
          </div>
        </div>
      </div>
      <div v-if="euser">
        <div class="container" style="padding-top: 150px" ref="porto">
          <p>
            Show Result :
            <span v-if="isclickfilter == true" class="badge badge-primary">{{
              ptotal[1]
            }}</span>
            <span v-if="isclickfilter == false" class="badge badge-primary">{{
              total.total
            }}</span>
          </p>
          <p v-if="isclickfilter == true">
            Show Category :
            <span v-if="isclickfilter == true" class="badge badge-primary">{{
              allproductsbycat ? allproductsbycat[0][0].category : ""
            }}</span>
          </p>
          <div v-if="isclickback == true" class="row justify-content-end">
            <div style="padding-bottom: 10px">
              <button class="btn-sm btn-info btnback" @click="getall">
                back
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="row" v-if="isclickfilter == false">
                <div
                  class="col-sm-3 img"
                  v-for="pro in allproducts.data"
                  :key="pro.id"
                >
                  <div class="card">
                    <div class="card-header">
                      <img
                        :src="`/images/${pro.photo}`"
                        alt=""
                        class="img-fluid"
                        style="max-height: 100px"
                      />
                    </div>
                    <div class="card-body">
                      <p>{{ pro.product }}</p>
                      <p></p>

                      <p>{{ pro.price }}</p>
                      <span v-if="pro.qty == 0" class="text-danger bg-light"
                        >out of stock</span
                      >
                      <span v-if="pro.qty != 0" class="text-success bg-light"
                        >instock
                        <span class="badge badge-success">{{
                          pro.qty
                        }}</span></span
                      >
                    </div>
                    <div class="card-footer" align="center">
                      <button
                        v-if="pro.qty != 0"
                        class="btn btn-outline-primary"
                        @click="goinfo(pro.id)"
                      >
                        Info
                      </button>
                      <button
                        v-if="pro.qty == 0"
                        disabled
                        class="btn btn-outline"
                      >
                        Info
                      </button>
                    </div>
                  </div>
                  <br /><br />
                </div>
              </div>
              <div v-if="isclickfilter == true">
                <div class="row">
                  <div
                    class="col-sm-3 img"
                    v-for="pro in allproductsbycat[0]"
                    :key="pro.id"
                  >
                    <div class="card">
                      <div class="card-header">
                        <img
                          :src="`/images/${pro.photo}`"
                          alt=""
                          class="img-fluid"
                          style="max-height: 100px"
                        />
                      </div>
                      <div class="card-body">
                        <p>{{ pro.product }}</p>
                        <p></p>

                        <p>{{ pro.price }}</p>
                        <span v-if="pro.qty == 0" class="text-danger bg-light"
                          >out of stock</span
                        >
                        <span v-if="pro.qty != 0" class="text-success bg-light"
                          >instock</span
                        >
                      </div>
                      <div class="card-footer" align="center">
                        <button
                          class="btn btn-outline-primary"
                          @click="goinfo(pro.id)"
                        >
                          Info
                        </button>
                      </div>
                    </div>
                    <br /><br />
                  </div>
                </div>
              </div>
              <div v-if="isclickfilter == false" @click="pagetop">
                <pagination
                  :data="allproducts"
                  @pagination-change-page="getallproducts"
                ></pagination>
              </div>
              <!-- <div ><pagination :data='allproducts' @pagination-change-page='filterbycat'></pagination></div> -->
            </div>

            <div
              class="col-md-3 justify-content-center cat"
              style="padding-bottom: 0px"
            >
              <div class="row justify-content-center form">
                <div class="col-md-8 bg-primary" style="padding: 10px">
                  <div class="card" align="center">
                    <div class="input-group">
                      <form @submit.prevent="searchallproducts">
                        <input
                          type="search"
                          placeholder="Search"
                          class="form-control mr-sm-2"
                          v-model="searchname"
                          @click="searchError=''"
                        />
                        <span class="text-danger">
                            {{searchError}}
                        </span>
                        <br />
                        <button
                          @click="showsname"
                          type="submit"
                          class="btn btn-outline-success my-2 my-sm-0"
                        >
                          Search<i class="fas fa-search"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-8 bg-light"
                  style="padding: 10px; margin-top: 20px"
                >
                  <div class="card" style="background: white" ref="header">
                    <div class="card-header">Category List</div>
                    <div
                      v-for="cat in allcategories"
                      :key="cat.id"
                      align="center"
                       class="phover"
                         :class="{'active' : selected===cat.id}"
                         @click="filterbycat(cat)"
                         style="cursor:pointer"
                    >
                      <p
                        style="cursor: pointer;font-family:arial;padding-top:20px;"
                       
                      >
                        {{ cat.category }}
                      </p>
                    </div>
                    <p
                    class="phover"
                    :class="{'active' : selected==='a'}"
                      align="center"
                      style="cursor: pointer;font-family:arial;padding-top:20px;padding-bottom:20px;"
                      @click="getall"
                    >
                      All Products
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { eventBus } from "./../../app";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      allproducts: null,
      allproductsbycat: [],
      allcategories: [],
      searchname: "",
      total: "",
      ptotal: "",
      isclickfilter: false,
      isclickback: false,
      isclicksearch: false,
      isSearch: false,
      searchError:'',
      header:'',
      selected:'',
    };
  },
  methods: {
    async getallproducts(page = 1) {
      const xhttp = new XMLHttpRequest();
      localStorage.removeItem("searchit");
      xhttp.onload = (resp) => {
        if (search == "") {
          var search = localStorage.getItem("searchit");
          this.searchname = search;
          this.searchallproducts();
        } else {
          this.allproducts = JSON.parse(resp.currentTarget.response);
          this.total = JSON.parse(resp.currentTarget.response);
          this.isclickfilter = false;
        }
      };
      xhttp.open("GET", `/ecommerce/user/getallproducts?page=${page}`);
      xhttp.send();
    },
    async searchallproducts() {
      var search = localStorage.getItem("searchit");
      const xhttp = new XMLHttpRequest();
      this.isclicksearch = true;
      this.isSearch = !this.isSearch;
      xhttp.onload = (resp) => {
        var data=resp.currentTarget.response
        if (data[4] == 0) {
          this.searchError='Search Item Not Found!'
        }else if(search=='')
        { 
          this.searchError='Please write something to search!'
        }
          else {
          this.allproductsbycat = JSON.parse(resp.currentTarget.response);
          this.total = JSON.parse(resp.currentTarget.response);
          this.isclickfilter = true;
          this.searchname = search;
          window.scrollTo(0, top);
          this.ptotal = JSON.parse(resp.currentTarget.response);
          this.isclickback = true;
        }
      };
      xhttp.open("GET", `/ecommerce/user/searchallproducts?search=${search}`);
      xhttp.send();
    },
    async getallcategories() {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = (resp) => {
        const respdata = resp.currentTarget.response;
        const data = JSON.parse(respdata);
        this.allcategories = data;
      };
      xhttp.open("GET", "/ecommerce/user/getcategory", false);
      xhttp.send();
    },
    async filterbycat(cat) {
      this.selected=cat.id;
      const xhttp = new XMLHttpRequest();
      this.isclicksearch = false;

      xhttp.onload = (resp) => {
        this.allproductsbycat = JSON.parse(resp.currentTarget.response);
        this.ptotal = JSON.parse(resp.currentTarget.response);
        this.isclickback = true;
        this.isclickfilter = true;
        window.scrollTo(0, top);
      };
      xhttp.open("GET", "/ecommerce/user/filter/get?cat=" + cat.category);
      xhttp.send();
    },
    async goinfo(id) {
      this.$router.push({ path: "/ecommerce/user/info/" + id });
    },

    async getall() {
      this.selected='a'
      const xhttp = new XMLHttpRequest();
      this.isclickback = true;
      localStorage.removeItem("serchit");
      xhttp.onload = (resp) => {
        this.allproducts = JSON.parse(resp.currentTarget.response);
        this.total = JSON.parse(resp.currentTarget.response);
        this.isclickfilter = false;
        this.isclickback = false;
        this.searchname = "";
        window.scrollTo(0, top);
        this.isSearch = false;
      };
      xhttp.open("GET", "/ecommerce/user/getall");
      xhttp.send();
    },
    showsname() {
      localStorage.setItem("searchit", this.searchname);
      this.searchError=""
    },
    pagetop() {
      window.scrollTo(0, top);
    },
  },
  mounted() {
    this.getallproducts();
    this.getallcategories();

    eventBus.$emit("countcart");
    
  },
  computed: {
    ...mapGetters(["euser", "usersearch"]),
  },
};
</script>
<style scoped>
</style>
<style lang='scss' scoped>
@import "~/assets/phone.scss";
</style>

